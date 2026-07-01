<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreProductRequest;
use App\Http\Requests\Web\UpdateProductRequest;
use App\Models\Category;
use App\Models\Flag;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getProductsForDashboard();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create',[
            'product' => new Product(),
            'categories' => Category::all(),
            'tags' => '',
            'flags' => Flag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        $this->productService->storeFromDashboard($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->find($id);

        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->productService->getEditData($id);
        return view('dashboard.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data=$request->validated();
        $file = $request->file('image');
        $this->productService->updateWithTags($id,$data,$file);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productService->deleteByID($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
