<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\HomeController as Home;

Auth::routes(['verify' => true]);

// GLOBAL
Route::get('/', [Home::class, 'index'])->name('home.index');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');

Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');

// DASHBOARD
Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard.index');


