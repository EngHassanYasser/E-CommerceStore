<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}
    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'category' => new Category,
            'parents' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(CategoryRequest $request)
    {
        $file = $request->file('image');
        $data = $request->validated();
        
        $this->categoryService->add($file,$data);

        return redirect()->route('categories.index')
            ->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = $this->categoryService->getEditeData($id);
            return view('dashboard.categories.edite', $data);
        } catch (Exception $e) {
            throw $e;
            return redirect()->route('categories.index')->with('info', 'category not found');
        }
    }
    public function update(CategoryRequest $request, $id)
    {

        $data = $request->validated();
        $file = $request->file('image');
        if (! $file || ! $file->isValid()) {
            $file = null;
        }
        $this->categoryService->updateCategory($id, $data, $file);

        return redirect()->route('categories.index')
            ->with('success', 'Category Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryService->deleteById($id);

        return redirect()->route('categories.index')->with('success', 'category deleted successfully');
    }

    public function trash()
    {
        $categories = $this->categoryService->findTrashesForDashboard();

        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $this->categoryService->restoryByID($id);

        return redirect()->route('categories.trash')->with('success', 'category restored successfully');
    }

    public function forceDelete($id)
    {
        $this->categoryService->forceDeleteById($id);
        return redirect()->route('categories.trash')->with('success', 'category deleted permanently');
    }
}
