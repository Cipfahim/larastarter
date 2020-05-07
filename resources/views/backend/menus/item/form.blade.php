@extends('layouts.backend.app')

@section('title','Menu Item')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    @isset($menuItem)
                        Edit Menu Item
                    @else
                        Add New Menu Item to (<code>{{ $menu->name }}</code>)
                    @endisset
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.menus.builder',$menu->id) }}" class="btn-shadow btn btn-danger">
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
                <form id="itemFrom" role="form" method="POST"
                      action="{{ isset($menuItem) ? route('app.menus.item.update',['id'=>$menu->id,'itemId'=>$menuItem->id]) : route('app.menus.item.store',$menu->id) }}">
                    @csrf
                    @isset($menuItem)
                        @method('PUT')
                    @endisset

                    <div class="card-body">
                        <h5 class="card-title">Manage Menu Item</h5>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="custom-select" id="type" name="type" onchange="setItemType()">
                                <option value="item" @isset($menuItem) {{ $menuItem == 'item' ? 'selected' : '' }} @endisset>Menu Item</option>
                                <option value="divider" @isset($menuItem) {{ $menuItem == 'divider' ? 'selected' : '' }} @endisset>Divider</option>
                            </select>
                        </div>

                        <div id="divider_fields">
                            <div class="form-group">
                                <label for="divider_title">Title of the Divider</label>
                                <input type="text" class="form-control @error('divider_title') is-invalid @enderror" id="divider_title"
                                       name="divider_title"
                                       placeholder="Divider Title" value="{{ isset($menuItem) ? $menuItem->divider_title : old('divider_title') }}"
                                       autofocus>
                                @error('divider_title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div id="item_fields">
                            <div class="form-group">
                                <label for="title">Title of the Menu Item</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                       name="title"
                                       placeholder="Title" value="{{ isset($menuItem) ? $menuItem->title : old('title') }}"
                                       autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">URL for the Menu Item</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                       name="url"
                                       placeholder="URL" value="{{ isset($menuItem) ? $menuItem->url : old('url') }}">
                                @error('url')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="target">Open In</label>
                                <select name="target" id="target"
                                        class="form-control @error('target') is-invalid @enderror">
                                    <option
                                        value="_self" @isset($menuItem) {{ $menuItem->target == '_self' ? 'selected' : '' }} @endisset>
                                        Same Tab/Window
                                    </option>
                                    <option
                                        value="_blank" @isset($menuItem) {{ $menuItem->target == '_blank' ? 'selected' : '' }} @endisset>
                                        New Tab/Window
                                    </option>
                                </select>
                                @error('target')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="icon_class">Font Icon class for the Menu Item <a target="_blank"
                                                                                             href="https://fontawesome.com/">(Use
                                        a Fontawesome Font Class)</a> </label>
                                <input type="text" class="form-control @error('icon_class') is-invalid @enderror"
                                       id="icon_class" name="icon_class"
                                       placeholder="Icon Class (optional)"
                                       value="{{ isset($menuItem) ? $menuItem->icon_class : old('icon_class') }}"
                                       autofocus>
                                @error('icon_class')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" onClick="resetForm('itemFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            @isset($menuItem)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Update</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            @endisset
                        </button>

                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        function setItemType(){
            if($('select[name="type"]').val() == 'divider'){
                $('#divider_fields').removeClass('d-none');
                $('#item_fields').addClass('d-none');
            }else{
                $('#divider_fields').addClass('d-none');
                $('#item_fields').removeClass('d-none');
            }
        }; setItemType();
        $('input[name="type"]').change(setItemType);
    </script>
@endpush
