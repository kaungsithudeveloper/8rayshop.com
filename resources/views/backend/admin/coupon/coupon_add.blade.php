@extends('backend.admin.layout.layout')

@section('admin')
<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Coupon</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <form id="myForm" method="post" action="{{ route('store.coupon') }}">
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
                                    <div class="form-group">
                                        <label for="coupon_name" class="form-label">Coupon Name:<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="coupon_name" autocomplete="off" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="coupon_discount" class="form-label">Coupon Discount (%):<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" name="coupon_discount" autocomplete="off" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="coupon_qty">Coupon Quantity</label>
                                        <input type="number" name="coupon_qty" class="form-control" id="coupon_qty" required min="1">
                                    </div>

                                    <div class="form-group">
                                        <label for="coupon_validity" class="form-label">Coupon Validity Date:<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" name="coupon_validity" placeholder="MM/DD/YYYY" type="text" id="datepicker">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Create Coupon</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#datepicker", {
            dateFormat: "m/d/Y"
        });
    });
</script>
@endsection
