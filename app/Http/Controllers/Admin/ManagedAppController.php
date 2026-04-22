<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManagedApp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ManagedAppController extends Controller
{
    public function index(Request $request): View
    {
        $apps = ManagedApp::when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('slug', 'like', "%{$s}%"))
            ->paginate(15);

        return view('admin.apps.index', [
            'apps' => $apps,
            'search' => $request->search,
        ]);
    }

    public function create(): View
    {
        return view('admin.apps.create', ['app' => new ManagedApp]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:managed_apps,slug'],
            'api_url' => ['required', 'url'],
            'api_token' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        if (empty($validated['api_token'])) {
            $validated['api_token'] = Str::random(64);
        }

        $app = ManagedApp::create($validated);

        return redirect()->route('admin.apps.index')
            ->with('success', 'App created successfully. API Token: '.$app->api_token);
    }

    public function show(ManagedApp $app): View
    {
        return view('admin.apps.show', ['app' => $app->load('admins')]);
    }

    public function edit(ManagedApp $app): View
    {
        return view('admin.apps.edit', ['app' => $app]);
    }

    public function update(Request $request, ManagedApp $app): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:managed_apps,slug,'.$app->id],
            'api_url' => ['required', 'url'],
            'api_token' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        if (! empty($validated['api_token'])) {
            $validated['api_token'] = $validated['api_token'];
        } else {
            unset($validated['api_token']);
        }

        $app->update($validated);

        return redirect()->route('admin.apps.edit', $app)
            ->with('success', 'App updated successfully.');
    }

    public function destroy(ManagedApp $app): RedirectResponse
    {
        $app->delete();

        return redirect()->route('admin.apps.index')
            ->with('success', 'App deleted successfully.');
    }
}
