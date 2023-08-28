@extends('errors::minimal')

@section('title', config('app.name') . "—Forbidden")
@section('code', 403)
@section('message', __($exception->getMessage() ?: 'Forbidden'))
