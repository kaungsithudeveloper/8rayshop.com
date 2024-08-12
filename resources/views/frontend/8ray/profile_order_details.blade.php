@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main">
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Order Detail
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
                                <div class="invoice-inner">
                                    <div class="invoice-info" id="invoice_wrapper">
                                        <div class="invoice-top">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header"><h4>Shipping Details</h4></div>
                                                        <hr>
                                                        <div class="card-body">
                                                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                                <tr>
                                                                    <th>Shipping Name:</th>
                                                                    <th>{{ $order->name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Shipping Phone:</th>
                                                                    <th>{{ $order->phone }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Shipping Email:</th>
                                                                    <th>{{ $order->email }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Shipping Address:</th>
                                                                    <th>{{ $order->adress }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Division:</th>
                                                                    <th>{{ $order->division->division_name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>District:</th>
                                                                    <th>{{ $order->district->district_name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>State :</th>
                                                                    <th>{{ $order->state->state_name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Order Date:</th>
                                                                    <th>{{ $order->order_date }}</th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Order Details
                                                                <span class="text-danger">Invoice : {{ $order->invoice_no }} </span>
                                                            </h4>
                                                        </div>
                                                        <hr>
                                                        <div class="card-body">
                                                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                                <tr>
                                                                    <th>Name :</th>
                                                                    <th>{{ $order->user->name }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Phone :</th>
                                                                    <th>{{ $order->user->phone }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Payment Type:</th>
                                                                    <th>{{ $order->payment_method }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Transx ID:</th>
                                                                    <th>{{ $order->transaction_id }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Invoice:</th>
                                                                    <th class="text-danger">{{ $order->invoice_no }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Order Amount:</th>
                                                                    <th>${{ $order->amount }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Order Status:</th>
                                                                    <th><span class="badge rounded-pill bg-warning">{{ $order->status }}</span></th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-center mt-20">
                                            <div class="table-responsive">
                                                <table class="table table-striped invoice-table">
                                                    <thead class="bg-active">
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th class="text-center">Product Code</th>
                                                            <th class="text-center">Color</th>
                                                            <th class="text-right">Quantity</th>
                                                            <th class="text-right">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderItem as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    <img src="{{ asset('/upload/product_images/' . $item->product->product_photo) }}" style="width:70px; height:70px;" >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="item-desc-1">
                                                                    {{ $item->product->product_name }}
                                                                </div>
                                                            </td>
                                                            <td class="text-center">{{ $item->product->product_code }}</td>
                                                            @if($item->color == NULL)
                                                                <td class="text-center">. . .</td>
                                                            @else
                                                                <td class="text-center">{{ $item->color }}</td>
                                                            @endif
                                                            <td class="text-right">
                                                                <label>
                                                                    {{ $item->qty }}
                                                                    @if($item->order->return_order == 1 && $item->return_qty > 0)
                                                                        <span class="badge rounded-pill" style="background:red;">Return</span>
                                                                    @endif
                                                                </label>
                                                            </td>
                                                            <td class="text-right">${{ $item->price }} <br> Total = ${{ $item->price * $item->qty }}</td>

                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="invoice-bottom">
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6 mt-10 col-offsite">
                                                    <div class="text-end">
                                                        <h5 class="mb-0 text-13">Grand Total:  <span>{{ $order->amount }}Ks</span> </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($order->status === 'delivered')
                                            @php
                                                $order = App\Models\Order::where('id', $order->id)->where('return_reason', '=', NULL)->first();
                                            @endphp
                                            @if($order)
                                                <div class="container">
                                                    <form action="{{ route('return.order', $order->id) }}" method="post">
                                                        @csrf

                                                        <div class="form-group" style="font-weight: 600; font-size: initial; color: #000000;">
                                                            <label>Select Product</label>
                                                            <select class="form-control" id="productSelect" name="product_id" required>
                                                                <option value="">Select Product</option>
                                                                @foreach($order->orderItems as $item)
                                                                    @if($item->return_qty == 0)
                                                                        <option value="{{ $item->product->id }}" data-colors="{{ $item->color }}">{{ $item->product->product_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group" style="font-weight: 600; font-size: initial; color: #000000;">
                                                            <label>Select Color</label>
                                                            <select class="form-control" id="colorSelect" name="color" required>
                                                                <option value="">Select Color</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group" style="font-weight: 600; font-size: initial; color: #000000;">
                                                            <label>Return Quantity</label>
                                                            <input type="number" name="return_qty" class="form-control" required>
                                                        </div>

                                                        <div class="form-group" style="font-weight: 600; font-size: initial; color: #000000;">
                                                            <label>Order Return Reason</label>
                                                            <textarea name="return_reason" class="form-control" style="width:100%;" required></textarea>
                                                        </div>

                                                        <button type="submit" class="btn-sm btn-danger" style="width:40%;">Order Return</button>
                                                    </form>
                                                </div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const productSelect = document.getElementById('productSelect');
                                                        const colorSelect = document.getElementById('colorSelect');

                                                        productSelect.addEventListener('change', function() {
                                                            const selectedOption = productSelect.options[productSelect.selectedIndex];
                                                            const colors = selectedOption.getAttribute('data-colors');

                                                            // Clear the color dropdown
                                                            colorSelect.innerHTML = '<option value="">Select Color</option>';

                                                            if (colors) {
                                                                const colorArray = colors.split(',');

                                                                // Populate the color dropdown with options
                                                                colorArray.forEach(function(color) {
                                                                    const option = document.createElement('option');
                                                                    option.value = color;
                                                                    option.text = color;
                                                                    colorSelect.appendChild(option);
                                                                });
                                                            }
                                                        });
                                                    });
                                                </script>
                                            @endif
                                        @endif



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

@push('scripts')

@endpush
