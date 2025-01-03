<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\SetLocale;

// Middleware untuk mengatur bahasa
Route::middleware([SetLocale::class])->group(function () {
    
    // Home
    Route::get('/', [ArticleController::class, 'home'])->name('home');
    
    // Public Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');
    
    // Public Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
    
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        return redirect($request->input('redirect_to', '/'));
    })->name('logout');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
    
    // Authenticated Routes
    Route::middleware(['auth'])->group(function () {
        // My Articles
        Route::get('/myarticle', [ArticleController::class, 'myArticles'])->name('myarticle');
        Route::get('/myarticle/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/myarticle', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/myarticle/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/myarticle/{id}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/myarticle/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        Route::put('/myarticle/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
        
        // My Blogs
        Route::get('/myblogs', [BlogController::class, 'myBlogs'])->name('myblogs');
        Route::get('/myblogs/create', [BlogController::class, 'create'])->name('myblogs.create');
        Route::post('/myblogs/store-draft', [BlogController::class, 'storeDraft'])->name('myblogs.storeDraft');
        Route::post('/myblogs/publish-draft', [BlogController::class, 'publishDraft'])->name('myblogs.publishDraft');
        Route::get('/myblogs/{id}/edit', [BlogController::class, 'edit'])->name('myblogs.edit');
        Route::put('/myblogs/{id}', [BlogController::class, 'update'])->name('myblogs.update');
        Route::delete('/myblogs/{id}', [BlogController::class, 'destroy'])->name('myblogs.destroy');
        
        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings/change-password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });
    
    
});