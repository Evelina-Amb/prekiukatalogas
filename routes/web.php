<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\PasswordChangeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\ProductController;

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
    return view('Dashboard');
});

// Dashboard — only for authenticated + verified users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//katalogas
Route::get('/katalogas', function () {
    return view('katalogas');
})->middleware(['auth'])->name('katalogas');


// Route for updating user information (name, email, etc.)
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Route for changing the password
Route::middleware(['auth'])->group(function () {
    Route::put('/profile/password', [PasswordController::class, 'update'])->name('password.update');
});

// Route for pdf
Route::get('/katalogas/pdf', [ProductController::class, 'exportPdf'])->name('katalogas.pdf');

//Route for new produktas
Route::post('/verify-company', [ProductController::class, 'verifyCode'])->name('company.verify');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

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

Route::get('/katalogas', [ProductController::class, 'index'])->name('katalogas');

require __DIR__.'/auth.php';