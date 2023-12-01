<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user() && Auth::user()->role == 1) {
            return view('admin.home');
        } else {
            $categories = Category::with('products')->where('status', true)->limit(2)->get();
            if (Auth::user()) {
                $wishlist = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();;
                return view('home.user_home_page', [
                    'categories' => $categories,
                    'wishlist' => $wishlist
                ]);
            }
            return view('home.user_home_page', ['categories' => $categories]);
        }
    }
}
