{{-- Admin Blog Users Create/Edit --}}
<x-admin.layouts.admin title="{{ $user ? 'Edit User' : 'Create User' }}">
    <h1 class="text-2xl font-bold mb-6">{{ $user ? 'Edit User' : 'Create User' }}</h1>

    <form method="POST" action="{{ $user ? route('admin.blog.users.update', $user['id']) : route('admin.blog.users.store') }}"
        class="bg-white p-6 rounded-lg shadow max-w-lg">
        @csrf
        @if($user) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $user['name'] ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user['email'] ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" value="{{ old('username', $user['username'] ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password {{ $user ? '(leave blank)' : '' }}</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" {{ $user ? '' : 'required' }}>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">About</label>
            <textarea name="about" rows="2" class="w-full border rounded px-3 py-2">{{ old('about', $user['about'] ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ ($user['is_active'] ?? true) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm">Active</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_admin" value="1" {{ ($user['is_admin'] ?? false) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm">Admin</span>
            </label>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ $user ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.blog.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</x-admin.layouts.admin>
