@extends('backend.admin.layout.layout')

@section('admin')

    <!-- Include Tagify CSS and JS -->
    <link rel="stylesheet" href="{{ url('backend/plugins/tagify/tagify.min.css') }}">
    <script src="{{ url('backend/plugins/tagify/tagify.min.js') }}"></script>

    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Create Product</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Product</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <form id="myForm" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $err)
                                        {{ $err }}
                                    @endforeach
                                </div>
                            @endif

                            <!-- Product Information -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="product_code" class="form-label">Product Code :<span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="product_code" autocomplete="product_code" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="product_name" class="form-label">Product Name:<span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="product_name" autocomplete="product_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Color and Stock -->
                            <div class="card">
                                <div class="card-body">
                                    <label for="inputProductTitle" class="form-label">Product Color :</label>
                                    <div id="color-input-container">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-2">
                                                <input type="text" name="product_color_id[]" class="form-control product-color-input" placeholder="Select Color">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-2">
                                                <input type="number" class="form-control" name="stock_qty_1[]" placeholder="Stock for Branch 1" min="0">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-2">
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" name="stock_qty_2[]" placeholder="Stock for Branch 2" min="0">
                                                    <a href="javascript:void(0)" class="btn text-danger btn-sm add-color-btn ms-2" data-bs-toggle="tooltip" data-bs-original-title="Add Color">
                                                        <span class="fe fe-edit fs-14"></span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn text-danger btn-sm delete-color-btn ms-2" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                        <span class="fe fe-trash-2 fs-14"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </div>
                </form>
                <!-- ROW-1 CLOSED -->
            </div>
        </div>
    </div>

@endsection
