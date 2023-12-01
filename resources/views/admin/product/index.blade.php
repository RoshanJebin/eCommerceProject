@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('admin.messages')
                    <div class="col-md-9">
                        <h4 class="card-title">Product list</h4>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <a href="{{ route('products.create') }}" class="btn btn-block btn-sm btn-gradient-primary">+ Add new
                            Product</a>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table class="data-table table table- table-hover">
                            <thead>
                                <tr class="heading">
                                    <th>Sr. No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>User</th>
                                    <th>Category</th>
                                    <th>Cost</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products)
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <?php $index = $key + 1; ?>
                                            <td>{{ $index }}</td>
                                            <td><img src="{{ asset('storage/images/product/' . $product->image) }}"
                                                    alt="" class="thumbnail"></td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->user->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->cost }}</td>
                                            <td>{{ $product->stocks->sum('quantity_added') }}</td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display: inline;">
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
