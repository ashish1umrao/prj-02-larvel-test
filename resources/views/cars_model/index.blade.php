@extends('layouts.app', ['modelInfo' => 'car_model', 'titlePage' => __('Car Model List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">CARS MODEL</h4>
                            <p class="card-category"> Here you can manage Cars Model</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="/cars-model/create" class="btn btn-sm btn-primary">Add Car Model</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>Model Image</th>
                                            <th>Car Name</th>
                                            <th>Model Name</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CarModel as $modelInfo)
                                            <tr>
                                                <td><img src="{{ asset('images/' . $modelInfo->model_image) }}"
                                                        height="100" width="100"></td>
                                                <td>{{ $modelInfo->car_name }}</td>
                                                <td>{{ $modelInfo->model_name }}</td>
                                                <td class="td-actions text-right">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="/cars-model/{{ $modelInfo->id }}/edit"
                                                        data-original-title="" title="Edit Car Details">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <form action="{{ url('delete-car-model/' . $modelInfo->id) }} "
                                                        class="pt-3" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-link">
                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
