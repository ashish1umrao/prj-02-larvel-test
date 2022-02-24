<style type="text/css">
    .form-group input[type=file] {
        opacity: unset !important;
        position: initial !important;
        height: 30% !important;
    }

</style>

@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Edit Category')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('update-category/' . $EditData->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Category') }}</h4>
                                <p class="card-category">{{ __('Category information') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Image') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                name="image" id="input-image" type="file" value="" required="true"
                                                aria-required="true" /><img
                                                src="{{ asset('images/' . $EditData->category_image) }}" height="50"
                                                width="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Category Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                name="category_name" id="input-category_name" type="category_name"
                                                placeholder="{{ __('Category Name') }}"
                                                value="{{ old('category_name', $EditData->category_name) }}" required />
                                            @if ($errors->has('category_name'))
                                                <span id="category_name-error" class="error text-danger"
                                                    for="input-category_name">{{ $errors->first('category_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="/category" class="btn btn-default">Cancel</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
