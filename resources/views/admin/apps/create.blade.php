@php
/**
 * Create/Edit App Form View
 *
 * @var \App\Models\ManagedApp $app
 */
@endphp

<x-admin.layouts.admin title="{{ $app->exists ? 'Edit App' : 'Create App' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $app->exists ? 'Edit App' : 'Create App' }}</h1>

    <form method="POST" action="{{ $app->exists ? route('admin.apps.update', $app) : route('admin.apps.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-lg">
        @csrf
        @if($app->exists) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $app->name) }}"
                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $app->slug) }}"
                class="w-full border rounded px-3 py-2 @error('slug') border-red-500 @enderror" required>
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">API URL</label>
            <input type="url" name="api_url" value="{{ old('api_url', $app->api_url) }}"
                placeholder="https://blog.example.com/api"
                class="w-full border rounded px-3 py-2 @error('api_url') border-red-500 @enderror" required>
            @error('api_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">API Token</label>
            <input type="text" name="api_token" value="{{ old('api_token', $app->api_token) }}"
                placeholder="{{ $app->exists ? '(leave blank to keep current)' : '(auto-generated if empty)' }}"
                class="w-full border rounded px-3 py-2 @error('api_token') border-red-500 @enderror">
            @error('api_token') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @if($app->exists && $app->api_token)
                <p class="text-gray-500 text-xs mt-1">Leave blank to keep current token.</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $app->is_active ?? true) ? 'checked' : '' }}
                    class="mr-2">
                <span class="text-gray-700 text-sm">Active</span>
            </label>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $app->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.apps.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</x-admin.layouts.admin>
