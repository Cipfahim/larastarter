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

                                <x-forms.textbox label="Name"
                                                 name="name"
                                                 value="{{ $user->name ?? ''  }}"
                                                 field-attributes="required autofocus">
                                </x-forms.textbox>

                                <x-forms.textbox type="email"
                                                 label="Email"
                                                 name="email"
                                                 value="{{ $user->email ?? ''  }}" />

                                <x-forms.textbox type="password"
                                                 label="Password"
                                                 name="password"
                                                 placeholder="******" />

                                <x-forms.textbox type="password"
                                                 label="Confirm Password"
                                                 name="password_confirmation"
                                                 placeholder="******" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>

                                <x-forms.select label="Select Role"
                                                name="role"
                                                class="select js-example-basic-single">
                                    @foreach($roles as $key=>$role)
                                        <x-forms.select-item :value="$role->id" :label="$role->name" :selected="$user->role->id ?? null"/>
                                    @endforeach
                                </x-forms.select>

                                <x-forms.dropify label="Avatar (Only Image are allowed)"
                                                 name="avatar"
                                                 value="{{ isset($user) ? $user->getFirstMediaUrl('avatar','thumb') : ''  }}"/>

                                <x-forms.checkbox label="Status"
                                                  name="status"
                                                  class="custom-switch"
                                                  :value="$user->status ?? null" />


                                <x-forms.button label="Reset" class="btn-danger" icon-class="fas fa-redo" on-click="resetForm('userFrom')"/>


                                @isset($user)
                                    <x-forms.button type="submit" label="Update" icon-class="fas fa-arrow-circle-up"/>
                                @else
                                    <x-forms.button type="submit" label="Create" icon-class="fas fa-plus-circle"/>
                                @endisset
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
