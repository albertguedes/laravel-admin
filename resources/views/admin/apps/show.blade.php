@php
/**
 * App Show View
 *
 * @var \App\Models\ManagedApp $app
 */
@endphp

<x-admin.layouts.admin title="App Details">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">App Details</h1>
        <a href="{{ route('admin.apps.index') }}" class="text-blue-600 hover:text-blue-900">Back to List</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-4">
            <label class="font-semibold text-gray-700">ID:</label>
            <p class="text-gray-900">{{ $app->id }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Name:</label>
            <p class="text-gray-900">{{ $app->name }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Slug:</label>
            <p class="text-gray-900 font-mono">{{ $app->slug }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">API URL:</label>
            <p class="text-gray-900">{{ $app->api_url }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">API Token:</label>
            <p class="text-gray-900 font-mono text-sm bg-gray-100 p-2 rounded">{{ $app->api_token ?? '—' }}</p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Status:</label>
            <p class="text-gray-900">
                <span class="px-2 py-1 text-xs rounded {{ $app->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $app->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Admins:</label>
            <div class="mt-1">
                @forelse($app->admins as $admin)
                    <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $admin->name }}</span>
                @empty
                    <span class="text-gray-400">No admins assigned</span>
                @endforelse
            </div>
        </div>
        <div class="flex space-x-2 mt-6">
            <a href="{{ route('admin.apps.edit', $app) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.apps.destroy', $app) }}"
                onsubmit="return confirm('Delete this app?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</x-admin.layouts.admin>
