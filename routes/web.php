<?php

use App\Http\Controllers\CandidateController as Candidate;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\PartnerController as Partner;
use App\Http\Controllers\PortalController as Portal;
use App\Http\Controllers\ProfileController as Profile;
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
Route::get('download/{directory}/{file}', [Home::class, 'download'])->name('home.download');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');
Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');
Route::post('subscribe', [Home::class, 'subscribe'])->name('home.subscribe');
Route::get('unsubscribe/{email}', [Home::class, 'unsubscribe'])->name('home.unsubscribe');
Route::get('resumes/{id}', [Home::class, 'downloadResume'])->name('home.downloadResume');
Route::get('lounge', [Home::class, 'lounge'])->name('home.lounge')->middleware(['auth', 'relaxed', 'verified']);

// DASHBOARD
Route::prefix('dashboard')->group(function() {
	Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
	Route::get('/faq', [Home::class, 'faq'])->name('dashboard.faq');
});

// TEMPLATE
Route::resource('template', Template::class);

// PORTAL
Route::prefix('portal')->group(function() {
	Route::resource('category', Category::class);
	Route::get('/', [Portal::class, 'index'])->name('portal.index');
	Route::post('/', [Portal::class, 'index'])->name('portal.filter');
	Route::get('{slug}', [Portal::class, 'show'])->name('portal.show');
});

// SUPERUSER
Route::prefix('master')->group(function() {
	Route::get('/', [Master::class, 'index'])->name('master.index');
	Route::get('random/generate', [Master::class, 'generateTable'])->name('master.generateTable');
	Route::delete('random/delete', [Master::class, 'destroyThem'])->name('master.destroyThem');
	Route::get('{code}', [Master::class, 'fetch'])->name('master.fetch');
	Route::get('{code}/fetch', [Master::class, 'fetchOnServer'])->name('master.fetchOnServer');
	Route::get('{code}/import', [Master::class, 'import'])->name('master.import');
	Route::post('{code}/import', [Master::class, 'importOnServer'])->name('master.importOnServer');
	Route::get('{code}/fetch/{id}', [Master::class, 'show'])->name('master.show');
	Route::get('{code}/create', [Master::class, 'create'])->name('master.create');
	Route::post('{code}/store', [Master::class, 'store'])->name('master.store');
	Route::get('{code}/edit/{id}', [Master::class, 'edit'])->name('master.edit');
	Route::put('{code}/update/{id}', [Master::class, 'update'])->name('master.update');
	Route::delete('{code}/delete/{id}', [Master::class, 'destroy'])->name('master.destroy');
});

// CANDIDATE
Route::prefix('candidate')->group(function() {
	Route::get('/', [Candidate::class, 'index'])->name('candidate.index');
	Route::post('apply', [Candidate::class, 'apply'])->name('candidate.apply');
});

// PROFILE
Route::prefix('profile')->group(function() {
	Route::get('personal/{id}/edit', [Profile::class, 'editPersonalData'])->name('profile.editPersonalData');
	Route::post('personal/{id}/update', [Profile::class, 'updatePersonalData'])->name('profile.updatePersonalData');

	Route::get('education/{id}/edit', [Profile::class, 'editEducationData'])->name('profile.editEducationData');
	Route::post('education/{id}/update', [Profile::class, 'updateEducationData'])->name('profile.updateEducationData');

	Route::get('experience/{id}/edit', [Profile::class, 'editExperienceData'])->name('profile.editExperienceData');
	Route::post('experience/{id}/update', [Profile::class, 'updateExperienceData'])->name('profile.updateExperienceData');

	Route::get('skill/{id}/edit', [Profile::class, 'editSkillData'])->name('profile.editSkillData');
	Route::post('skill/{id}/update', [Profile::class, 'updateSkillData'])->name('profile.updateSkillData');

	Route::get('family/{id}/edit', [Profile::class, 'editFamilyData'])->name('profile.editFamilyData');
	Route::post('family/{id}/update', [Profile::class, 'updateFamilyData'])->name('profile.updateFamilyData');
});
Route::resource('profile', Profile::class);

// USER
Route::resource('user', User::class);

// PARTNER
Route::prefix('partner')->group(function() {
	Route::get('/', [Partner::class, 'index'])->name('partner.index');
});

// SERVER
Route::get('server/{table}', [Server::class, 'selectProvider'])->name('server.selectProvider');