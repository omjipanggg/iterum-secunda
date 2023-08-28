@extends('layouts.panel')
@section('title', 'Hak Akses')
@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('master.createMenu') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bg-color">
                    <i class="bi bi-menu-app me-2"></i>
                    @yield('title')
                </div>
                <div class="card-body">
                    <form action="{{ route('master.storeMenu') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="card rounded-0 h-270">
                                    <div class="card-header">Menu</div>
                                    <div class="card-body">
                                        @foreach ($menu as $element)
                                            @if ($element->has_child)
                                                @if ($element->parent_id == 0)
                                                    <div class="form-check">
                                                      <input class="form-check-input check-parent" name="menu[]" data-bs-batch="chkBatch{{ $element->id }}" type="checkbox" value="{{ $element->id }}" id="checkMenuParent{{ $loop->iteration }}">
                                                      <label class="form-check-label" for="checkMenu"><strong>[{{ $element->id }}] {{ $element->name }}</strong></label>
                                                    </div>
                                                    @foreach ($menu as $sub)
                                                        @if ($sub->has_child)
                                                            @if($sub->parent_id == 0)
                                                            @else
                                                                <div class="form-check" style="padding-left: 36px;">
                                                                  <input class="form-check-input check-child" name="menu[]" type="checkbox" data-bs-batch="chkBatch{{ $element->id }}" value="{{ $sub->id }}" id="checkMenuChild{{ $loop->iteration }}">
                                                                  <label class="form-check-label" for="checkMenuChild{{ $loop->iteration }}"><strong>[{{ $sub->id }}] {{ $sub->name }}</strong></label>
                                                                </div>
                                                                @foreach ($menu as $grand)
                                                                @if ($sub->id == $grand->parent_id)
                                                                    <div class="form-check" style="padding-left: 54px;">
                                                                      <input class="form-check-input check-grand check-child" name="menu[]" data-bs-batch="chkBatch{{ $element->id }}" type="checkbox" value="{{ $grand->id }}" id="checkMenuGrand{{ $loop->iteration }}">
                                                                      <label class="form-check-label" for="checkMenuGrand{{ $loop->iteration }}">{{ $grand->name }}</label>
                                                                    </div>
                                                                @else
                                                                @endif
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            @if ($element->id == $sub->parent_id)
                                                            <div class="form-check" style="padding-left: 36px;">
                                                              <input class="form-check-input check-child" type="checkbox" name="menu[]" value="{{ $sub->id }}" id="checkMenuChild{{ $loop->iteration }}">
                                                              <label class="form-check-label" for="checkMenuChild{{ $loop->iteration }}">{{ $sub->name }}</label>
                                                            </div>
                                                            @else
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @else
                                                @endif
                                            @else
                                                @if ($element->parent_id == 0)
                                                    <div class="form-check check-single">
                                                      <input class="form-check-input check-single" type="checkbox" name="menu[]" value="{{ $element->id }}" id="checkMenuSingle{{ $loop->iteration }}">
                                                      <label class="form-check-label" for="checkMenuSingle{{ $loop->iteration }}"><strong>{{ $element->name }}</strong></label>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card rounded-0">
                                    <div class="card-header">Roles</div>
                                    <div class="card-body">
                                        <ul class="dual square m-0">
                                        @foreach ($roles as $role)
                                        <li class="form-check">
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="checkRole{{ $role->id }}">
                                            <label for="checkRole{{ $role->id }}">{{ $role->name }}</label>
                                        </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-color px-3 rounded-0">
                                    Kirim
                                    <i class="bi bi-send ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Mohon disesuaikan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection