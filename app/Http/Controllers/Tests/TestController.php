<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;
use JetBrains\PhpStorm\NoReturn;

class TestController extends Controller
{
    private ItemService $itemService;

    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    public function index() {
        $data = $this->itemService->all();
        dd($data);
    }
}
