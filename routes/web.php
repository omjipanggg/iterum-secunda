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
use App\Http\Controllers\ScheduleController as Schedule;
use App\Http\Controllers\ScoreController as Score;
use App\Http\Controllers\ServerSideController as Server;
use App\Http\Controllers\TemplateController as Template;
use App\Http\Controllers\SelfTestController as Test;
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
Route::get('download/{directory}/files/{file}', [Home::class, 'download'])->name('home.download');
Route::post('upload', [Home::class, 'upload'])->name('home.upload');
Route::get('settings', [Home::class, 'settings'])->name('home.settings');
Route::get('sitemap', [Home::class, 'sitemap'])->name('home.sitemap');
Route::post('subscribe', [Home::class, 'subscribe'])->name('home.subscribe');
Route::get('unsubscribe/{email}', [Home::class, 'unsubscribe'])->name('home.unsubscribe');
Route::get('report', [Home::class, 'report'])->name('home.report');
Route::get('lounge', [Home::class, 'lounge'])->name('home.lounge')->middleware(['auth', 'relaxed', 'verified']);

// DASHBOARD
Route::prefix('dashboard')->group(function() {
	Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
	Route::post('/', [Dashboard::class, 'search'])->name('dashboard.search');
	Route::get('report', [Dashboard::class, 'report'])->name('dashboard.report');
	Route::get('faq', [Dashboard::class, 'faq'])->name('dashboard.faq');
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

	Route::get('{vacancy}/publish', [Vacancy::class, 'publish'])->name('vacancy.publish');
	Route::get('{vacancy}/archive', [Vacancy::class, 'archive'])->name('vacancy.archive');

	Route::get('question', [Vacancy::class, 'question'])->name('vacancy.question');

	Route::get('{vacancy}/select', [Vacancy::class, 'formSelect'])->name('vacancy.formSelect');
	Route::post('{vacancy}/select', [Vacancy::class, 'select'])->name('vacancy.select');
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
	Route::post('apply', [Candidate::class, 'apply'])->name('candidate.apply');
	Route::get('resume/{id}/edit', [Candidate::class, 'editResume'])->name('candidate.editResume');
	Route::post('resume/{id}/update', [Candidate::class, 'updateResume'])->name('candidate.updateResume');
});
Route::resource('candidate', Candidate::class);

// SCORING
Route::prefix('score')->group(function() {
	Route::get('/', [Score::class, 'index'])->name('score.index');
});

// SCHEDULE
Route::prefix('schedule')->group(function() {
	Route::get('{vacancy}/interview/{candidate}/create', [Schedule::class, 'createSession'])->name('schedule.createSession');
	Route::post('{vacancy}/interview/{candidate}/store', [Schedule::class, 'storeSession'])->name('schedule.storeSession');

	Route::get('response/{schedule}/edit', [Schedule::class, 'editSession'])->name('schedule.editSession');
	Route::post('response/{schedule}/update', [Schedule::class, 'updateSession'])->name('schedule.updateSession');

	Route::get('session/{schedule}/create', [Schedule::class, 'createRescheduleSession'])->name('reschedule.createSession');
	Route::get('session/{schedule}/decline', [Schedule::class, 'declineRescheduleSession'])->name('reschedule.declineSession');
	Route::post('session/{schedule}/store', [Schedule::class, 'storeRescheduleSession'])->name('reschedule.storeSession');

	Route::get('{schedule}/interview/{response}/response', [Home::class, 'scheduleResponse'])->name('home.scheduleResponse');
});
Route::resource('schedule', Schedule::class);

// RECRUITMENT
Route::prefix('recruitment')->group(function() {
	Route::get('filter', [Recruitment::class, 'filter'])->name('recruitment.filter');
	Route::get('apply', [Recruitment::class, 'apply'])->name('recruitment.apply');
	Route::get('/', [Recruitment::class, 'index'])->name('recruitment.index');
	Route::get('{recruitment}', [Recruitment::class, 'show'])->name('recruitment.show');
});

// PROFILE
Route::prefix('profile')->group(function() {
	Route::get('personal/{profile}/edit', [Profile::class, 'editPersonalData'])->name('profile.editPersonalData');
	Route::post('personal/{profile}/update', [Profile::class, 'updatePersonalData'])->name('profile.updatePersonalData');

	Route::get('education/{profile}/edit', [Profile::class, 'editEducationData'])->name('profile.editEducationData');
	Route::post('education/{profile}/update', [Profile::class, 'updateEducationData'])->name('profile.updateEducationData');

	Route::get('experience/{profile}/edit', [Profile::class, 'editExperienceData'])->name('profile.editExperienceData');
	Route::post('experience/{profile}/update', [Profile::class, 'updateExperienceData'])->name('profile.updateExperienceData');

	Route::get('skill/{profile}/edit', [Profile::class, 'editSkillData'])->name('profile.editSkillData');
	Route::post('skill/{profile}/update', [Profile::class, 'updateSkillData'])->name('profile.updateSkillData');

	Route::get('family/{profile}/edit', [Profile::class, 'editFamilyData'])->name('profile.editFamilyData');
	Route::post('family/{profile}/update', [Profile::class, 'updateFamilyData'])->name('profile.updateFamilyData');

	Route::delete('{profile}/section/{section}/delete', [Profile::class, 'destroyData'])->name('profile.destroyData');
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
Route::get('server/vacancies/{id}/applied/fetch', [Server::class, 'fetchAppliedCandidates'])->name('server.fetchAppliedCandidates');
Route::get('server/vacancies/{id}/other/fetch', [Server::class, 'fetchOtherCandidates'])->name('server.fetchOtherCandidates');

Route::get('server/candidates/chart/fetch', [Server::class, 'chartCandidate'])->name('server.chartCandidate');
Route::get('server/partners/chart/fetch', [Server::class, 'chartPartner'])->name('server.chartPartner');
Route::get('server/vacancies/chart/fetch', [Server::class, 'chartVacancy'])->name('server.chartVacancy');

Route::get('server/{table}', [Server::class, 'selectProvider'])->name('server.selectProvider');
Route::get('server/{table}/get/{id}', [Server::class, 'getForeignValue'])->name('server.getForeignValue');

Route::get('server/development/{id}/fetch', [Server::class, 'fetchingTest'])->name('server.fetchingTest');