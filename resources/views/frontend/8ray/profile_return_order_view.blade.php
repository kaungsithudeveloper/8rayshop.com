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
                                <div class="tab-content account dashboard-content">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Date</th>
                                                            <th>Totaly</th>
                                                            <th>Payment</th>
                                                            <th>Invoice</th>
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $key=> $order)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td> {{ $order->order_date }}</td>
                                                                <td> ${{ $order->amount }}</td>
                                                                <td> {{ $order->payment_method }}</td>
                                                                <td> {{ $order->invoice_no }}</td>
                                                                <td> {{ $order->return_reason }}</td>
                                                                <td>
                                                                    @if($order->return_order == 0)
                                                                        <span class="badge rounded-pill bg-warning">No Retrun Request</span>

                                                                    @elseif($order->return_order == 1)
                                                                        <span class="badge rounded-pill bg-danger">Pedding</span>

                                                                    @elseif($order->return_order == 2)
                                                                        <span class="badge rounded-pill bg-success">Success</span>


                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ url('8ray/user/order_details/'.$order->id) }}" class="btn-sm btn-success">
                                                                        <i class="fa fa-eye"></i> View
                                                                    </a>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</main>

@endsection
