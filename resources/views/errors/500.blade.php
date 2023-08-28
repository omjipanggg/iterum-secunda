@extends('errors::minimal')

@section('title', config('app.name') . "—Server Error")
@section('code', '500')
@section('message', __('Server Error'))
