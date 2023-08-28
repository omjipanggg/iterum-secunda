<?php
use App\Models\TableCode;
use App\Models\Vacancy;
use App\Models\VacancyCategory;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use Illuminate\Support\Str;

Breadcrumbs::for('master.index', function (BreadcrumbTrail $trail) {
    $trail->push('Master', route('master.index'));
});

Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard.index'));
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

Breadcrumbs::for('vacancy.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Lowongan Kerja', route('vacancy.index'));
});

Breadcrumbs::for('vacancy.show', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancy.index');
    $trail->push($vacancy->project->project_number, route('vacancy.show', $vacancy));
});

Breadcrumbs::for('vacancy.edit', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancy.show', $vacancy);
    $trail->push('Sunting', route('vacancy.edit', $vacancy));
});

Breadcrumbs::for('contract.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Generate PKWT', route('contract.index'));
});

Breadcrumbs::for('contract.signed', function (BreadcrumbTrail $trail) {
    $trail->parent('contract.index');
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

