@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>{{ __('Show Products') }}</h1>
                            </div>
                            <div class="col-lg-6" align="right">
                                <a href="{{ route('products.index') }}" class="btn btn-primary">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="alert-success" class="alert alert-success" style="display: none;">
                            Product updated successfully!
                        </div>

                        <form id="product-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-10">
                                    <font class="fw-bold">Name :</font>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $products->product_name }}">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-10">
                                    <font class="fw-bold">Price (RM) :</font>
                                    <input type="text" class="form-control" name="price"
                                        value="{{ $products->product_price }}">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-10">
                                    <font class="fw-bold">Details :</font>
                                    <textarea class="form-control" name="desc">{{ $products->product_desc }}</textarea>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-10">
                                    <font class="fw-bold">Publish :</font>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="publishYes" name="publish"
                                            value="1" {{ $products->publish === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="publishYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="publishNo" name="publish"
                                            value="0" {{ $products->publish === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="publishNo">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-10">
                                    <button type="button" class="btn btn-primary" id="update-button">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#update-button').click(function(e) {
                e.preventDefault();

                var formData = $('#product-form').serialize();

                $.ajax({
                    url: "{{ route('products.update', $products->id) }}",
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#alert-success').show();
                        setTimeout(function() {
                            $('#alert-success').hide();
                        }, 2000);
                    },
                    error: function(response) {
                        console.log('Error:', response);
                    }
                });
            });
        });
    </script>
@endsection
