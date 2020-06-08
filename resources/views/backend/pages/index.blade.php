@extends('layouts.backend.app')

@section('title','Pages')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('All Pages') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.pages.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create Page') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th class="text-center">URL</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Last Modified</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $key=>$page)
                            <tr>
                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td style="width: 30%">{{ $page->title }}</td>
                                <td>
                                    <a href="{{ route('page',$page->slug) }}" target="_blank">
                                        {{ $page->slug }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($page->status)
                                        <span
                                            class="badge badge-info">Active</span>
                                    @else
                                        <span
                                            class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $page->updated_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="{{ route('app.pages.edit',$page->id) }}"><i
                                            class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            onclick="deleteData({{ $page->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{ $page->id }}"
                                          action="{{ route('app.pages.destroy',$page->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf()
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush
