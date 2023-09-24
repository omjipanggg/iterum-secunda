@extends('layouts.app')

@section('title', 'Home')

@section('content')

@include('components.navbar')

@include('components.hero-welcome')

@include('pages.homepage.patria')

@include('pages.homepage.category')

@include('pages.homepage.vacancy')

@include('components.big-quote')

@include('pages.homepage.tutoria')

@include('pages.homepage.sponsorship')

@include('pages.homepage.blog')

@endsection