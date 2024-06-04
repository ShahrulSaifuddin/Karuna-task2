@extends('layouts.app')

@section('title', 'View Product')

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
                        <div class="row">
                            <div class="col-lg-2 fw-bold">Name</div>
                            <div class="col-lg-10">: {{ $product->product_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 fw-bold">Price</div>
                            <div class="col-lg-10">: RM {{ $product->product_price }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 fw-bold">Details</div>
                            <div class="col-lg-10">: {{ $product->product_desc }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 fw-bold">Publish</div>
                            <div class="col-lg-10">: {{ $product->publish === 1 ? 'Yes' : 'No' }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
