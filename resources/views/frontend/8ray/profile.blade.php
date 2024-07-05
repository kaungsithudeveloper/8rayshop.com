@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main">

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Profile
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">

                            @include('frontend.8ray.layout.profile_sidebar')

                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content ">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-1">Hello {{ $user->name }}</h3>
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('8ray.user.profile.update') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group col-md-12">
                                                            <label>Profile Photo</label>
                                                            <div class="file-input-container" id="fileInputContainer">
                                                                <span class="file-input-label">Drag and drop or click to upload</span>
                                                                <input class="file-input" name="photo" type="file" id="photoInput" accept="image/*"/>
                                                                <img id="photoPreview" class="file-input-preview" alt="Profile Photo Preview"
                                                                src="{{ !empty($user->photo) ? url('upload/user_images/' . $user->photo) : url('upload/profile.jpg') }}">
                                                                <button class="remove-button" id="removeButton">&times;</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Name <span class="required">*</span></label>
                                                            <input required="" class="form-control " name="name" type="text" value="{{ $user->name }}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Username <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="username" type="text" value="{{ $user->username }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" type="email" value="{{ $user->email }}"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Phone Number <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="phone" type="text" value="{{ $user->phone }}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>About Me <span class="required">*</span></label>
                                                        <textarea class="form-control w-100" name="aboutme" style="height: 200px;">{{ $user->aboutme }}</textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const fileInputContainer = document.getElementById('fileInputContainer');
        const photoInput = document.getElementById('photoInput');
        const photoPreview = document.getElementById('photoPreview');
        const fileInputLabel = document.querySelector('.file-input-label');
        const removeButton = document.getElementById('removeButton');

        // Show existing image on page load if exists
        window.addEventListener('load', () => {
            if (photoPreview.src) {
                photoPreview.style.display = 'block';
                fileInputLabel.style.display = 'none';
                removeButton.style.display = 'block';
            }
        });

        function previewPhoto(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
                fileInputLabel.style.display = 'none';
                removeButton.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }

        fileInputContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileInputContainer.classList.add('dragover');
        });

        fileInputContainer.addEventListener('dragleave', () => {
            fileInputContainer.classList.remove('dragover');
        });

        fileInputContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInputContainer.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                previewPhoto(file);
            }
        });

        fileInputContainer.addEventListener('click', () => {
            photoInput.click();
        });

        photoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                previewPhoto(file);
            }
        });

        removeButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            photoPreview.src = '';
            photoPreview.style.display = 'none';
            fileInputLabel.style.display = 'block';
            removeButton.style.display = 'none';
            photoInput.value = '';
        });
    </script>

</main>

@endsection
