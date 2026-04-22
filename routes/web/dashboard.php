<?php declare(strict_types=1);

use App\Http\Controllers\DashboardController as Dashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->get('/dashboard', [Dashboard::class, 'index'])
    ->name('dashboard');
