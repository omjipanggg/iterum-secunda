@extends('errors::minimal')

@section('title', config('app.name') . "—Too Many Requests")
@section('code', '429')
@section('message', __('Too Many Requests'))
