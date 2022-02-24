@extends('layouts.app', ['CatInfo' => 'category', 'titlePage' => __('Manage Category List')])
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
                            <h4 class="card-title ">Manage Category</h4>
                            <p class="card-category"> Here you can manage All Categories</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url('create-category') }}" class="btn btn-sm btn-primary">Add Category</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>Category Image</th>
                                            <th>Category Name</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CategoryData as $CatInfo)
                                            <tr>
                                                <td><img src="{{ asset('images/' . $CatInfo->category_image) }}"
                                                        height="100" width="100"></td>
                                                <td>{{ $CatInfo->category_name }}</td>

                                                <td class="td-actions text-right">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="/edit-category/{{ $CatInfo->id }}/edit"
                                                        data-original-title="" title="Edit Car Details">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <form action="{{ url('delete-category/' . $CatInfo->id) }} "
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
