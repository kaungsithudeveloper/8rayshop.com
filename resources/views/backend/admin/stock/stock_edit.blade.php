@extends('backend.admin.layout.layout')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Edit Product Stock</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Stock</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->


                <!-- ROW-1 -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <form id="myForm" method="post" action="{{ route('update.stock', $stock->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4 class="card-title">Edit Product Stock</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"> Brand Name: </label>
                                        <select name="brand_id" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                            <option label="Select Brand"></option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $stock->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> Product Name: </label>
                                        <select name="product_id" id="product_id" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                            <option label="Select Product"></option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="branch_id" class="form-label">Branch Name:</label>
                                        <select name="branch_id" id="branch_id" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                            <option label="Select Branch"></option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $branch->id == $stock->branch_id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock_qty" class="form-label">Product Stock:</label>
                                        <input type="text" class="form-control" id="stock_qty" name="stock_qty" value="{{ $stock->stock_qty }}" required autofocus>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update Stock</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="responsive-datatable"
                                        class="table table-bordered text-nowrap mb-0 table-striped">
                                        <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID
                                                </th>
                                                <th class="bg-transparent border-bottom-0" style="width: 10%;"> Product Name</th>
                                                <th class="bg-transparent border-bottom-0"> Branch Name</th>
                                                <th class="bg-transparent border-bottom-0"> Stock </th>
                                                <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">
                                                    Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($productStock as $key => $stock)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $stock->product->product_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $stock->branch->branch_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold"> {{ $stock->stock_qty }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2 text-center">

                                                            <a href="{{ route('edit.stock', $stock->id) }}"
                                                                class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-original-title="Edit">
                                                                <span class="fe fe-edit fs-14"></span>
                                                            </a>

                                                            <a href="{{ route('delete.stock', $stock->id) }}"
                                                                class="btn text-danger btn-sm" id="delete"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="Delete">
                                                                <span class="fe fe-trash-2 fs-14"></span>
                                                            </a>

                                                        </div>
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

                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#product_id, #branch_id').change(function() {
                var product_id = $('#product_id').val();
                var branch_id = $('#branch_id').val();

                $.ajax({
                    url: '{{ route("fetch.stock") }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        branch_id: branch_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#stock_qty').val(response.stock_qty);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#brand_id').change(function() {
                var brand_id = $(this).val();

                $.ajax({
                    url: '{{ route("fetch.products.by.brand") }}',
                    method: 'POST',
                    data: {
                        brand_id: brand_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#product_id').empty(); // Clear the current options
                        $('#product_id').append('<option label="Select Product"></option>'); // Add placeholder option
                        $.each(response.products, function(key, product) {
                            $('#product_id').append('<option value="'+ product.id +'">'+ product.product_name +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <!--app-content close-->
@endsection

@push('scripts')
    <!-- Include the JavaScript files needed for the create page -->
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/js/table-data.js') }}"></script>

    <!-- typeahead -->
    <script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2.js') }}"></script>

@endpush
