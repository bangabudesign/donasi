<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PostController;

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
Route::get('/donation/{donation}', [DonationController::class, 'invoice'])->name('donation.invoice');
Route::put('/donation/{donation}', [DonationController::class, 'confirm'])->name('donation.confirm');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('sahabatummat')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::redirect('/', '/sahabatummat/dashboard');
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
});