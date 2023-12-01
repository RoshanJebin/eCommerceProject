@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('admin.messages')
                    <div class="col-md-9">
                        <h4 class="card-title">Stock list</h4>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <a href="{{ route('stocks.create') }}" class="btn btn-block btn-sm btn-gradient-primary">+ Add new
                            Stock</a>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table class="data-table table table- table-hover">
                            <thead>
                                <tr class="heading">
                                    <th>Sr. No.</th>
                                    <th>Product Name</th>
                                    <th>Supplier Name</th>
                                    <th>last added date</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($stocks)
                                    @foreach ($stocks as $key => $stock)
                                        <tr>
                                            <?php $index = $key + 1; ?>
                                            <td>{{ $index }}</td>
                                            <td>{{ $stock->product->product_name }} - {{ $stock->product->product_code }}</td>
                                            <td>{{ $stock->supplier_name }}</td>
                                            <td>{{ $stock->last_added_date }}</td>
                                            <td>{{ $stock->quantity_added }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('stocks.edit', $stock->id) }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST"
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
