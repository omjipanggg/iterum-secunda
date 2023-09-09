<?php
use App\Http\Controllers\Auth\RegisterController as Register;
use App\Http\Controllers\CandidateController as Candidate;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\ContractController as Contract;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\ExamController as Exam;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\PartnerController as Partner;
use App\Http\Controllers\PortalController as Portal;
use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\RecruitmentController as Recruitment;
use App\Http\Controllers\ScoreController as Score;
use App\Http\Controllers\ServerSideController as Server;
use App\Http\Controllers\TemplateController as Template;
use App\Http\Controllers\TestQuestion as Test;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\VacancyController as Vacancy;
use App\Http\Controllers\WebMasterController as Master;

use Illuminate\Support\Facades\Route;

// AUTHENTICATION
Auth::routes(['verify' => true]);
Route::get('register/partner', [Register::class, 'createPartner'])->name('register.createPartner');
Route::get('register/partner/{hash}', [Register::class, 'createInternal'])->name('register.createInternal');

// HOME
Route::get('/', [Home::class, 'index'])->name('home.index');
Route::post('search', [Home::class, 'search'])->name('home.search');
Route::get('download/{directory}/{file}', [Home::class, 'download'])->name('home.download');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');
Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');
Route::post('subscribe', [Home::class, 'subscribe'])->name('home.subscribe');
Route::get('unsubscribe/{email}', [Home::class, 'unsubscribe'])->name('home.unsubscribe');
Route::get('resume/{id}', [Home::class, 'downloadResume'])->name('home.downloadResume');
Route::get('report', [Home::class, 'report'])->name('home.report');
Route::get('lounge', [Home::class, 'lounge'])->name('home.lounge')->middleware(['auth', 'relaxed', 'verified']);

// DASHBOARD
Route::prefix('dashboard')->group(function() {
	Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
	Route::get('/faq', [Home::class, 'faq'])->name('dashboard.faq');
});

// TEMPLATE
Route::prefix('contract')->group(function() {
	Route::get('/', [Contract::class, 'index'])->name('contract.index');
	Route::get('offering', [Contract::class, 'offering'])->name('contract.offering');
	Route::post('offering/send', [Contract::class, 'sendOffering'])->name('contract.sendOffering');
	Route::get('list', [Contract::class, 'list'])->name('contract.list');
	Route::post('generate', [Contract::class, 'generate'])->name('contract.generate');
	Route::get('signed', [Contract::class, 'signed'])->name('contract.signed');
	Route::post('signed', [Contract::class, 'signedContract'])->name('contract.signedContract');
});

// TEMPLATE
Route::resource('template', Template::class);

// VACANCY
Route::prefix('vacancy')->group(function() {
	Route::get('category/create', [Vacancy::class, 'createCategory'])->name('vacancy.createCategory');
	Route::get('category/store', [Vacancy::class, 'storeCategory'])->name('vacancy.storeCategory');

	Route::get('partner/create', [Vacancy::class, 'createPartner'])->name('vacancy.createPartner');
	Route::get('partner/store', [Vacancy::class, 'storePartner'])->name('vacancy.storePartner');

	Route::get('project/create', [Vacancy::class, 'createProject'])->name('vacancy.createProject');
	Route::get('project/store', [Vacancy::class, 'storeProject'])->name('vacancy.storeProject');

	Route::get('question', [Vacancy::class, 'question'])->name('vacancy.question');
	Route::get('{vacancy}/publish', [Vacancy::class, 'publish'])->name('vacancy.publish');
	Route::get('{vacancy}/archive', [Vacancy::class, 'archive'])->name('vacancy.archive');
});
Route::resource('vacancy', Vacancy::class);

// EXAM
Route::prefix('exam')->group(function() {
	Route::resource('question', Test::class);
});
Route::resource('exam', Exam::class);

// PORTAL
Route::prefix('portal')->group(function() {
	Route::resource('category', Category::class);
	Route::get('/', [Portal::class, 'index'])->name('portal.index');
	Route::post('/', [Portal::class, 'index'])->name('portal.filter');
	Route::get('{slug}', [Portal::class, 'show'])->name('portal.show');
});

// CANDIDATE
Route::prefix('candidate')->group(function() {
	Route::get('/', [Candidate::class, 'index'])->name('candidate.index');
	Route::post('apply', [Candidate::class, 'apply'])->name('candidate.apply');
});

// SCORING
Route::prefix('score')->group(function() {
	Route::get('/', [Score::class, 'index'])->name('score.index');
});

// RECRUITMENT
Route::prefix('recruitment')->group(function() {
	Route::get('/', [Recruitment::class, 'index'])->name('recruitment.index');
	Route::get('filter', [Recruitment::class, 'filter'])->name('recruitment.filter');
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

// MASTER
Route::prefix('master')->group(function() {
	Route::get('/', [Master::class, 'index'])->name('master.index');
	Route::get('group', [Master::class, 'createMenu'])->name('master.createMenu');
	Route::post('group', [Master::class, 'storeMenu'])->name('master.storeMenu');
	Route::post('send/register', [Master::class, 'sendRegisterLink'])->name('master.sendRegisterLink');
	Route::get('random/generate', [Master::class, 'generateTable'])->name('master.generateTable');
	Route::delete('random/delete', [Master::class, 'destroyThem'])->name('master.destroyThem');
	Route::get('{code}/show', [Master::class, 'fetch'])->name('master.fetch');
	Route::get('{code}/show/fetch', [Master::class, 'fetchOnServer'])->name('master.fetchOnServer');
	Route::get('{code}/import', [Master::class, 'import'])->name('master.import');
	Route::post('{code}/import', [Master::class, 'importOnServer'])->name('master.importOnServer');
	Route::get('{code}/fetch/{id}', [Master::class, 'show'])->name('master.show');
	Route::get('{code}/create', [Master::class, 'create'])->name('master.create');
	Route::post('{code}/store', [Master::class, 'store'])->name('master.store');
	Route::get('{code}/edit/{id}', [Master::class, 'edit'])->name('master.edit');
	Route::put('{code}/update/{id}', [Master::class, 'update'])->name('master.update');
	Route::delete('{code}/delete/{id}', [Master::class, 'destroy'])->name('master.destroy');
});

// SERVER
Route::get('server/preview/{id}', [Server::class, 'showImageOnModal'])->name('server.showImageOnModal');
Route::get('server/candidates/fetch', [Server::class, 'fetchCandidate'])->name('server.fetchCandidate');
Route::get('server/vacancies/fetch', [Server::class, 'fetchVacancy'])->name('server.fetchVacancy');
Route::get('server/{table}', [Server::class, 'selectProvider'])->name('server.selectProvider');
Route::get('server/{table}/get/{id}', [Server::class, 'getForeignValue'])->name('server.getForeignValue');