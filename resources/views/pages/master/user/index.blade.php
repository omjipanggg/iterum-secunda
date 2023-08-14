@extends('layouts.panel')
@section('title', 'Akun Terdaftar')
@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            <div class="wrap">
                <div class="mb-4">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('user.index') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bg-color"><i class="bi bi-people me-2"></i>@yield('title')</div>
                <div class="card-body">
                    <form action="{{ route('login') }}" id="delete-form" method="DELETE">
                        @csrf
                        @method('DELETE')
                    </form>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered m-0 fetch">
                            <thead>
                                <tr>
                                    <th colspan="2">Aksi</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Alamat email</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Hak akses</th>
                                </tr>
                                <tr>
                                    <th>Sunting</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" onclick="event.preventDefault();" class="text-color" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="@yield('title')" data-bs-type="Sunting"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td><a href="#" class="dotted btn-delete" data-id="{{ $user->id }}" data-name="{{ Str::headline($user->name) }}"><i class="bi bi-trash"></i></a></td>
                                    <td>{{ Str::upper($user->name) }}</td>
                                    <td>{{ Str::lower($user->email) }}</td>
                                    @empty($user->email_verified_at)
                                    <td><span class="badge text-bg-danger"><i class="bi bi-x-circle-fill me-1"></i>unverified</span></td>
                                    @else
                                    <td><span class="badge text-bg-success"><i class="bi bi-check-circle-fill me-1"></i>verified</span></td>
                                    {{-- <td>{{ date('F d, Y', strtotime($user->email_verified_at)) }}</td> --}}
                                    @endempty
                                    <td>
                                    @foreach ($user->roles as $element)
                                        @if (Str::slug($element->name) == 'tbd')
                                            <span class="badge text-bg-danger">
                                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                                {{ Str::slug($element->name) }}
                                            </span>
                                        @else
                                            <span class="badge text-bg-color">
                                                <i class="bi bi-tags-fill me-1"></i>
                                                {{ Str::slug($element->name) }}
                                            </span>
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sunting</th>
                                    <th>Hapus</th>
                                    <th>Nama</th>
                                    <th>Alamat email</th>
                                    <th>Status</th>
                                    <th>Hak akses</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>Laporkan masalah yg terjadi <a href="#" class="dotted">di sini</a>.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3"></div>
@endsection