<?php

use App\Http\Controllers\CandidateController as Candidate;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\PartnerController as Partner;
use App\Http\Controllers\PortalController as Portal;
use App\Http\Controllers\ServerSideController as Server;
use App\Http\Controllers\TemplateController as Template;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\WebMasterController as Master;

use Illuminate\Support\Facades\Route;

// AUTHENTICATION
Auth::routes(['verify' => true]);

// HOME
Route::get('/', [Home::class, 'index'])->name('home.index');
Route::post('search', [Home::class, 'search'])->name('home.search');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');
Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');
Route::post('subscribe', [Home::class, 'subscribe'])->name('home.subscribe');
Route::get('unsubscribe/{email}', [Home::class, 'unsubscribe'])->name('home.unsubscribe');
Route::get('lounge', [Home::class, 'lounge'])->name('home.lounge')->middleware(['auth', 'relaxed', 'verified']);

// DASHBOARD
Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard.index');
Route::get('dashboard/faq', [Home::class, 'faq'])->name('dashboard.faq');

// TEMPLATE
Route::resource('template', Template::class);

// PORTAL-BY-CATEGORIES
Route::resource('portal/category', Category::class);

// PORTAL
Route::get('portal', [Portal::class, 'index'])->name('portal.index');
Route::post('portal', [Portal::class, 'index'])->name('portal.filter');
Route::get('portal/{slug}', [Portal::class, 'show'])->name('portal.show');

// SUPERUSER
Route::get('master', [Master::class, 'index'])->name('master.index');
Route::get('master/table/generate', [Master::class, 'generateTable'])->name('master.generateTable');
Route::get('master/{code}', [Master::class, 'fetch'])->name('master.fetch');
Route::get('master/{code}/fetch', [Master::class, 'fetchOnServer'])->name('master.fetchOnServer');
Route::get('master/{code}/import', [Master::class, 'import'])->name('master.import');
Route::post('master/{code}/import', [Master::class, 'importOnServer'])->name('master.importOnServer');
Route::get('master/{code}/fetch/{id}', [Master::class, 'show'])->name('master.show');
Route::get('master/{code}/create', [Master::class, 'create'])->name('master.create');
Route::post('master/{code}/store', [Master::class, 'store'])->name('master.store');
Route::get('master/{code}/edit/{id}', [Master::class, 'edit'])->name('master.edit');
Route::put('master/{code}/update/{id}', [Master::class, 'update'])->name('master.update');
Route::delete('master/{code}/delete/{id}', [Master::class, 'destroy'])->name('master.destroy');
Route::delete('master/delete/random', [Master::class, 'destroyThem'])->name('master.destroyThem');

// CANDIDATE
Route::get('profile', [Candidate::class, 'index'])->name('candidate.index');

// USER
Route::resource('user', User::class);

// PARTNER
Route::get('partner', [Partner::class, 'index'])->name('partner.index');

// SERVER
Route::get('server/{table}', [Server::class, 'selectProvider'])->name('server.selectProvider');