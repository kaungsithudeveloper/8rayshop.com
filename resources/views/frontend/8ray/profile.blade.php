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
                                                    <div class="form-group col-md-6">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="name" type="text" value="{{ $user->name }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Username <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="username" type="text" value="{{ $user->username }}"/>
                                                    </div>
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

</main>

@endsection
