@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.messages')
                <h4 class="card-title">Add Stock</h4>
                <form action="{{ route('stocks.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id">
                                <option value="">Select Product</option>
                                @forelse($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->product_name }} - {{ $product->product_code }} </option>
                                @empty
                                    <option value="">No Products Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" class="form-control" name="supplier_name" id="supplier_name"
                            placeholder="Supplier Name" value="{{ old('supplier_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity_added" id="quantity" placeholder="Quantity"
                            value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_added_date">Last added date</label>
                        <input type="date" class="form-control" name="last_added_date" id="last_added_date"
                            placeholder="Last added date" value="{{ old('last_added_date') }}">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
