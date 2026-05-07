<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Models\product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProductsController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        )
    {
        $this->authorizeResource(product::class, 'product');
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->productRepository->getProductsForApi($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', product::class);
        $Product = $this->productRepository->store($request->validated());
        return $Product;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
       return $this->productRepository->update($product, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', product::class);

        if (! Auth::user()->tokenCan('product.delete')) {
            abort(403, 'Unauthorized');
        }
        $product = $this->productRepository->deleteByID($id);

        return response()->json([
            'message' => 'Product deleted successfully',
            'product' => $product,
        ], 200);
    }
}
