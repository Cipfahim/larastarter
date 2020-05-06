@extends('layouts.backend.app')

@section('title','Users')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($user) ? 'Edit' : 'Create New') . ' User') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.users.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="userFrom" method="POST"
                  action="{{ isset($user) ? route('app.users.update',$user->id) : route('app.users.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">User Info</h5>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ isset($user) ? $user->name : old('name') }}"
                                           autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ isset($user) ? $user->email : old('email') }}"
                                           autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="******"
                                           class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="******" {{ isset($user) ? '' : '' }}>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>
                                <div class="position-relative form-group">
                                    <label for="role">Select Role</label>
                                    <select id="role"
                                            class="form-control select js-example-basic-single @error('role') is-invalid @enderror"
                                            name="role" >
                                        @foreach($roles as $key=>$role)
                                            <option @if(isset($user)) {{ $user->role->id == $role->id ? 'selected' : '' }} @endif
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="position-relative form-group">
                                    <label for="avatar">Avatar (Only Image are allowed) </label>
                                    <input type="file" name="avatar" id="avatar"
                                           class="dropify @error('avatar') is-invalid @enderror"
                                           data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar','thumb') : '' }}">
                                    @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status"
                                            @isset($user)
                                                {{ $user->status == true ? 'checked' : '' }}
                                            @endisset
                                            >
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger" onClick="resetForm('userFrom')">
                                    <i class="fas fa-redo"></i>
                                    <span>Reset</span>
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    @isset($user)
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    @else
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Create</span>
                                    @endisset
                                </button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
