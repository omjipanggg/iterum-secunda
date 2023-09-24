@extends('layouts.panel')
@section('title', 'Akun Terdaftar')
@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('user.index') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bg-color">
                    <i class="bi bi-people me-2"></i>
                    @yield('title')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered m-0 fetch">
                            <thead>
                                <tr>
                                    <th colspan="2">Aksi</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Alamat email</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Hak akses</th>
                                    <th rowspan="2">Divisi</th>
                                    <th rowspan="2">Regional</th>
                                </tr>
                                <tr>
                                    <th>Sunting</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="@isset($user->deleted_at) deleted @endisset">
                                    <td>
                                        @isset($user->deleted_at)
                                        <i class="bi bi-pencil-square"></i>
                                        @else
                                        <a href="{{ route('user.edit', $user->id) }}" onclick="event.preventDefault();" class="text-color" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="@yield('title')" data-bs-type="Sunting"><i class="bi bi-pencil-square"></i></a>
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($user->deleted_at)
                                        <i class="bi bi-trash"></i>
                                        @else
                                        <a href="{{ route('user.destroy', $user->id) }}" onclick="confirmDel(event);" class="dotted" data-bs-id="{{ Str::upper($user->id) }}"><i class="bi bi-trash"></i></a>
                                        @endisset
                                    </td>
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
                                    <td>{{ $user->token->department_name ?? '-' }}</td>
                                    <td class="fw-semibold">{{ Str::upper($user->token->region->slug ?? '-') ?? '-' }}</td>
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
                                    <th>Divisi</th>
                                    <th>Regional</th>
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