@extends('layouts.panel')
@section('title', 'Data Pengguna')
@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            <div class="wrap">
                <h3>@yield('title')</h3>
                <p class="mb-4">Home</p>
            </div>
            <small class="small"></small>
            <div class="card">
                <div class="card-header"><i class="bi bi-people me-2"></i>@yield('title')</div>
                <div class="card-body">
                    <form action="{{ route('login') }}" id="delete-form" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered m-0 fetch" id="fetchUser">
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
                                    <td>{{ Str::headline($user->name) }}</td>
                                    <td>{{ Str::lower($user->email) }}</td>
                                    @empty($user->email_verified_at)
                                    <td><span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Belum ada</span></td>
                                    @else
                                    <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Terverifikasi</span></td>
                                    {{-- <td>{{ date('F d, Y', strtotime($user->email_verified_at)) }}</td> --}}
                                    @endempty
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-dark">
                                                <i class="bi bi-tags me-1"></i>{{ Str::slug($role->name) }}
                                            </span>
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
                <div class="card-footer">
                    <i class="bi bi-info-circle me-2"></i>Data yang ditampilkan sudah melalui penyortiran.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3"></div>
@endsection