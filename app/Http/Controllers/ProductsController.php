<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\StoreProductRequest;
use App\Http\Requests\Web\UpdateProductRequest;
use App\Http\Requests\Api\StoreProductRequest as StoreProductRequestApi;
use App\Http\Requests\Api\UpdateProductRequest as UpdateProductRequestApi;
use App\Models\Category;
use App\Models\Flag;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $products = $this->productService->getProductsForDashboard();

        if ($request->expectsJson()) {
            return $this->productService->getProductsForApi($request->query());
        }
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
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
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
    public function storeApi(StoreProductRequestApi $request)
    {
        return $this->productService->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->find($id);

        return view('dashboard.products.show', compact('product'));
    }
    public function showModel(Product $product)
    {
        if ($product->status != 'active') {
            abort(404);
        }
        return view('front.products.show', compact('product'));
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
        $data = $request->validated();
        $file = $request->file('image');

        $this->productService->updateWithTags($id, $data, $file);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function updateApi(UpdateProductRequestApi $request, Product $product)
    {
        return $this->productService->update($product, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $product = $this->productService->deleteByID($id);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Product deleted successfully',
                'product' => $product,
            ], 200);
        }
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
