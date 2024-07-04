@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> Login
            </div>
        </div>
    </div>

        <div class="page-content pt-150 pb-150">
            <div class="container">
                <form method="POST" action="{{ route('8ray.login.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                            <div class="row">
                                    <div class="col-lg-6 pr-30 d-none d-lg-block">
                                        <img class="border-radius-15" src="{{ url('frontend/8ray/imgs/page/login-1.png') }}" alt="" />
                                    </div>

                                    <div class="col-lg-6 col-md-8 mt-10">
                                        <div class="login_wrap widget-taber-content background-white">
                                            <div class="padding_eight_all bg-white">
                                                <div class="heading_s1">
                                                    <h1 class="mb-5">Login</h1>
                                                    <p class="mb-30">Don't have an account? <a href="{{ route('8ray.register') }}">Create here</a></p>
                                                </div>
                                                <form method="post">
                                                    <div class="form-group">
                                                        <input type="text" name="login" placeholder="Username or Email *" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" placeholder="Your password *" />
                                                    </div>
                                                    <div class="login_footer form-group mb-50">
                                                        <div class="chek-form">
                                                            <div class="custome-checkbox">
                                                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                                <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                            </div>
                                                        </div>
                                                        <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-heading btn-block hover-up" >
                                                            Login
                                                        </button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</main>

@endsection
