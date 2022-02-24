<style type="text/css">
    .form-group input[type=file] {
        opacity: unset !important;
        position: unset !important;
    }

</style>

@extends('layouts.app', ['activePage' => 'cars_model', 'titlePage' => __('Add Car Model')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="/cars-model/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Car Model') }}</h4>
                                <p class="card-category">{{ __('Car Model information') }}</p>
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
                                                aria-required="true" />

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <select name="cars" id="cars"
                                                class="form-control{{ $errors->has('cars') ? ' is-invalid' : '' }}">
                                                <option value="#">Select Cars</option>
                                                @foreach ($cars as $car)
                                                    :
                                                    <option value="{{ $car->id }}__{{ $car->name }}">
                                                        {{ $car->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Model Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('model_name') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('model_name') ? ' is-invalid' : '' }}"
                                                name="model_name" id="input-model_name" type="model_name"
                                                placeholder="{{ __('Model Name') }}"
                                                value="{{ old('model_name', auth()->user()->model_name) }}" required />
                                            @if ($errors->has('model_name'))
                                                <span id="model_name-error" class="error text-danger"
                                                    for="input-model_name">{{ $errors->first('model_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="/cars_model" class="btn btn-default">Cancel</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
