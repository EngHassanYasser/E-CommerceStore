<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreProductRequest;
use App\Http\Requests\Web\UpdateProductRequest;
use App\Repositories\Product\ProductRepository;
use App\Services\ProductService;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected ProductService $productService,
        protected ProductRepository $productRepository,
        )
    {}

    public function index()
    {
        $products = $this->productRepository->getProductsForDashboard();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $data = $this->productRepository->getCreateFormData();

        return view('dashboard.products.create', $data);
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
        $product = $this->productRepository->find($id);

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
       $this->productService->update($id, $request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productRepository->deleteByID($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
