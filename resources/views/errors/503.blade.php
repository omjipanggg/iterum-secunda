@extends('errors::minimal')

@section('title', config('app.name') . "—Service Unavailable")
@section('code', '503')
@section('message', __('Service Unavailable'))
