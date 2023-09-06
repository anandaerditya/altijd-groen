<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected Auth $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    /**
     * @return RedirectResponse|void
     */
    public function index()
    {
        $session = Session::get('userdata');
        if (empty($session)){
            return redirect()->route('user.login')->withErrors(['error' => 'You should login to access this page']);
        }

//        return redirect()->route('admin.home');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function login(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login')->with(['page_title' => 'Login']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function processLogin(Request $request)
    {
        # Validation
        $validation = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        # Condition if Fails
        if ($validation->fails()) {
            return redirect()->back()->withErrors(['errors' => $validation->getMessageBag()]);
        }

        # Filter the requests
        $data = Arr::only($request->all(), ['username', 'password']);

        # Auth - Process Login
        $auth = Auth::attempt($data);

        if (!$auth) {
            return redirect()->back()->withErrors(['invalid' => 'Invalid username or password']);
        }

        Session::put('userdata', Auth::user());
        return redirect()->route('admin.home');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('user.login');
    }
}
