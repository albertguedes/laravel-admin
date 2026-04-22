<?php declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthenticatedSession;
use App\Http\Controllers\Auth\ConfirmablePasswordController as ConfirmablePassword;
use App\Http\Controllers\Auth\EmailVerificationNotificationController as EmailVerificationNotification;
use App\Http\Controllers\Auth\EmailVerificationPromptController as EmailVerificationPrompt;
use App\Http\Controllers\IndexController as Index;
use App\Http\Controllers\Auth\NewPasswordController as NewPassword;
use App\Http\Controllers\Auth\PasswordController as Password;
use App\Http\Controllers\Auth\PasswordResetLinkController as PasswordResetLink;
use App\Http\Controllers\Auth\VerifyEmailController as VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () 
{
    Route::get('/',Index::class)->name('home');

    // Login Routes
    Route::get('login', [AuthenticatedSession::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSession::class, 'store']);

    // Password Reset Routes
    Route::get('forgot-password', [PasswordResetLink::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLink::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPassword::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPassword::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () 
{
    Route::get('verify-email', EmailVerificationPrompt::class)
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmail::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotification::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePassword::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePassword::class, 'store']);

    Route::put('password', [Password::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSession::class, 'destroy'])
        ->name('logout');
});
