@extends('layouts.backend.app')

@section('title','Menus')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($menu) ? 'Edit' : 'Create New') . ' Menu') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.menus.index') }}" class="btn-shadow btn btn-danger">
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
            <div class="main-card mb-3 card">
                <!-- form start -->
                <form id="roleFrom" role="form" method="POST"
                      action="{{ isset($menu) ? route('app.menus.update',$menu->id) : route('app.menus.store') }}">
                    @csrf
                    @if (isset($menu))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage Menus</h5>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name"
                                   placeholder="Enter menu name (e.g. admin)"
                                   value="{{ isset($menu) ? $menu->name : old('name') }}" required
                                   autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('name') is-invalid @enderror" id="description"
                                      name="description">{{ isset($menu) ? $menu->description : old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            @isset($menu)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Update</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            @endisset
                        </button>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
