<?php declare(strict_types=1);

use App\Http\Controllers\Blog\CategoryController as BlogCategoryController;
use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\Blog\TagController as BlogTagController;
use App\Http\Controllers\Blog\UserController as BlogUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/posts', [BlogPostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [BlogPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [BlogPostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{id}', [BlogPostController::class, 'show'])->name('posts.show');
        Route::get('/posts/{id}/edit', [BlogPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{id}', [BlogPostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{id}', [BlogPostController::class, 'destroy'])->name('posts.destroy');

        Route::get('/categories', [BlogCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [BlogCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [BlogCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}', [BlogCategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/{id}/edit', [BlogCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [BlogCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [BlogCategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/tags', [BlogTagController::class, 'index'])->name('tags.index');
        Route::get('/tags/create', [BlogTagController::class, 'create'])->name('tags.create');
        Route::post('/tags', [BlogTagController::class, 'store'])->name('tags.store');
        Route::get('/tags/{id}', [BlogTagController::class, 'show'])->name('tags.show');
        Route::get('/tags/{id}/edit', [BlogTagController::class, 'edit'])->name('tags.edit');
        Route::put('/tags/{id}', [BlogTagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{id}', [BlogTagController::class, 'destroy'])->name('tags.destroy');

        Route::get('/users', [BlogUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [BlogUserController::class, 'create'])->name('users.create');
        Route::post('/users', [BlogUserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [BlogUserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [BlogUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [BlogUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [BlogUserController::class, 'destroy'])->name('users.destroy');
    });
});
