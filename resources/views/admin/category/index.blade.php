@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('admin.messages')
                    <div class="col-md-9">
                        <h4 class="card-title">Category list</h4>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <a href="{{ route('categories.create') }}" class="btn btn-block btn-sm btn-gradient-primary">+ Add new
                            Category</a>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table class="data-table table table- table-hover">
                            <thead>
                                <tr class="heading">
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories)
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <?php $index = $key + 1; ?>
                                            <td>{{ $index }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('storage/images/category/' . $category->image) }}" alt=""
                                                    class="thumbnail"></td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                        style="display: inline;">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
