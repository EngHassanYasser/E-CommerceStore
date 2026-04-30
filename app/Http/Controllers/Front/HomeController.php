<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();

        return view('front.home', compact('products'));

    }
    public function contact()
    {
        return view('front.contact');
    }
    public function BlogGridSideBar() {
        return view('front.blog-grid-sidbar');
    }
    public function AboutUs() {
        return view('front.about-us');
    }
}
