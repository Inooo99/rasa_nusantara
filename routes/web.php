<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIK (Landing Page) ---
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/resep/{slug}', [LandingController::class, 'show'])->name('recipe.show'); // Halaman detail resep
Route::post('/subscribe', [LandingController::class, 'subscribe'])->name('subscribe');
Route::post('/resep/{slug}/comment', [LandingController::class, 'storeComment'])
    ->middleware('auth') // Wajib login kalau mau komen
    ->name('comment.store');


// --- 2. OTENTIKASI (Login & Logout Manual) ---
// Middleware 'guest' artinya hanya orang yang BELUM login yang bisa akses
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Middleware 'auth' artinya hanya orang yang SUDAH login yang bisa akses
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// --- 3. HALAMAN ADMIN (Dashboard & CRUD) ---
Route::middleware(['auth', IsAdmin::class])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{recipe}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{recipe}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{recipe}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

});


// --- 4. API KHUSUS (Untuk Live Search Ajax) ---
Route::get('/api/search', function (Request $request) {
    $query = Recipe::query()->with('category'); // Load relasi kategori

    // Filter Pencarian Judul
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter Kategori
    if ($request->has('category') && $request->category != '') {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $recipes = $query->latest()->limit(9)->get();

    // Format data agar mudah dibaca Javascript
    return $recipes->map(function($recipe) {
        return [
            'title' => $recipe->title,
            'slug' => $recipe->slug,
            'image' => $recipe->image,
            'description' => $recipe->description,
            'category_name' => $recipe->category->name
        ];
    });
})->name('api.recipes.search');