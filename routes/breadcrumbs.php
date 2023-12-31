<?php
use App\Models\TableCode;
use App\Models\Candidate;
use App\Models\InterviewSchedule as Schedule;
use App\Models\Vacancy;
use App\Models\VacancyCategory;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use Illuminate\Support\Str;

Breadcrumbs::for('master.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('master.index'));
});

Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard.index'));
});

Breadcrumbs::for('dashboard.search', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Search', route('dashboard.search'));
});

Breadcrumbs::for('dashboard.faq', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('FAQ', route('dashboard.faq'));
});

Breadcrumbs::for('master.fetch', function (BreadcrumbTrail $trail, TableCode $table) {
    $trail->parent('master.index');
    $trail->push(Str::headline($table->label), route('master.fetch', $table));
});

Breadcrumbs::for('home.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home.index'));
});

Breadcrumbs::for('master.createMenu', function (BreadcrumbTrail $trail) {
    $trail->parent('master.index');
    $trail->push('Hak Akses', route('master.createMenu'));
});

Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('master.index');
    $trail->push('Akun Terdaftar', route('user.index'));
});

Breadcrumbs::for('portal.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Portal', route('portal.index'));
});

Breadcrumbs::for('candidate.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Pelamar', route('candidate.index'));
});

Breadcrumbs::for('candidate.show', function (BreadcrumbTrail $trail, Candidate $candidate) {
    $trail->parent('candidate.index');
    $trail->push($candidate->profile->name, route('candidate.show', $candidate));
});

Breadcrumbs::for('vacancy.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Lowongan Kerja', route('vacancy.index'));
});

Breadcrumbs::for('vacancy.show', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancy.index');
    $trail->push($vacancy->name, route('vacancy.show', $vacancy));
});

Breadcrumbs::for('vacancy.create', function (BreadcrumbTrail $trail) {
    $trail->parent('vacancy.index');
    $trail->push('Tambah', route('vacancy.create'));
});

Breadcrumbs::for('vacancy.edit', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancy.show', $vacancy);
    $trail->push('Sunting', route('vacancy.edit', $vacancy));
});

Breadcrumbs::for('vacancy.question', function (BreadcrumbTrail $trail) {
    $trail->parent('vacancy.index');
    $trail->push('Tes Rekrutmen', route('vacancy.question'));
});

Breadcrumbs::for('question.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Soal Tes', route('question.index'));
});

Breadcrumbs::for('recruitment.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Seleksi', route('recruitment.index'));
});

Breadcrumbs::for('recruitment.show', function (BreadcrumbTrail $trail, Candidate $candidate) {
    $trail->parent('recruitment.index');
    $trail->push($candidate->profile->name, route('recruitment.show', $candidate));
});

Breadcrumbs::for('schedule.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Sesi Wawancara', route('schedule.index'));
});

Breadcrumbs::for('score.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Penilaian', route('score.index'));
});

Breadcrumbs::for('score.create', function (BreadcrumbTrail $trail, Schedule $schedule) {
    $trail->parent('score.index');
    $trail->push('Tambah', route('score.create', $schedule));
});

Breadcrumbs::for('score.edit', function (BreadcrumbTrail $trail, Schedule $schedule) {
    $trail->parent('score.index');
    $trail->push('Sunting', route('score.edit', $schedule));
});

Breadcrumbs::for('score.show', function (BreadcrumbTrail $trail, Schedule $schedule) {
    $trail->parent('score.index');
    $trail->push(Str::upper($schedule->id), route('score.show', $schedule));
});

Breadcrumbs::for('contract.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Generate PKWT', route('contract.index'));
});

Breadcrumbs::for('contract.offering', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Offering Letter', route('contract.offering'));
});

Breadcrumbs::for('contract.signed', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Validasi PKWT', route('contract.signed'));
});

Breadcrumbs::for('portal.show', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('portal.index');
    $trail->push($vacancy->name, route('portal.show', $vacancy));
});

Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('portal.index');
    $trail->push('Kategori', route('category.index'));
});

Breadcrumbs::for('category.show', function (BreadcrumbTrail $trail, VacancyCategory $category) {
    $trail->parent('category.index');
    $trail->push($category->name, route('category.show', $category));
});

