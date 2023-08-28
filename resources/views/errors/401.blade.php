@extends('errors::minimal')

@section('title', config('app.name') . "—Unauthorized")
@section('code', '401')
@section('message', __('Unauthorized'))
