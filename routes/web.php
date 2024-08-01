<?php

use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController,
    LogoutController,
    ForgotPasswordController,
    ResetPasswordController
};
use App\Http\Controllers\{
    UserController,
    ProfileController,
    PostController,
    CommentController,
    HomeController,
    DashboardController
};

Route::middleware('no-cache')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

        Route::resource('comments', CommentController::class);
        Route::resource('posts', PostController::class);
        Route::post('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');

        Route::middleware('admin')->group(function () {
            Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard'); 
            Route::post('admin/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('admin.users.toggleRole');
            Route::post('admin/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('admin.users.toggleActive');
            Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
            Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
            Route::get('/admin/users/deleted', [UserController::class, 'deleted'])->name('admin.users.deleted');
            Route::post('/admin/users/{user}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
            Route::delete('/admin/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');
        });
    });
});
