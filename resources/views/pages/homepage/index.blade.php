@extends('layouts.app')
@section('title', 'Home')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-database me-2"></i>
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('home.upload') }}" enctype="multipart/form-data" method="POST">
                        @method('POST')
                        @csrf
                        <div class="group mb-2">
                        @error('file')
                            <span class="form-text text-danger fw-bold">Kolom di bawah ini bersifat wajib.</span>
                        @enderror
                        <input type="file" class="@error('file') is-invalid @enderror form-control" name="file">
                        </div>
                        <button type="submit" class="btn btn-secondary">
                        Submit
                        <i class="bi bi-send ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
