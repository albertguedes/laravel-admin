<x-layouts.main title="Dashboard">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted">Total Users</h6>
                            <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-shield fa-2x text-success"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted">Total Roles</h6>
                            <h3 class="mb-0">{{ \Spatie\Permission\Models\Role::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-rocket fa-2x text-warning"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted">Managed Apps</h6>
                            <h3 class="mb-0">{{ \App\Models\ManagedApp::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Welcome</h5>
        </div>
        <div class="card-body">
            <p class="mb-0 text-muted">
                You are logged in to the Laravel Admin Panel. Use the sidebar navigation to manage users, roles, applications, and blog content.
            </p>
        </div>
    </div>
</x-layouts.main>
