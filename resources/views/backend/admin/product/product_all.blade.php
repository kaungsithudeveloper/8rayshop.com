@extends('backend.admin.layout.layout')

@section('admin')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="{{ route('product.add') }}" class="btn btn-primary">
                            Add New Product
                        </a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Product</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">All Product</h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="grid-margin">
                                    <div class="">
                                        <div class="panel panel-primary">
                                            <div class="tab-menu-heading border-0 p-0">
                                                <div class="tabs-menu1">
                                                    <!-- Tabs -->
                                                    <ul class="nav panel-tabs product-sale">
                                                        <li><a href="#tab5" class="active" data-bs-toggle="tab">All Product</a></li>
                                                        <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Active Product</a></li>
                                                        <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Inactive Product</a></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="panel-body tabs-menu-body border-0 pt-0">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab5">
                                                        <div class="table-responsive">
                                                            <table id="responsive-datatable" class="table table-bordered text-nowrap mb-0 table-striped">
                                                                <thead class="border-top">
                                                                    <tr>
                                                                        <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;"> ID </th>
                                                                        <th class="bg-transparent border-bottom-0" style="width: 7%;"> Photo</th>
                                                                        <th class="bg-transparent border-bottom-0"> Product Code </th>
                                                                        <th class="bg-transparent border-bottom-0"> Product Name</th>
                                                                        <th class="bg-transparent border-bottom-0"> Stock </th>
                                                                        <th class="bg-transparent border-bottom-0"> Selling Price </th>
                                                                        <th class="bg-transparent border-bottom-0"> Discount Price </th>
                                                                        <th class="bg-transparent border-bottom-0"> Status </th>
                                                                        <th class="bg-transparent border-bottom-0"> Editor </th>
                                                                        <th class="bg-transparent border-bottom-0"> Date </th>
                                                                        <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @foreach ($products as $key => $product)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <img src="{{ !empty($product->product_photo) ? url('upload/product_images/' . $product->product_photo) : url('upload/blog_images.png') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_code }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_name }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_qty }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->selling_price }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->discount_price }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->status }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->user_id }} </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ date('F j, Y, g:ia', strtotime($product['created_at'])) }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="g-2 text-center">

                                                                                        <a href="{{ route('edit.product', $product->product_slug) }}"
                                                                                            class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Edit">
                                                                                            <span class="fe fe-edit fs-14"></span>
                                                                                        </a>

                                                                                        <a href="{{ route('delete.product', $product->id) }}"
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
                                                    <div class="tab-pane" id="tab6">
                                                        <div class="table-responsive">
                                                            <div class="table-responsive">
                                                                <table id="responsive-datatable" class="table table-bordered text-nowrap mb-0 table-striped">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;"> ID </th>
                                                                            <th class="bg-transparent border-bottom-0" style="width: 7%;"> Photo</th>
                                                                            <th class="bg-transparent border-bottom-0"> Product Code </th>
                                                                            <th class="bg-transparent border-bottom-0"> Product Name</th>
                                                                            <th class="bg-transparent border-bottom-0"> Stock </th>
                                                                            <th class="bg-transparent border-bottom-0"> Selling Price </th>
                                                                            <th class="bg-transparent border-bottom-0"> Discount Price </th>
                                                                            <th class="bg-transparent border-bottom-0"> Status </th>
                                                                            <th class="bg-transparent border-bottom-0"> Editor </th>
                                                                            <th class="bg-transparent border-bottom-0"> Date </th>
                                                                            <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">Action</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach ($products as $key => $product)
                                                                            <tr class="border-bottom">
                                                                                <td class="text-center">
                                                                                    <div class="mt-0 mt-sm-2 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <img src="{{ !empty($product->photo) ? url('upload/product_images/' . $product->photo) : url('upload/blog_images.png') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_code }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_name }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_qty }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->selling_price }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->discount_price }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->status }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->user_id }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            {{ date('F j, Y, g:ia', strtotime($product['created_at'])) }}
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="g-2 text-center">

                                                                                            <a href=""
                                                                                                class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Detail">
                                                                                                <span class="fe fe-eye fs-14"></span>
                                                                                            </a>

                                                                                            <a href=""
                                                                                                class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Edit">
                                                                                                <span class="fe fe-edit fs-14"></span>
                                                                                            </a>

                                                                                            <a href=""
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
                                                    <div class="tab-pane" id="tab7">
                                                        <div class="table-responsive">
                                                            <div class="table-responsive">
                                                                <table id="responsive-datatable" class="table table-bordered text-nowrap mb-0 table-striped">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;"> ID </th>
                                                                            <th class="bg-transparent border-bottom-0" style="width: 7%;"> Photo</th>
                                                                            <th class="bg-transparent border-bottom-0"> Product Code </th>
                                                                            <th class="bg-transparent border-bottom-0"> Product Name</th>
                                                                            <th class="bg-transparent border-bottom-0"> Stock </th>
                                                                            <th class="bg-transparent border-bottom-0"> Selling Price </th>
                                                                            <th class="bg-transparent border-bottom-0"> Discount Price </th>
                                                                            <th class="bg-transparent border-bottom-0"> Status </th>
                                                                            <th class="bg-transparent border-bottom-0"> Editor </th>
                                                                            <th class="bg-transparent border-bottom-0"> Date </th>
                                                                            <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">Action</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach ($products as $key => $product)
                                                                            <tr class="border-bottom">
                                                                                <td class="text-center">
                                                                                    <div class="mt-0 mt-sm-2 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <img src="{{ !empty($product->photo) ? url('upload/product_images/' . $product->photo) : url('upload/blog_images.png') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_code }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_name }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->product_qty }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->selling_price }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->discount_price }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->status }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $product->user_id }} </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            {{ date('F j, Y, g:ia', strtotime($product['created_at'])) }}
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="g-2 text-center">


                                                                                        <a href=""
                                                                                            class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Detail">
                                                                                            <span class="fe fe-eye fs-14"></span>
                                                                                        </a>

                                                                                            <a href=""
                                                                                                class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Edit">
                                                                                                <span class="fe fe-edit fs-14"></span>
                                                                                            </a>

                                                                                            <a href=""
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
                                        </div>
                                    </div>
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
@endpush
