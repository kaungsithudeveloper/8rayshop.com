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
                                            <div class="form-group">
                                                <label for="long_descp" class="form-label">Product Description :</label>
                                                <textarea name="long_descp" id="myTextarea" class="content"></textarea>
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
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Brand Name :</label>
                                                        <select name="brand_id" class="form-control form-select" data-bs-placeholder="Select Product Type">
                                                            <option selected="">Open this select menu</option>
                                                                @foreach($brands as $brand)
                                                                    <option value="{{ $brand->id }}" >{{ $brand->brand_name }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Product Category :</label>
                                                        <select name="product_categories_id" class="form-control form-select" data-bs-placeholder="Select Product Type">
                                                            <option selected="">Open this select menu</option>
                                                                @foreach($product_categories as $category)
                                                                    <option value="{{ $category->id }}" >{{ $category->product_category_name }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Product SubCategory :</label>
                                                        <select name="product_sub_categories_id" class="form-control form-select" data-bs-placeholder="Select Product Type">
                                                            <option selected="">Open this select menu</option>
                                                                @foreach($product_sub_categories as $subcategory)
                                                                    <option value="{{ $subcategory->id }}" >{{ $subcategory->product_subcategory_name }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Product Type Name :</label>
                                                        <select name="product_type_id" class="form-control form-select" data-bs-placeholder="Select Product Type">
                                                            <option selected="">Open this select menu</option>
                                                                @foreach($product_type as $type)
                                                                    <option value="{{ $type->id }}" >{{ $type->product_type_name }}</option>
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

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="product_qty" class="form-label">Stock :<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_qty" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="selling_price" class="form-label">Selling Price:<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="selling_price" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product_size" class="form-label">Product Size :<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_size" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product_color" class="form-label">Product Color<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  name="product_color" required>
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
                                                    <img id="showImage" src="{{ (!empty($product->photo))?url('upload/admin_images/'.$product->photo):url('upload/profile.jpg') }}" alt="Admin" style="width:100px; height: 100px;" >
                                                </div>
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
                                                <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple="">

                                                <div class="row" id="preview_img"></div>

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
                $('#multiImg').on('change', function(){ //on file input change
                    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                    {
                        var data = $(this)[0].files; //this file data

                        $.each(data, function(index, file){ //loop though each file
                            if(/(\.|\/)(gif|jpe?g|png|webp|jfif)$/i.test(file.type)){ //check supported file type
                                var fRead = new FileReader(); //new filereader
                                fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(150)
                                .height(120); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                                })(file);
                                fRead.readAsDataURL(file); //URL representing the file's data.
                            }
                        });

                    }else{
                        alert("Your browser doesn't support File API!"); //if File API is absent
                    }
                });
                });

            </script>


            <script type="text/javascript">
                $(document).ready(function (){
                    $('#myForm').validate({
                        rules: {
                            product_code:       { required : true,},
                            product_name:       { required : true,},
                            product_qty:       { required : true,},
                            selling_price:       { required : true,},
                            discount_price:       { required : true,},
                        },
                        messages :{
                            product_code:       { required : 'Please Enter Product Code',},
                            product_name:       { required : 'Please Enter Product Name',},
                            product_qty:       { required : 'Please Enter Stock',},
                            selling_price:       { required : 'Please Enter Selling Price',},
                            discount_price:       { required : 'Please Enter Discount Price',},
                        },
                        errorElement : 'span',
                        errorPlacement: function (error,element) {
                            error.addClass('invalid-feedback');
                            element.closest('.form-group').append(error);
                        },
                        highlight : function(element, errorClass, validClass){
                            $(element).addClass('is-invalid');
                        },
                        unhighlight : function(element, errorClass, validClass){
                            $(element).removeClass('is-invalid');
                        },
                    });
                });

            </script>


@endsection

@push('scripts')
<!-- SHOW PASSWORD JS -->
<script src="{{ asset('backend/js/show-password.min.js') }}"></script>

<!-- INTERNAL WYSIWYG Editor JS -->
<script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
<script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>

@endpush
