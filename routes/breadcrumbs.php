<?php
use App\Models\Vacancy;
use App\Models\VacancyCategory;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home.index'));
});

Breadcrumbs::for('home.portal', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('Portal', route('home.portal'));
});

Breadcrumbs::for('home.portal.category', function (BreadcrumbTrail $trail, VacancyCategory $category) {
    $trail->parent('home.portal');
    $trail->push($category->name, route('home.portal.category', $category));
});

Breadcrumbs::for('home.vacancy.show', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('home.portal');
    $trail->push($vacancy->name, route('home.vacancy.show', $vacancy));
});
