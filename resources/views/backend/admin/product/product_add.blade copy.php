@extends('backend.admin.layout.layout')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ url('backend/plugins/tagify/tagify.min.css') }}">

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
                                                <div class="form-group">
                                                    <label for="short_descp" class="form-label">Short Description :</label>
                                                    <textarea class="form-control mb-4" rows="4" name="short_descp"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="long_descp" class="form-label">Product Description :</label>
                                                    <textarea name="long_descp" id="myTextarea" class="content"></textarea>
                                                </div>
                                            </div>
                                        </div>

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



                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label"> Product Photo: </label>
                                                    <input type="file" name="product_photo" class="form-control" id="image" />
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0"></h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <img id="showImage" src="{{ (!empty($product->photo))?url('upload/admin_images/'.$product->photo):url('upload/profile.jpg') }}" alt="Admin" style="width:100px; height: 100px;" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="inputProductTitle" class="form-label">Multiple Image :</label>
                                                    <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple="">

                                                    <div class="row" id="preview_img"></div>
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
                                                        <select name="product_category_id" class="form-control select2-show-search form-select" id="inputVendor">
                                                            <option value="1">None</option>
                                                            @foreach($product_categories as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->product_category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label class="form-label"> Product SubCategory: </label>
                                                        <select name="product_subcategory_id[]" class="form-select select2" id="inputCollection" multiple>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label for="brand" class="form-label">Brand:</label>
                                                        <select name="brand_id" id="brand_id" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                                            <option label="Select Brand"></option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="product_size" class="form-label">Product Size :<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_size" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="purchase_price" class="form-label">Purchase Price:<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="purchase_price" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="selling_price" class="form-label">Selling Price:<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="selling_price" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="discount_price" class="form-label">Discount Price:<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="discount_price" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <label for="url" class="form-label">YouTube Link</label>
                                            <input type="url" class="form-control" id="url" name="url" >
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-label">Checkboxes</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="new" value="1" >
                                                            <span class="custom-control-label">New</span>
                                                        </label>

                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="hot" value="1" >
                                                            <span class="custom-control-label">Hot</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="sale" value="1" >
                                                            <span class="custom-control-label">Sale</span>
                                                        </label>

                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="best_sale" value="1" >
                                                            <span class="custom-control-label">Best sale</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Create Product</button>
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
    document.addEventListener('DOMContentLoaded', function () {

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, char => char.toUpperCase());
    }

    function initializeTagify(input) {
        const tagify = new Tagify(input, {
            whitelist: [],
            enforceWhitelist: false,
            dropdown: {
                enabled: 0, // show suggestions dropdown
                closeOnSelect: false // keep dropdown open after selecting a suggestion
            }
        });

        tagify.on('input', onInput);
        tagify.on('add', onAdd);

        // Add an input event listener to convert value to uppercase
        input.addEventListener('input', function (e) {
            e.target.value = e.target.value.toUpperCase();
        });
    }

    function onInput(e) {
        const value = e.detail.value;

        fetch(`/product-colors?query=${value}`)
            .then(response => response.json())
            .then(colors => {
                const tagify = e.detail.tagify;
                tagify.settings.whitelist.splice(0, tagify.settings.whitelist.length, ...colors.map(color => color.color_name));
                tagify.dropdown.show(); // render the suggestions dropdown
            });
    }

    function onAdd(e) {
    let colorName = capitalizeWords(e.detail.data.value); // Capitalize each word

        // Check if the color exists in the database
        fetch(`/colors/search?query=${colorName}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    // If color doesn't exist, add it to the database
                    fetch(`/colors/add`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ color_name: colorName }),
                    })
                        .then(response => response.json())
                        .then(newColor => {
                            console.log('Color added:', newColor);
                        })
                        .catch(error => {
                            console.log('Error adding color:', error);
                        });
                }
            })
            .catch(error => {
                console.log('Error searching color:', error);
            });
    }

    // Initialize Tagify for the existing input
    const initialInput = document.querySelector('.product-color-input');
    initializeTagify(initialInput);

    // Add new color input row
    document.addEventListener('click', function (event) {
        if (event.target.closest('.add-color-btn')) {
            const container = document.getElementById('color-input-container');
            const newRow = document.createElement('div');
            newRow.classList.add('row');
            newRow.innerHTML = `
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
            `;

            container.appendChild(newRow);

            // Initialize Tagify for the new input
            const newInput = newRow.querySelector('.product-color-input');
            initializeTagify(newInput);
        }

        // Add event listener to the delete button
        if (event.target.closest('.delete-color-btn')) {
            event.target.closest('.row').remove();
        }
    });
});

</script>


<script>
    $(function() {
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
    $(document).ready(function(){
        var fileList = [];

        $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png|webp|jfif)$/i.test(file.type)){ //check supported file type
                        fileList.push(file); //add file to the fileList
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file, index){ //trigger function on successful read
                        return function(e) {
                            var container = $('<div/>').addClass('col-md-3 mt-2 text-center').attr('data-index', index); //create container element with data-index attribute and center the content
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(150).height(120); //create image element
                            var deleteBtn = $('<button/>').addClass('btn btn-danger btn-sm mt-2 mb-2').text('Delete').on('click', function(){
                                var idx = $(this).parent().data('index');
                                fileList.splice(idx, 1); //remove file from fileList
                                $(this).parent().remove(); //remove container on delete button click
                                updateFileInput(); //update file input
                            });
                            container.append(img).append('<br>').append(deleteBtn); //append image and delete button to container, with a line break
                            $('#preview_img').append(container); //append container to output element
                        };
                        })(file, fileList.length - 1);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });

        function updateFileInput() {
            var dataTransfer = new DataTransfer();
            fileList.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            $('#multiImg')[0].files = dataTransfer.files; //update input element with the new fileList
        }
    });
</script>

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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<link rel="stylesheet" href="{{ url('backend/plugins/tagify/tagify.min.js') }}">

@endsection

@push('scripts')
<!-- SHOW PASSWORD JS -->
<script src="{{ asset('backend/js/show-password.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.0/tagify.min.js"></script>

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
