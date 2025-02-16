<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $user = Auth::user();
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->get();

        return view('pages.home'
        , [
            'categories' => $categories,
            'products' => $products,
            'user' =>$user,
            'banner' =>$banner
        ]
    );

    }
}
