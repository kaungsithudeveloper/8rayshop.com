@extends('backend.admin.layout.layout')

@section('admin')
<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Admin Dashboard</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('add.coupon') }}" class="btn btn-primary">Create New Coupon</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-datatable" class="table table-bordered text-nowrap mb-0 table-striped">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID</th>
                                            <th class="bg-transparent border-bottom-0">Coupon Name</th>
                                            <th class="bg-transparent border-bottom-0">Coupon Discount</th>
                                            <th class="bg-transparent border-bottom-0">Coupon Validity</th>
                                            <th class="bg-transparent border-bottom-0">Coupon Status</th>
                                            <th class="bg-transparent border-bottom-0 text-center" style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupon as $key => $item)
                                            <tr class="border-bottom">
                                                <td class="text-center">
                                                    <div class="mt-0 mt-sm-2 d-block">
                                                        <h6 class="mb-0 fs-14 fw-semibold">{{ $key + 1 }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="mt-0 mt-sm-3 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item->coupon_name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="mt-0 mt-sm-3 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $item->coupon_discount }}%</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="mt-0 mt-sm-3 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                    <span class="badge rounded-pill bg-success">Valid</span>
                                                    @else
                                                    <span class="badge rounded-pill bg-danger">Invalid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="g-2 text-center">
                                                        <a href="{{ route('edit.coupon',$item->id) }}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                            <span class="fe fe-edit fs-14"></span>
                                                        </a>
                                                        <a href="{{ route('delete.coupon',$item->id) }}" class="btn text-danger btn-sm" id="delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                            <span class="fe fe-trash-2 fs-14"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->
@endsection
