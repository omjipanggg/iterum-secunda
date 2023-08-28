@extends('errors::minimal')

@section('title', config('app.name') . "—Payment Required")
@section('code', '402')
@section('message', __('Payment Required'))
