@extends('backend.admin.layout.layout')

@section('admin')

<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">{{ $profitLossData['brand_name'] }} Datail</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $profitLossData['brand_name'] }} Datail</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border p-0">
                            <div class="card-body text-center">
                                <span class="avatar avatar-xxl brround cover-image"
                                    style="background-image: url('{{ !empty($profitLossData['brand_image']) ? url('upload/brand_images/' . $profitLossData['brand_image']) : url('upload/profile.jpg') }}');">
                                </span>
                                <h4 class="h4 mt-3">{{ $profitLossData['brand_name'] }}</h4>
                                <p class="card-text">Total Profit: {{ $profitLossData['profit'] }}</p>
                                <p class="card-text">Total Loss: {{ $profitLossData['loss'] }}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered text-nowrap mb-0 table-striped">
                                        <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID</th>
                                                <th class="bg-transparent border-bottom-0">Product Name</th>
                                                <th class="bg-transparent border-bottom-0">Profit</th>
                                                <th class="bg-transparent border-bottom-0">Loss</th>
                                                <th class="bg-transparent border-bottom-0">Total Stock</th>
                                                <th class="bg-transparent border-bottom-0">Error Stock</th>
                                                <th class="bg-transparent border-bottom-0">Sold Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productProfitLossData as $key => $item)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $key + 1 }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['product_name'] }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['profit'] }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['loss'] }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['total_stock'] }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['error_stock'] }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item['sold_stock'] }}</h6>
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

