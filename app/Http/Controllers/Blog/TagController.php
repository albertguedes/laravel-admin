<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct(private BlogApiService $blogApi) {}

    public function index(Request $request): View
    {
        $data = $this->blogApi->getTags(['page' => $request->get('page', 1), 'per_page' => 15]);

        return view('admin.blog.tags.index', [
            'tags' => $data['data'] ?? [],
            'meta' => $data['meta'] ?? [],
            'search' => $request->get('search'),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.tags.create', ['tag' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        $result = $this->blogApi->createTag($data);

        if ($result) {
            return redirect()->route('admin.blog.tags.index')
                ->with('success', 'Tag created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create tag.');
    }

    public function show(int $id): View
    {
        $data = $this->blogApi->getTag($id);

        return view('admin.blog.tags.show', ['tag' => $data['data'] ?? null]);
    }

    public function edit(int $id): View
    {
        $data = $this->blogApi->getTag($id);

        return view('admin.blog.tags.edit', ['tag' => $data['data'] ?? null]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        $result = $this->blogApi->updateTag($id, $data);

        if ($result) {
            return redirect()->route('admin.blog.tags.edit', $id)
                ->with('success', 'Tag updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update tag.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->blogApi->deleteTag($id);

        if ($result) {
            return redirect()->route('admin.blog.tags.index')
                ->with('success', 'Tag deleted successfully.');
        }

        return redirect()->route('admin.blog.tags.index')
            ->with('error', 'Failed to delete tag.');
    }
}
