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
                    <div class="col-lg-8">
                        <div class="card">
                            <form method="post" action="{{ route('admin.update.password') }}">
                                @csrf
                                <div class="card-header">
                                    <div class="card-title">Edit Password</div>
                                </div>

                                <div class="card-body">
                                    <div class="text-center chat-image mb-5">
                                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                            <a class="" href="#">
                                                <img alt="avatar"
                                                    src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/profile.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="main-chat-msg-name">
                                            <a href="#">
                                                <h5 class="mb-1 text-dark fw-semibold">{{ $adminData->username }}</h5>
                                            </a>
                                            <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{ $adminData->role }}</p>
                                        </div>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                id="current_password" placeholder="Current Password" />

                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input type="password" name="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" placeholder="New Password" />

                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                id="new_password_confirmation" placeholder="Confirm New Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
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
