<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductService;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CartService $cartService
    ){}
    public function index()
    {
        $products = $this->productService->getActiveProducts();
        $cart_count = $this->cartService->count();
        return view('front.home', compact('products','cart_count'));

    }
    public function contact()
    {
        return view('front.contact');
    }
    public function AboutUs() {
        return view('front.about-us');
    }
    public function HaventFountTheAnswer() {
        return view('front.faq');
    }
}
