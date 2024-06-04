@extends('layouts.app')

{{-- @section('title', 'Add Product') --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="product_name">{{ __('Product Name') }}</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_price">{{ __('Product Price (RM)') }}</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('product_price') is-invalid @enderror" id="product_price"
                                    name="product_price" value="{{ $product->product_price }}" required>
                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_desc">{{ __('Product Details') }}</label>
                                <textarea class="form-control @error('product_desc') is-invalid @enderror" id="product_desc" name="product_desc"
                                    rows="3" required>{{ $product->product_desc }}</textarea>
                                @error('product_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="publish">{{ __('Publish') }}</label>
                                <select class="form-control mb-1 @error('publish') is-invalid @enderror" id="publish"
                                    name="publish" required>
                                    <option value="1" {{ $product->publish == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $product->publish == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('publish')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Product') }}</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
