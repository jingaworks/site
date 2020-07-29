<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function test(Request $request)
    {
        if($request['subcat']) {
            $products = Product::where('subcategory_id', $request['subcat'])
                        ->orderBy('created_at', 'desc')
                        ->get();
        } else {
            $products = Product::orderBy('created_at', 'desc')->get();
        }
        return view('welcome', compact('products'));
    }
}