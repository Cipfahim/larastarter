@extends('layouts.backend.app')

@section('title','Pages')

@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($page) ? 'Edit' : 'Create New') . ' Page') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.pages.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="pageFrom" method="POST"
                  action="{{ isset($page) ? route('app.pages.update',$page->id) : route('app.pages.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @isset($page)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Info</h5>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title" placeholder="Enter page title"
                                           value="{{ isset($page) ? $page->title : old('title') }}" required
                                           autocomplete="title" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input id="slug" type="text"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           name="slug" placeholder="Enter page url (unique)"
                                           value="{{ isset($page) ? $page->slug : old('slug') }}"
                                           autocomplete="slug" required autofocus>
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea id="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                                              name="excerpt"
                                              rows="3">{{ isset($page) ? $page->excerpt : old('excerpt') }}</textarea>
                                    @error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea id="body"
                                              class="form-control @error('body') is-invalid @enderror"
                                              name="body" rows="5"
                                              >{{ isset($page) ? $page->body : old('body') }}</textarea>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Status and Image</h5>
                                <div class="form-group">
                                    <label for="image">Page Image (Only Image are allowed) </label>
                                    <input type="file" name="image" id="image"
                                           class="dropify @error('image') is-invalid @enderror"
                                           data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" value="1" class="custom-control-input" id="status" name="status"
                                            @isset($page)
                                                {{ $page->status ? 'checked' : '' }}
                                            @endisset>
                                        <label class="custom-control-label" for="status">Published</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-danger" onClick="resetForm('pageFrom')">
                                    <i class="fas fa-redo"></i>
                                    <span>Reset</span>
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    @isset($page)
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    @else
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Create</span>
                                    @endisset
                                </button>

                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">SEO Info</h5>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea id="meta_description"
                                              class="form-control @error('meta_description') is-invalid @enderror"
                                              name="meta_description"
                                              rows="4">{{ isset($page) ? $page->meta_description : old('meta_description') }}</textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <textarea id="meta_keywords"
                                              class="form-control @error('meta_keywords') is-invalid @enderror"
                                              name="meta_keywords"
                                              rows="3">{{ isset($page) ? $page->meta_keywords : old('meta_keywords') }}</textarea>
                                    @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.tiny.cloud/1/g1axuf87kmcxy93m2ynfmp3usxm3k0mrzcdmm62m0f3pfme3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#body',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            importcss_append: true,
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>
@endpush
