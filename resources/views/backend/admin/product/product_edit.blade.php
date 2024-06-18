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
                            <h1 class="page-title">Edit Product</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <form id="myForm" method="post" action="{{ route('update.product') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-xl-8">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $err)
                                                    {{ $err }}
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_code" class="form-label">Product Code :<span
                                                                        class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="product_code" value="{{ $product->product_code }}" autocomplete="product_code" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="product_name" class="form-label">Product Name:<span
                                                                        class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" autocomplete="product_name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="short_descp" class="form-label">Short Description :</label>
                                                    <textarea class="form-control mb-4" rows="4" name="short_descp">{{ $product->productInfo->short_descp }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="long_descp" class="form-label">Product Description :</label>
                                                    <textarea name="long_descp" id="myTextarea" class="content">{{ $product->productInfo->long_descp }}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Multiple Image</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="inputProductTitle" class="form-label">Multiple Image</label>
                                                    <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple>

                                                    <div class="row" id="preview_img">
                                                        @foreach($product->multiImages as $img)
                                                        <div class="col-md-3 thumb-wrapper" data-id="{{ $img->id }}">
                                                            <img src="{{ url('upload/product_multi_images/' . $img->photo_name) }}" alt="Product" style="width:100px; height: 100px;" class="thumb">
                                                            <button class="remove-btn">x</button>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-xl-4">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label for="brand" class="form-label">Product Category:</label>
                                                        <select name="product_category_id" class="form-select select2" id="inputVendor">
                                                            <option value="1">None</option>
                                                            @foreach($product_categories as $cat)
                                                                <option value="{{ $cat->id }}" {{ $cat->id == $product->product_category_id ? 'selected' : '' }}>{{ $cat->product_category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label class="form-label"> Product SubCategory: </label>
                                                        <select name="product_subcategory_id[]" class="form-select select2" id="inputCollection" multiple>
                                                            @foreach($product_subCategories as $subCat)
                                                                <option value="{{ $subCat->id }}" {{ in_array($subCat->id, $product->productSubCategory->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $subCat->product_subcategory_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="brand" class="form-label">Brand:</label>
                                                        <input type="text" name="brand_id" class="form-control" id="brand" value="{{ implode(', ', $product->brands->pluck('brand_name')->toArray()) }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="product_colors" class="form-label">Product Colors:</label>
                                                        <input type="text" name="product_color_id" class="form-control" id="product_colors" value="{{ implode(', ', $product->productColor->pluck('color_name')->toArray()) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product_qty" class="form-label">Stock :<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" name="product_qty" value="{{ $product->product_qty }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product_size" class="form-label">Product Size :<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" name="product_size" value="{{ $product->productInfo->product_size }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="selling_price" class="form-label">Selling Price:<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="discount_price" class="form-label">Discount Price:<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" name="discount_price" value="{{ $product->discount_price }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Product Photo</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="product_photo">Photo</label>
                                                <input type="file" name="product_photo" class="form-control" id="image" />
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0"></h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <img id="showImage" src="{{ (!empty($product->product_photo))?url('upload/product_images/'.$product->product_photo):url('upload/profile.jpg') }}" alt="Product" style="width:100px; height: 100px;" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-label">Checkboxes</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="new" value="1" {{ $product->productInfo->new ? 'checked' : '' }}>
                                                            <span class="custom-control-label">New</span>
                                                        </label>

                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="hot" value="1" {{ $product->productInfo->hot ? 'checked' : '' }}>
                                                            <span class="custom-control-label">Hot</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="sale" value="1" {{ $product->productInfo->sale ? 'checked' : '' }}>
                                                            <span class="custom-control-label">Sale</span>
                                                        </label>

                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="best_sale" value="1" {{ $product->productInfo->best_sale ? 'checked' : '' }}>
                                                            <span class="custom-control-label">Best sale</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .thumb-wrapper {
                                            position: relative;
                                            display: inline-block;
                                            margin: 10px;
                                        }
                                        .remove-btn {
                                            position: absolute;
                                            top: 5px;
                                            right: 5px;
                                            background-color: red;
                                            color: white;
                                            border: none;
                                            border-radius: 50%;
                                            width: 20px;
                                            height: 20px;
                                            text-align: center;
                                            cursor: pointer;
                                            display: none;
                                        }
                                        .thumb-wrapper:hover .remove-btn {
                                            display: block;
                                        }
                                    </style>

                                    <div class="card">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Update Product</button>
                                            <a href="" class="btn btn-danger float-end">Discard</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        <!-- ROW-1 END -->
                        </form>

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

                    // Bloodhound for brands
                    var product_categories = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                            url: "/product-category",
                            cache: false,
                        }
                    });

                    product_categories.initialize();

                    $('#product_category').tagsinput({
                        typeaheadjs: {
                            name: 'product_categories',
                            source: product_categories.ttAdapter()
                        },
                        confirmKeys: [13, 44],
                    });


                    // Bloodhound for brands
                    var product_subcategories = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                            url: "/product-subcategory",
                            cache: false,
                        }
                    });

                    product_subcategories.initialize();

                    $('#product-subcategory').tagsinput({
                        typeaheadjs: {
                            name: 'product_subcategories',
                            source: product_subcategories.ttAdapter()
                        },
                        confirmKeys: [13, 44],
                    });

                });
            </script>

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
<script>
    $(document).ready(function () {
    // Preview and upload new images
    $('#multiImg').on('change', function () {
        var data = $(this)[0].files;

        $.each(data, function (index, file) {
            if (/(\.|\/)(gif|jpe?g|png|webp|jfif)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var thumbWrapper = $('<div/>').addClass('col-md-3 thumb-wrapper');
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(150).height(120);
                        var removeBtn = $('<button/>').addClass('remove-btn').text('x');

                        thumbWrapper.append(img).append(removeBtn);
                        $('#preview_img').append(thumbWrapper);

                        removeBtn.on('click', function (e) {
                            e.preventDefault();
                            thumbWrapper.remove();
                        });
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });

        // AJAX call to upload images
        var formData = new FormData();
        $.each(data, function (index, file) {
            formData.append('multi_img[]', file);
        });

        $.ajax({
            url: '{{ route("update.multi.image") }}', // Update with your route
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success response
            },
            error: function (error) {
                // Handle error response
            }
        });
    });

    // Remove existing images
    $('#preview_img').on('click', '.remove-btn', function (e) {
        e.preventDefault();
        var thumbWrapper = $(this).closest('.thumb-wrapper');
        var imageId = thumbWrapper.data('id');

        $.ajax({
            url: '{{ route("delete.multi.image") }}', // Update with your route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: imageId
            },
            success: function (response) {
                thumbWrapper.remove();
            },
            error: function (error) {
                // Handle error response
            }
        });
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
