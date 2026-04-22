{{-- Admin Dashboard --}}
<x-admin.layouts.admin title="Dashboard">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Roles</h3>
            <p class="text-3xl font-bold">{{ \Spatie\Permission\Models\Role::count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Managed Apps</h3>
            <p class="text-3xl font-bold">{{ \App\Models\ManagedApp::count() }}</p>
        </div>
    </div>
</x-admin.layouts.admin>
