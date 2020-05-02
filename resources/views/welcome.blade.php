@extends('layouts.frontend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome to {{ config('settings.app_name') }}</div>

                    <div class="card-body">
                        Build something awesome :)
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
