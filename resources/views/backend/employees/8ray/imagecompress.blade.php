@extends('backend.employees.layout.layout_8ray')

@section('employee')

<script src="{{ url('backend/plugins/custom/sortable.min.js') }}"></script>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Image Compress</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Image Compress</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <form id="myForm" method="post" action="{{ route('image.compress') }}" enctype="multipart/form-data">
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

                        <div class="mb-3">
                            <label for="compressimage" class="form-label">Select Image to Compress:</label>
                            <input class="form-control" name="compressimage[]" type="file" id="compressimage" multiple required>

                            <div class="row sortable" id="preview_img"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Compress Image</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->

<script>
    $(document).ready(function() {
        var fileList = [];

        $('#compressimage').on('change', function() {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files;

                $.each(data, function(index, file) {
                    if (/(\.|\/)(gif|jpe?g|png|webp|jfif)$/i.test(file.type)) {
                        fileList.push(file);
                        var fRead = new FileReader();
                        fRead.onload = (function(file, index) {
                            return function(e) {
                                var container = $('<div/>').addClass('col-md-3 mt-2 text-center').attr('data-index', index);
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(150).height(120);
                                var deleteBtn = $('<button/>').addClass('btn btn-danger btn-sm mt-2 mb-2').text('Delete').on('click', function() {
                                    var idx = $(this).parent().data('index');
                                    fileList.splice(idx, 1);
                                    $(this).parent().remove();
                                    updateFileInput();
                                });
                                container.append(img).append('<br>').append(deleteBtn);
                                $('#preview_img').append(container);
                            };
                        })(file, fileList.length - 1);
                        fRead.readAsDataURL(file);
                    }
                });
            } else {
                alert("Your browser doesn't support File API!");
            }
        });

        new Sortable(document.getElementById('preview_img'), {
            animation: 150,
            onEnd: function(evt) {
                var newOrder = [];
                $('#preview_img div').each(function() {
                    var idx = $(this).data('index');
                    newOrder.push(fileList[idx]);
                });
                fileList = newOrder;
                updateFileInput();
            }
        });

        function updateFileInput() {
            var dataTransfer = new DataTransfer();
            fileList.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            $('#compressimage')[0].files = dataTransfer.files;
        }
    });
</script>

@endsection
