<style type="text/css">
    .form-group input[type=file] {
     opacity: unset !important; 
     position: initial !important;
     height: 30% !important; 
}

</style>

@extends('layouts.app', ['activePage' => 'cars', 'titlePage' => __('Edit Car Details ')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
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
        <div class="col-md-12">
            <form action="{{ url('update-cars/'.$EditData->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
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
                      <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="input-image" type="file"  value="" required="true" aria-required="true"/><img src="{{ asset('images/'.$EditData->car_image) }}" height="50" width="50">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Brand Name') }}" value="{{ $EditData->name }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Founded') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('founded') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('founded') ? ' is-invalid' : '' }}" name="founded" id="input-founded" type="founded" placeholder="{{ __('Founded') }}" value="{{ $EditData->founded }}" required />
                      @if ($errors->has('founded'))
                        <span id="founded-error" class="error text-danger" for="input-founded">{{ $errors->first('founded') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('Description') ? ' has-danger' : '' }}">
                      <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5" cols="100" name="description" id="description">{{ $EditData->description }}</textarea>
                      @if ($errors->has('Description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                 <a href="/cars" class="btn btn-default">Cancel</a>
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection