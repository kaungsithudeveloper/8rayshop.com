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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_code" class="form-label">Product Code :<span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="product_code" value="{{ $product->product_code }}" autocomplete="product_code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="product_name" class="form-label">Product Name:<span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" autocomplete="product_name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Colors Section -->


                        <div class="card">
                            <div class="card-body">
                                <label for="inputProductTitle" class="form-label">Product Color :</label>
                                <div id="color-input-container">
                                    @foreach($stocksGroupedByColor as $stock)
                                    <div class="d-flex">
                                        <input type="text" name="product_color_id[]" class="form-control m-1" value="{{ $stock['product_color_id'] }}" hidden>
                                        <input type="text" class="form-control m-1" value="{{ $stock['color_name'] }}" readonly>
                                        <input type="text" class="form-control m-1" name="stock_qty_1[]" value="{{ $stock['stock_qty_1'] }}">
                                        <input type="text" class="form-control m-1" name="stock_qty_2[]" value="{{ $stock['stock_qty_2'] }}">
                                        <a href="javascript:void(0)" class="btn text-danger btn-sm add-color-btn ms-2" data-bs-toggle="tooltip" data-bs-original-title="Add Color">
                                            <span class="fe fe-edit fs-14"></span>
                                        </a>
                                        <a href="javascript:void(0)" class="btn text-danger btn-sm delete-color-btn ms-2">
                                            <span class="fe fe-trash-2 fs-14"></span>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <a href="" class="btn btn-danger float-end">Discard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
        const colorName = e.detail.data.value;

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

    // Initialize Tagify for the existing inputs
    document.querySelectorAll('.product-color-input').forEach(input => {
        initializeTagify(input);
    });

    // Add new color input row
    document.addEventListener('click', function (event) {
        if (event.target.closest('.add-color-btn')) {
            const container = document.getElementById('color-input-container');
            const newRow = document.createElement('div');
            newRow.classList.add('d-flex', 'mb-2');
            newRow.innerHTML = `
                <input type="text" name="product_color_id[]" class="form-control m-1 product-color-input" placeholder="Select Color">
                <input type="text" class="form-control m-1" name="stock_qty_1[]" placeholder="Stock for Branch 1">
                <input type="text" class="form-control m-1" name="stock_qty_2[]" placeholder="Stock for Branch 2">
                <a href="javascript:void(0)" class="btn text-danger btn-sm ms-2 add-color-btn" data-bs-toggle="tooltip" data-bs-original-title="Add Color">
                    <span class="fe fe-edit fs-14"></span>
                </a>
                <a href="javascript:void(0)" class="btn text-danger btn-sm delete-color-btn ms-2" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                    <span class="fe fe-trash-2 fs-14"></span>
                </a>
            `;

            container.appendChild(newRow);

            // Initialize Tagify for the new input
            const newInput = newRow.querySelector('.product-color-input');
            initializeTagify(newInput);
        }

        // Add event listener to the delete button
        if (event.target.closest('.delete-color-btn')) {
            event.target.closest('.d-flex').remove();
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
