@extends('backend.admin.layout.layout')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Taginput CSS -->
    <link href="{{ url('backend/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/plugins/typeahead/typeaheadjs.min.css') }}" rel="stylesheet" />

            <!--app-content open-->
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
                        <div class="row">
                            <div class="col-xl-12">
                                <form id="myForm" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                                    @csrf

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="product_code" class="form-label">Product Code :<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_code" autocomplete="product_code" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="product_name" class="form-label">Product Name:<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_name" autocomplete="product_name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="brand" class="form-label">Brand:</label>
                                                        <input type="text" name="brand_id" class="form-control" id="brand" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="product_colors" class="form-label">Product Colors:</label>
                                                        <input type="text" name="product_color_id" class="form-control" id="product_colors" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputVendor" class="form-label">Product Category</label>
                                                    <select name="product_category_id" class="form-select" id="inputVendor">
                                                        <option value="1">None</option>
                                                        @foreach($product_categories as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->product_category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Users list</label>
                                                    <select class="form-control select2" name="product_subcategory_id[]" data-placeholder="Other" id="inputCollection" multiple>
                                                            <option value="1">Other</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Create Product</button>
                                            <a href="" class="btn btn-danger">Discard</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

            <script>
                $(function() {
                    // Bloodhound for product colors
                    var productColors = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                            url: "/product-colors",
                            cache: false,
                        }
                    });

                    productColors.initialize();

                    $('#product_colors').tagsinput({
                        typeaheadjs: {
                            name: 'productColors',
                            source: productColors.ttAdapter()
                        },
                        confirmKeys: [13, 44],
                    });

                    // Bloodhound for brands
                    var brands = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                            url: "/brands",
                            cache: false,
                        }
                    });

                    brands.initialize();

                    $('#brand').tagsinput({
                        typeaheadjs: {
                            name: 'brands',
                            source: brands.ttAdapter()
                        },
                        confirmKeys: [13, 44],
                    });

                });
            </script>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#inputVendor').on('change', function () {
                        var category_id = $(this).val();
                        if (category_id) {
                            $.ajax({
                                url: '/subcategory/ajax/' + category_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('#inputCollection').empty();

                                    $.each(data, function (key, value) {
                                        $('#inputCollection').append('<option value="' + value.id + '">' + value.product_subcategory_name + '</option>');
                                    });
                                }
                            });
                        } else {
                            $('#inputCollection').empty();
                            $('#inputCollection').append('<option value="1">None</option>');
                        }
                    });
                });
            </script>

@endsection

@push('scripts')
<!-- SHOW PASSWORD JS -->
<script src="{{ asset('backend/js/show-password.min.js') }}"></script>

<!-- tagsinput -->
<script src="{{ url('backend/plugins/input-tags/js/tagsinput.js') }}"></script>
<!-- typeahead -->
<script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/js/select2.js') }}"></script>


<!-- INTERNAL WYSIWYG Editor JS -->
<script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
<script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>

@endpush
