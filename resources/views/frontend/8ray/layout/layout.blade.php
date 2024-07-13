<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>8 Ray Shop</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="8Ray - Your one-stop shop for Lighting and Accessories, Microphones, Microphone stands and desk setup stands, Tripods & Selfie Sticks, Stabilizers, Product Photography Accessories, GoPro & Accessories, Sound Products, IT Gadgets, and CCTV equipment." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="8Ray - Lighting and Accessories, IT Gadgets, Sound Products, and More" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.8rayshop.com" />
    <meta property="og:image" content="https://www.yourshopdomain.com/path-to-your-image.jpg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/8ray/imgs/theme/logo-darks2.png') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/main.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/8ray/css/plugins/slider-range.css') }}" />
    <!-- View Message CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.8ray.layout.quick_view')

    <!-- Header  -->

    @include('frontend.8ray.layout.header')

    @include('frontend.8ray.layout.mobile_header ')

    <!--End header-->

    @yield('8ray')

    @include('frontend.8ray.layout.footer')

    <!-- Preloader Start -->

    @include('frontend.8ray.layout.loader')

    <!-- Vendor JS-->

    <script src="{{ url('frontend/8ray/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/slick.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/waypoints.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/wow.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/select2.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/counterup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/isotope.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/scrollup.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/plugins/leaflet.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ url('frontend/8ray/js/main.js') }}"></script>
    <script src="{{ url('frontend/8ray/js/shop.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <script type="text/javascript">

        function productView(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#pname').text(data.product.product_name);
                    $('#pcode').text(data.product.product_code);

                    // Display brand name
                    if (data.product.brands && data.product.brands.length > 0) {
                        $('#pbrand').text(data.product.brands[0].brand_name);
                    } else {
                        $('#pbrand').text('N/A');
                    }

                    // Display category names
                    if (data.product.categories && data.product.categories.length > 0) {
                        var categories = data.product.categories.map(function(category) {
                            return category.product_category_name;
                        }).join(', ');
                        $('#pcategory').text(categories);
                    } else {
                        $('#pcategory').text('N/A');
                    }

                    var sellingPrice = parseFloat(data.product.price.selling_price);
                    var discountPrice = parseFloat(data.product.price.discount_price);
                    var finalPrice = sellingPrice;
                    var percentOff = 0;

                    if (discountPrice && discountPrice > 0) {
                        finalPrice = sellingPrice - discountPrice;
                        percentOff = ((discountPrice / sellingPrice) * 100).toFixed(0);
                        $('#oldprice').text(sellingPrice + ' Ks').show();
                        $('#offprice').text(percentOff + '% Off').show();
                    } else {
                        $('#oldprice').hide();
                        $('#offprice').hide();
                    }

                    $('#pprice').text(finalPrice + ' Ks');

                    // Display stock information
                    var totalStock = 0;
                    if (data.product.stocks && data.product.stocks.length > 0) {
                        data.product.stocks.forEach(function(stock) {
                            totalStock += stock.stock_qty;
                        });
                    }

                    // Display colors
                    $('#color').empty();
                    if (data.product.productColor && data.product.productColor.length > 0) {
                        data.product.productColor.forEach(function(color) {
                            var colorItem = '<option value="' + color.color_name + '">' + color.color_name + '</option>';
                            $('#color').append(colorItem);
                        });
                        $('#colorArea').show();
                    } else {
                        $('#colorArea').hide();
                    }

                    if (totalStock > 0) {
                        $('#aviable').text('InStock').show();
                        $('#stockout').hide();
                    } else {
                        $('#aviable').hide();
                        $('#stockout').text('Out of Stock').show();
                    }

                    // Display main product image
                    if (data.product.product_photo) {
                        var mainImagePath = '{{ url('/') }}/upload/product_images/' + data.product.product_photo;
                        $('#pimage').attr('src', mainImagePath);
                    } else {
                        $('#pimage').attr('src', '{{ asset('images/no-image.jpg') }}');
                    }

                    $('#product_id').val(id);
                    $('#qty').val(1);
                }
            });
        }

        function addToCart(){
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                }
            });
        }

        function addToCartDetails(){
            var product_name = $('#dpname').text();
            var id = $('#dproduct_id').val();
            var color = $('#dcolor option:selected').text();
            var quantity = $('#dqty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/dcart/data/store/"+id,
                success:function(data){
                    miniCart();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                }
            });
        }


    </script>

    <script>

        function miniCart(){
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success:function(response){
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = "";
                    $.each(response.carts, function(key, value){
                        miniCart +=
                            `<ul>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html">
                                            <img style="width:50px;height:70px;" src="/upload/product_images/${value.options.image}" alt="Product" />
                                        </a>
                                    </div>
                                    <div class="shopping-cart-title" style="margin: -73px 74px 14px; width: 146px;">
                                        <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                                        <h4><span>${value.qty} × </span>${value.price}</h4>
                                    </div>
                                    <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                        <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)">
                                            <i class="fi-rs-cross-small"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <hr><br>`;
                    });

                    $('#miniCart').html(miniCart);
                }
            });
        }

        miniCart();

        function miniCartRemove(rowId){
            $.ajax({
                type: 'GET',
                url: '/minicart/product/remove/'+rowId,
                dataType:'json',
                success:function(data){
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    }else{

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }
            })
        }

    </script>






    @stack('scripts')
</body>

</html>
