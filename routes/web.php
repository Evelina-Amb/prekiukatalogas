<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes handle your application's main views, authentication,
| email verification, and user profile management.
|
*/

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard — only for authenticated + verified users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Custom email verification route (works even if user is logged out)
Route::get('/custom-verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    // Validate the signed URL
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Invalid or expired verification link.');
    }

    // Log in the user temporarily
    auth()->loginUsingId($user->id);

    // Mark the email as verified if not already
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Illuminate\Auth\Events\Verified($user));
    }

    return redirect('/dashboard')->with('status', 'Email verified!');
})->middleware(['signed'])->name('custom.verification');

// Include Breeze's auth routes (login, register, etc.)
require __DIR__.'/auth.php';
