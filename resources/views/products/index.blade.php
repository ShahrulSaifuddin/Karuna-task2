@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        <div id="alert-success" class="alert alert-success" style="display: none;">
                            Product deleted successfully!
                        </div>
                        <a href="{{ route('products.create') }}" class="btn btn-success">Add Task</a>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="products-table">
                                <thead class="text-center text-white" style="background-color:#405189;">
                                    <tr>
                                        <th width="5%" class="align-middle">BIL</th>
                                        <th width="" class="align-middle">NAME</th>
                                        <th width="" class="align-middle">PRICE (RM)</th>
                                        <th width="" class="align-middle">DETAILS</th>
                                        <th width="" class="align-middle">PUBLISH</th>
                                        <th width="" class="align-middle">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    @foreach ($products as $product)
                                        <tr data-id="{{ $product->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_price }}</td>
                                            <td>{{ $product->product_desc }}</td>
                                            <td>{{ $product->publish === 1 ? 'Yes' : 'No' }}</td>
                                            <td class="d-flex flex-row bd-highlight mb-3">
                                                <div>
                                                    <button type="button" class="btn btn-info proview"
                                                        data-id="{{ $product->id }}">Show</button>
                                                </div>
                                                <div>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-primary proedit">Edit</a>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-danger prodel"
                                                        data-id="{{ $product->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            {{ __('Go to Home') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({});
        });

        // Handle delete button click
        $(document).on('click', '.prodel', function() {
            const productId = $(this).data('id');
            const url = `/products/${productId}`;
            const row = $(this).closest('tr');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#alert-success').show();
                            setTimeout(function() {
                                $('#alert-success').hide();
                            }, 2000);
                            row.remove();
                        } else {
                            alert('Failed to delete the product');
                        }
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the product');
                    }
                });
            }
        });

        // Handle view and edit button click
        $(document).on('click', '.proview', function() {
            const productId = $(this).data('id');
            window.location.href = `/products-view/${productId}`;
        });
    </script>
@endsection
