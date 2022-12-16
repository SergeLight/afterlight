<?php

namespace App\Http\Controllers;

use App\Classes\StaticsHandler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(): Factory|View|Application
    {

        return view('index', [
            'page_css' => 'app_css.css',
            'page_js' => ''
        ]);
    }
}
