<?php
/* Developer: Olha Rosolovska */
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdClickController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieCrudController;
use App\Http\Controllers\Admin\GenreCrudController;
use App\Http\Controllers\Admin\TrailerCrudController;
use App\Http\Controllers\Admin\CampaignCrudController;
use App\Http\Controllers\Admin\PlacementCrudController;
use App\Http\Controllers\Admin\PostCrudController;
use App\Http\Controllers\Admin\PageCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{slug}/watch', [MovieController::class, 'watch'])->name('movies.watch');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

Route::get('/ads/{campaign}/click', [AdClickController::class, 'click'])->name('ads.click');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('movies', MovieCrudController::class)->except('show');
    Route::resource('genres', GenreCrudController::class)->except('show', 'create');
    Route::resource('trailers', TrailerCrudController::class)->only('index', 'store', 'destroy');
    Route::resource('campaigns', CampaignCrudController::class)->except('show');
    Route::resource('placements', PlacementCrudController::class)->except('show', 'create');
    Route::resource('posts', PostCrudController::class)->except('show');
    Route::resource('pages', PageCrudController::class)->except('show');
    Route::resource('users', UserCrudController::class)->except('show', 'create');
});
