@extends('errors::minimal')

@section('title', config('app.name') . "—Not Found")
@section('code', '404')
@section('message', __('Not Found'))
