<style type="text/css">
    .form-group input[type=file] {
     opacity: unset !important; 
     position: initial !important;
     height: 30% !important; 
}

</style>

@extends('layouts.app', ['activePage' => 'modelEdit','activePage' => 'modelUpdate',  'titlePage' => __('Edit Car Model Details ')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form action="{{ url('update-cars-model/'.$EditData['carModel']['id'] ) }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
           @csrf
          @method('PUT')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Car') }}</h4>
                <p class="card-category">{{ __('Edit Car information') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                      <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file"  value="" required="true" aria-required="true"/><img src="{{ asset('images/'.$EditData['carModel']['model_image']) }}" height="50" width="50">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('model_name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('model_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('model_name') ? ' is-invalid' : '' }}" name="model_name" id="input-model_name" type="text" placeholder="{{ __('Model Name') }}" value="{{ $EditData['carModel']['model_name'] }}" required="true" aria-required="true"/>
                      @if ($errors->has('model_name'))
                        <span id="name-error" class="error text-danger" for="input-model_name">{{ $errors->first('model_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Car Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('founded') ? ' has-danger' : '' }}">
                      <select name="cars" id="cars" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                        <option value="#">Select Cars</option>
                             @foreach($EditData['cars'] as $car):
                              <option value="{{ $car->id }}__{{$car->name }}"<?php if ($EditData['carModel']['car_id'] == $car->id):  echo "selected";endif ?>>{{ $car->name }}</option>
                            @endforeach    
                        </select>
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