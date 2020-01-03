<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class StaticPagesController extends Controller
{
    //
    public function home()
    {
        # code...
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('static_pages/home', compact('feed_items'));
    }

    public function help()
    {
        # code...
        return view('static_pages/help');
    }

    public function about()
    {
        # code...
        return view('static_pages/about');
    }
}
