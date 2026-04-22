<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(private BlogApiService $blogApi) {}

    public function index(Request $request): View
    {
        $page = $request->get('page', 1);
        $perPage = 15;

        $data = $this->blogApi->getPosts(['page' => $page, 'per_page' => $perPage]);

        $posts = $data['data'] ?? [];
        $meta = $data['meta'] ?? [];

        return view('admin.blog.posts.index', [
            'posts' => $posts,
            'meta' => $meta,
            'search' => $request->get('search'),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.posts.create', [
            'post' => null,
            'authors' => $this->fetchAuthors(),
            'categories' => $this->fetchCategories(),
            'tags' => $this->fetchTags(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'author_id' => ['required', 'integer'],
            'category_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'published' => ['boolean'],
            'tags' => ['array'],
        ]);

        $result = $this->blogApi->createPost($data);

        if ($result) {
            return redirect()->route('admin.blog.posts.index')
                ->with('success', 'Post created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create post.');
    }

    public function show(int $id): View
    {
        $data = $this->blogApi->getPost($id);

        return view('admin.blog.posts.show', ['post' => $data['data'] ?? null]);
    }

    public function edit(int $id): View
    {
        $data = $this->blogApi->getPost($id);
        $post = $data['data'] ?? null;

        return view('admin.blog.posts.edit', [
            'post' => $post,
            'authors' => $this->fetchAuthors(),
            'categories' => $this->fetchCategories(),
            'tags' => $this->fetchTags(),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'author_id' => ['sometimes', 'integer'],
            'category_id' => ['nullable', 'integer'],
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'content' => ['sometimes', 'string'],
            'published' => ['boolean'],
            'tags' => ['array'],
        ]);

        $result = $this->blogApi->updatePost($id, $data);

        if ($result) {
            return redirect()->route('admin.blog.posts.edit', $id)
                ->with('success', 'Post updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update post.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $result = $this->blogApi->deletePost($id);

        if ($result) {
            return redirect()->route('admin.blog.posts.index')
                ->with('success', 'Post deleted successfully.');
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('error', 'Failed to delete post.');
    }

    private function fetchAuthors(): array
    {
        $data = $this->blogApi->getUsers(['per_page' => 100]);

        return $data['data'] ?? [];
    }

    private function fetchCategories(): array
    {
        $data = $this->blogApi->getCategories(['per_page' => 100]);

        return $data['data'] ?? [];
    }

    private function fetchTags(): array
    {
        $data = $this->blogApi->getTags(['per_page' => 100]);

        return $data['data'] ?? [];
    }
}
