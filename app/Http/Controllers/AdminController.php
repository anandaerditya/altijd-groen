<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\u;
use App\Helpers\CodeGenerator;

class AdminController extends Controller
{
    private ItemService $itemService;
    private Builder $category;
    private Builder $unit;

    public function __construct()
    {
        $this->itemService = new ItemService();
        $this->category = DB::table('item_categories');
        $this->unit = DB::table('item_units');
    }

    public function index()
    {
        dd($this->itemService->all());
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category = $this->category->get()->toArray();

        return view('admin.manage')->with(['page_title' => 'Add Item', 'action' => 'new', 'category' => $category]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        # Validation
        $validation = Validator::make($request->all(), [
            'category_code' => 'required|string',
            'unit_code' => 'required|string',
            'name' => 'required|string',
            'quantity' => 'nullable|numeric',
        ]);

        $is_error = '';
        $reporting = [];

        # Condition if Fails
        if ($validation->fails()) {
            return redirect()->back()->withErrors(['errors' => $validation->getMessageBag()]);
        }

        # Condition : Name Length
        if (strlen($request->get('name')) < 2) {
            $is_error = true;
            $reporting['name_length'] = 'Item name should between 2 to 20 characters';
        }

        # Condition : Name
        $name = $this->itemService->where('items.name', $request->get('name'));
        if ($name->exists()) {
            $is_error = true;
            $reporting['name'] = 'Item name already registered';
        }

        # Condition : Quantity
        if (!$request->get('quantity') == null && $request->get('quantity') > 100) {
            $is_error = true;
            $reporting['quantity'] = 'The quantity should be less than or equal to 100';
        }

        # Condition : Unit Itms
        $unit = $this->unit->where('code', $request->get('unit_code'));
        if (!$unit->exists()) {
            $is_error = true;
            $reporting['unit_code'] = 'Invalid item unit, Available item unit(s) : kg, m, lt';
        }

        # Condition : Matches All Errors
        if ($is_error) {
            return redirect()->back()->with(['report' => $reporting]);
        }

        # Filter the requests
        $data = Arr::only($request->all(), ['category_code', 'unit_code', 'name', 'quantity']);
        $data['name'] = (string) $request->get('name');

        # User ID
        $data['user_id'] = Session::get('userdata')->id;

        # Generate item Code
        $data['code'] = (new CodeGenerator())->generate();

        # Insertion
        $exec = $this->itemService->add($data);

        if (!$exec) {
            return redirect()->back()->withErrors(['insert' => 'Insertion Failed, Please try again']);
        }

        return redirect()->back()->with(['success' => 'Insertion Success']);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $source = $this->itemService->where('items.id', $id);
        $result = [
            'page_title' => 'Edit',
            'category' => $this->category->get()->toArray(),
            'data' => $source->exists() ? $source->select([
                'items.id',
                'users.id',
                'items.category_code',
                'items.code',
                'items.name',
                'items.quantity',
                'items.unit_code',
                'items.user_id'
            ])->get()->toArray()[0] : [],
            'action' => 'update'
        ];

//        dd($result);

        return view('admin.manage')->with($result);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        # Validation
        $validation = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'category_code' => 'required|string',
            'unit_code' => 'required|string',
            'name' => 'required|string',
            'quantity' => 'nullable|numeric',
            'code' => 'required|string',
            'user_id' => 'required|string',
        ]);

        $is_error = '';
        $reporting = [];

        # Condition if Fails
        if ($validation->fails()) {
            return redirect()->back()->withErrors(['errors' => $validation->getMessageBag()]);
        }

        # Condition : Name Length
        if (strlen($request->get('name')) < 2) {
            $is_error = true;
            $reporting['name_length'] = 'Item name should between 2 to 20 characters';
        }

        # Condition : Quantity
        if (!$request->get('quantity') == null && $request->get('quantity') > 100) {
            $is_error = true;
            $reporting['quantity'] = 'The quantity should be less than or equal to 100';
        }

        # Condition : Unit Itms
        $unit = $this->unit->where('code', $request->get('unit_code'));
        if (!$unit->exists()) {
            $is_error = true;
            $reporting['unit_code'] = 'Invalid item unit, Available item unit(s) : kg, m, lt';
        }

        # Condition : Matches All Errors
        if ($is_error) {
            return redirect()->back()->with(['report' => $reporting]);
        }

        # Filter the requests
        $data = Arr::only($request->all(), ['id', 'category_code', 'unit_code', 'name', 'quantity', 'code', 'user_id']);
        $data['name'] = (string) $request->get('name');

        $tmp = [
            'items.category_code' => $data['category_code'],
            'items.unit_code' => $data['unit_code'],
            'items.name' => $data['name'],
            'items.code' => $data['code'],
            'items.quantity' => $data['quantity'],
            'items.user_id' => $data['user_id']
        ];

        # Update
        $exec = $this->itemService->where('items.id', $data['id'])->update($tmp);

        if (!$exec) {
            return redirect()->back()->withErrors(['insert' => 'Insertion Failed, Please try again']);
        }

        return redirect()->back()->with(['success' => 'Update Success']);
    }

    public function delete($id)
    {

    }
}
