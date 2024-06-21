@extends('backend.employees.layout.layout_8ray')

@section('employee')

<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Employee Dashboard</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Brand</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <form id="myForm" method="post" action="{{ route('store.employee.brand') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4 class="card-title">Add Brand</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Brand Name :</label>
                                        <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" value="{{ old('brand_name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="brand_image">Brand Photo :</label>
                                        <input type="file" name="brand_image" class="form-control" id="image" />
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ (!empty($brand->brand_image))?url('upload/brand_images/'.$brand->brand_image):url('upload/profile.jpg') }}" alt="Admin">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Create Brand</button>
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
                                                <th class="bg-transparent border-bottom-0" style="width: 10%;"> Brand Image</th>
                                                <th class="bg-transparent border-bottom-0"> Brand Name</th>
                                                <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">
                                                    Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($brands as $key => $brand)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                        </div>
                                                    </td>

                                                    <td>

                                                        <div class="d-flex">
                                                            <img src="{{ !empty($brand->brand_image) ? url('upload/brand_images/' . $brand->brand_image) : url('upload/profile.jpg') }}"
                                                                alt="Admin" style="width:70%; height: 70%;">
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold"> {{ $brand->brand_name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="g-2 text-center">

                                                                <a href="{{ route('edit.employee.brand', $brand->brand_slug) }}"
                                                                    class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Edit">
                                                                    <span class="fe fe-edit fs-14"></span>
                                                                </a>

                                                                <a href="{{ route('delete.employee.brand', $brand->id) }}"
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
