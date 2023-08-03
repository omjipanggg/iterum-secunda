<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\PortalController as Portal;

Auth::routes(['verify' => true]);

// HOME
Route::get('/', [Home::class, 'index'])->name('home.index');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');
Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');
Route::post('subscription', [Home::class, 'subscription'])->name('home.subscription');

// DASHBOARD
Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard.index');

// PORTAL
Route::get('portal', [Portal::class, 'index'])->name('portal.index');
Route::post('portal', [Portal::class, 'index'])->name('portal.filter');
Route::get('portal/{slug}', [Portal::class, 'show'])->name('portal.show');


