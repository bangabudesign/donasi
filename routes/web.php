<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\ZakatController as AdminZakatController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');

Route::get('/campaigns/{slug}/donation-amount', [DonationController::class, 'amount'])->name('donation.amount');
Route::get('/campaigns/{slug}/payment-option', [DonationController::class, 'payment'])->name('donation.payment');
Route::get('/campaigns/{slug}/contribute', [DonationController::class, 'contribute'])->name('donation.contribute');
Route::post('/campaigns/{slug}/contribute', [DonationController::class, 'store'])->name('donation.store');

Route::get('/zakat', [ZakatController::class, 'category'])->name('zakat.category');
Route::get('/zakat/{id}/payment-option', [ZakatController::class, 'payment'])->name('zakat.payment');
Route::get('/zakat/{id}/contribute', [ZakatController::class, 'contribute'])->name('zakat.contribute');
Route::post('/zakat/{id}/contribute', [ZakatController::class, 'store'])->name('zakat.store');

Route::get('/transaction/{invoice}', [TransactionController::class, 'invoice'])->name('transaction.invoice');
Route::put('/transaction/{invoice}', [TransactionController::class, 'confirm'])->name('transaction.confirm');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('categories/campaign/{category}', [CategoryController::class, 'campaign'])->name('categories.campaign');

Route::prefix('sahabatummat')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::get('/', function () {
        return redirect('/sahabatummat/dashboard');
    });
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // campaigns
    Route::get('campaigns', [AdminCampaignController::class, 'index'])->name('campaigns.index');
    Route::get('campaigns/create', [AdminCampaignController::class, 'create'])->name('campaigns.create');
    Route::post('campaigns', [AdminCampaignController::class, 'store'])->name('campaigns.store');
    Route::get('campaigns/{id}', [AdminCampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('campaigns/{id}', [AdminCampaignController::class, 'update'])->name('campaigns.update');
    // donations
    Route::get('donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::get('donations/create', [AdminDonationController::class, 'create'])->name('donations.create');
    Route::post('donations', [AdminDonationController::class, 'store'])->name('donations.store');
    Route::get('donations/{id}', [AdminDonationController::class, 'edit'])->name('donations.edit');
    Route::put('donations/{id}', [AdminDonationController::class, 'update'])->name('donations.update');
    // zakat
    Route::get('zakat', [AdminZakatController::class, 'index'])->name('zakat.index');
    Route::get('zakat/create', [AdminZakatController::class, 'create'])->name('zakat.create');
    Route::post('zakat', [AdminZakatController::class, 'store'])->name('zakat.store');
    Route::get('zakat/{id}', [AdminZakatController::class, 'edit'])->name('zakat.edit');
    Route::put('zakat/{id}', [AdminZakatController::class, 'update'])->name('zakat.update');
    // users
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('users/{id}', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    // posts
    Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::post('posts', [AdminPostController::class, 'store'])->name('posts.store');
    Route::get('posts/{id}', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');
    // payment methods
    Route::get('payment-methods', [AdminPaymentMethodController::class, 'index'])->name('payment_methods.index');
    Route::get('payment-methods/create', [AdminPaymentMethodController::class, 'create'])->name('payment_methods.create');
    Route::post('payment-methods', [AdminPaymentMethodController::class, 'store'])->name('payment_methods.store');
    Route::get('payment-methods/{id}', [AdminPaymentMethodController::class, 'edit'])->name('payment_methods.edit');
    Route::put('payment-methods/{id}', [AdminPaymentMethodController::class, 'update'])->name('payment_methods.update');
    // banners
    Route::get('banners', [AdminBannerController::class, 'index'])->name('banners.index');
    Route::get('banners/create', [AdminBannerController::class, 'create'])->name('banners.create');
    Route::post('banners', [AdminBannerController::class, 'store'])->name('banners.store');
    Route::get('banners/{id}', [AdminBannerController::class, 'edit'])->name('banners.edit');
    Route::put('banners/{id}', [AdminBannerController::class, 'update'])->name('banners.update');
    // categories
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
});