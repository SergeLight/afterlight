<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WallController extends Controller
{


    public function showWallFeed(Request $request)
    {

        return view('wall.wall', [
            'page_css' => 'app_css.css',
            'page_js' => ''
        ]);
    }
}
