@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.messages')
                <h4 class="card-title">Add Product</h4>
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="name"
                            placeholder="Product Name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" name="product_code" id="product_code"
                            placeholder="Product Code" value="{{ old('product_code') }}">
                    </div>
                    <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" class="form-control" id="user" placeholder="user"
                            value="{{ Auth::user()->name }}" readonly>
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_id">
                            <option value="">Select Category</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @empty
                                <option value="">No categories Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="number" step="0.01" class="form-control" name="cost" id="cost"
                            placeholder="cost" value="{{ old('cost') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" value="{{ old('status') }}">
                            <option value=1>Active</option>
                            <option value=0>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
