@extends('backend.employees.layout.layout_8ray')

@section('employee')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Confirmed Order</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Confirmed Order</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->


                <!-- ROW-1 -->

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="responsive-datatable"
                                        class="table table-bordered text-nowrap mb-0 table-striped">
                                        <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID
                                                </th>
                                                <th class="bg-transparent border-bottom-0"> Date </th>
                                                <th class="bg-transparent border-bottom-0"> Invoice </th>
                                                <th class="bg-transparent border-bottom-0"> Amount</th>
                                                <th class="bg-transparent border-bottom-0"> Payment </th>
                                                <th class="bg-transparent border-bottom-0"> State</th>
                                                <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">
                                                    Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($orders as $key => $item)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $key + 1 }}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $item->order_date }}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $item->invoice_no }}
                                                            </h6>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $item->amount }}Ks
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $item->payment_method }}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <span class="badge rounded-pill bg-success"> {{ $item->status }}</span>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="g-2 text-center">
                                                            <a href="{{ route('admin.order.details',$item->id) }}"
                                                                class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-original-title="Edit">
                                                                <span class="fe fe-edit fs-14"></span>
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

    <!-- INTERNAL File-Uploads Js-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endpush
