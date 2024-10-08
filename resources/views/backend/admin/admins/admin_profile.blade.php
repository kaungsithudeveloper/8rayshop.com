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
                    <h1 class="page-title">{{ ucfirst(strtolower($adminData->name)) }} Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="card-header">
                                    <h3 class="card-title">Edit Profile</h3>
                                </div>
                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $adminData->name }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $adminData->username }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email1">Email address</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $adminData->email }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Contact Number</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $adminData->phone }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">About Me</label>
                                        <textarea class="form-control" rows="5" name="aboutme">{{ old('aboutme', $adminData->aboutme) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="Asign Roles">Asign Roles</label>
                                        <select name="roles" class="form-select mb-3"
                                            aria-label="Default select example" disabled>
                                            <option selected="">Open this select menu</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $adminData->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Photo</label>
                                        <input type="file" name="photo" class="form-control" id="image" />
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage"
                                                src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/profile.jpg') }}"
                                                alt="Admin" style="width:100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


@endsection

@push('scripts')
    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('backend/js/show-password.min.js') }}"></script>
@endpush
