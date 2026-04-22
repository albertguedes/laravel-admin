<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private BlogApiService $blogApi) {}

    public function index(Request $request): View
    {
        $data = $this->blogApi->getCategories(['page' => $request->get('page', 1), 'per_page' => 15]);

        return view('admin.blog.categories.index', [
            'categories' => $data['data'] ?? [],
            'meta' => $data['meta'] ?? [],
            'search' => $request->get('search'),
        ]);
    }

    public function create(): View
    {
        $categoriesData = $this->blogApi->getCategories(['per_page' => 100]);
        $categories = $categoriesData['data'] ?? [];

        return view('admin.blog.categories.create', [
            'category' => null,
            'parentCategories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        $result = $this->blogApi->createCategory($data);

        if ($result) {
            return redirect()->route('admin.blog.categories.index')
                ->with('success', 'Category created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create category.');
    }

    public function show(int $id): View
    {
        $data = $this->blogApi->getCategory($id);

        return view('admin.blog.categories.show', ['category' => $data['data'] ?? null]);
    }

    public function edit(int $id): View
    {
        $data = $this->blogApi->getCategory($id);
        $category = $data['data'] ?? null;

        $categoriesData = $this->blogApi->getCategories(['per_page' => 100]);
        $categories = $categoriesData['data'] ?? [];

        return view('admin.blog.categories.edit', [
            'category' => $category,
            'parentCategories' => $categories,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'integer'],
            'title' => ['sometimes', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        $result = $this->blogApi->updateCategory($id, $data);

        if ($result) {
            return redirect()->route('admin.blog.categories.edit', $id)
                ->with('success', 'Category updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update category.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->blogApi->deleteCategory($id);

        if ($result) {
            return redirect()->route('admin.blog.categories.index')
                ->with('success', 'Category deleted successfully.');
        }

        return redirect()->route('admin.blog.categories.index')
            ->with('error', 'Failed to delete category.');
    }
}
