{{-- Admin Dashboard --}}
<x-admin.layouts.admin title="Dashboard">
    <h1 class="mb-4">Admin Dashboard</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Roles</h5>
                    <p class="card-text display-4">{{ \Spatie\Permission\Models\Role::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Managed Apps</h5>
                    <p class="card-text display-4">{{ \App\Models\ManagedApp::count() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.admin>
