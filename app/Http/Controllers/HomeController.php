<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id');
        return view('index', compact('categories'));
        
    }
}