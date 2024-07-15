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
                    if (data.product.colors && data.product.colors.length > 0) {
                        data.product.colors.forEach(function(color) {
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

        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text('Ks ' + response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = "";
                    $.each(response.carts, function(key, value) {
                        miniCart +=
                            `<ul>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html">
                                            <img style=max-width:70px;" src="/upload/product_images/${value.options.image}" alt="Product" />
                                        </a>
                                    </div>
                                    <div class="shopping-cart-title" style="margin: -73px 74px 14px; width: 146px;">
                                        <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                                        <h4><span>${value.qty} × </span>Ks ${value.price}</h4>
                                        <p>Color: ${value.options.color}</p>
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


    <!--  /// Start Wishlist Add -->
    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {

                    wishlist();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }
    </script>
    <!--  /// End Wishlist Add -->


    <!--  /// Start Load Wishlist Data -->
    <script type="text/javascript">

        function wishlist() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-product/",
                success: function(response) {

                    $('#wishQty').text(response.wishQty);

                    var rows = "";
                    $.each(response.wishlist, function(key, value) {
                        let totalStock = 0;
                        value.product.stocks.forEach(stock => {
                            totalStock += stock.stock_qty;
                        });

                        rows += `<tr class="pt-30">
                                    <td class="custome-checkbox pl-30"></td>
                                    <td class="image product-thumbnail pt-40"><img src="/upload/product_images/${value.product.product_photo}" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">(4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        ${value.product.price.discount_price == null
                                            ? `<h3 class="text-brand">${value.product.price.selling_price}Ks</h3>`
                                            : `<h3 class="text-brand">${value.product.price.selling_price - value.product.price.discount_price}Ks</h3>`
                                        }
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        ${totalStock > 0
                                            ? `<span class="stock-status in-stock mb-0">In Stock</span>`
                                            : `<span class="stock-status out-stock mb-0">Stock Out</span>`
                                        }
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>`;
                    });
                    $('#wishlist').html(rows);
                }
            });
        }

        wishlist();

        // Wishlist Remove Start
        function wishlistRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/"+id,
                success:function(data){
                wishlist();
                     // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',

                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

           Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
              // End Message
                }
            })
        }
        // Wishlist Remove End

    </script>
    <!--  /// End Load Wishlist Data -->

    <!--  /// Start Compare Add -->
    <script type="text/javascript">

        function addToCompare(product_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-compare/"+product_id,
                success:function(data){

                    // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',

                showConfirmButton: false,
                timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

        Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
            // End Message
                }
            })
        }
    </script>
    <!--  /// End Compare Add -->


    <!--  /// Start Load Compare Data -->
    <script type="text/javascript">

        function compare() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-compare-product/",
                success: function(response) {
                    var images = "<tr class='pr_image'><td class='text-muted font-sm fw-600 font-heading mw-200'>Preview</td>";
                    var names = "<tr class='pr_title'><td class='text-muted font-sm fw-600 font-heading'>Name</td>";
                    var prices = "<tr class='pr_price'><td class='text-muted font-sm fw-600 font-heading'>Price</td>";
                    var descriptions = "<tr class='description'><td class='text-muted font-sm fw-600 font-heading'>Description</td>";
                    var stocks = "<tr class='pr_stock'><td class='text-muted font-sm fw-600 font-heading'>Stock</td>";
                    var colors = "<tr class='pr_color'><td class='text-muted font-sm fw-600 font-heading'>Color</td>";
                    var removes = "<tr class='pr_remove text-muted'><td class='text-muted font-md fw-600'></td>";

                    $.each(response, function(key, value) {
                        var colorNames = "";
                        $.each(value.product.colors, function(colorKey, colorValue) {
                            colorNames += `<span class="stock-status in-stock mb-0">${colorValue.color_name}</span> `;
                        });

                        images += `
                            <td class='row_img'>
                                <img src="/upload/product_images/${value.product.product_photo}" style="width:300px; height:300px;" alt="compare-img" />
                            </td>`;

                        names += `
                            <td class='product_name'>
                                <h6><a href="shop-product-full.html" class="text-heading">${value.product.product_name}</a></h6>
                            </td>`;

                        prices += `
                            <td class='product_price'>
                                ${value.product.price.discount_price == null
                                    ? `<h4 class="price text-brand">${value.product.price.selling_price}Ks</h4>`
                                    : `<h4 class="price text-brand">${value.product.price.selling_price - value.product.price.discount_price}Ks</h4>`
                                }
                            </td>`;

                        descriptions += `
                            <td class='row_text font-xs'>
                                <p class="font-sm text-muted">${value.product.product_info.short_descp}</p>
                            </td>`;

                        stocks += `
                            <td class='row_stock'>
                                ${value.product.total_stock > 0
                                    ? `<span class="stock-status in-stock mb-0">In Stock</span>`
                                    : `<span class="stock-status out-stock mb-0">Stock Out</span>`
                                }
                            </td>`;

                        colors += `
                            <td class='row_color'>
                                ${colorNames}
                            </td>`;

                        removes += `
                            <td class='row_remove'>
                                <a href="#" class="text-muted" id="${value.id}" onclick="compareRemove(this.id)">
                                    <i class="fi-rs-trash mr-5"></i><span>Remove</span>
                                </a>
                            </td>`;
                    });

                    images += "</tr>";
                    names += "</tr>";
                    prices += "</tr>";
                    descriptions += "</tr>";
                    stocks += "</tr>";
                    colors += "</tr>";
                    removes += "</tr>";

                    var tableContent = images + names + prices + descriptions + stocks + colors + removes;

                    $('#compare').html(tableContent);
                }
            });
        }

        compare();

        // Compare Remove Start

        function compareRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/compare-remove/"+id,
                success:function(data){
                compare();
                     // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',

                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

           Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
              // End Message
                }
            })
        }
        // Compare Remove End


    </script>

    <!--  // Start Load MY Cart // -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {

                    var rows = "";
                    $.each(response.carts, function(key, value) {
                        var productName = value.name;
                        var truncatedName = productName.length > 20 ? productName.substring(0, 20) + '...' : productName;
                        var subtotal = parseInt(value.subtotal);
                        rows +=
                            `
                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30">

                                </td>
                                <td class="image product-thumbnail pt-40">
                                    <img src="/upload/product_images/${value.options.image}" alt="#">
                                </td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5">
                                        <a class="product-name mb-10 text-heading" href="shop-product-right.html">
                                            ${truncatedName}
                                        </a>
                                    </h6>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">${value.price}Ks </h4>
                                </td>
                                <td class="price" data-title="Color">
                                    ${value.options.color ? `<h6 class="text-body">${value.options.color}</h6>` : `<span>....</span>`}
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">
                                            <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                                            <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                            <a  type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                </td>

                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">${subtotal}Ks </h4>
                                </td>
                                <td class="action text-center" data-title="Remove">
                                    <a type="submit" class="text-body"  id="${value.rowId}" onclick="cartRemove(this.id)">
                                        <i class="fi-rs-trash"></i>
                                    </a>
                                </td>

                            </tr>

                            `;
                    });
                    $('#cartPage').html(rows);
                }
            });
        }
        cart();


        // Cart Remove Start
        function cartRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/cart-remove/"+id,
                success:function(data){

                    cart();
                    miniCart();
                    couponCalculation();

                     // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',

                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

           Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
              // End Message
                }
            })
        }
        // Cart Remove End

        function cartDecrement(rowId){
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/"+rowId,
                dataType: 'json',
                success:function(data){
                    cart();
                    miniCart();
                    couponCalculation();
                }
            });
        }
        // Cart Decrement End

        function cartIncrement(rowId){
            $.ajax({
                type: 'GET',
                url: "/cart-increment/"+rowId,
                dataType: 'json',
                success:function(data){
                    cart();
                    miniCart();
                    couponCalculation();
                }
            });
        }

    </script>
    <!--  // End Load MY Cart // -->

    <!--  ////////////// Start Apply Coupon ////////////// -->
    <script type="text/javascript">
        function applyCoupon(){
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    coupon_name: coupon_name,
                    _token: '{{ csrf_token() }}' // Add CSRF token
                },
                url: "{{ route('coupon.apply') }}",
                success: function(data){

                    couponCalculation();

                    if (data.validity) {
                        $('#couponField').hide();
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if (!$.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    }
                }
            });
        }

        // Start CouponCalculation Method
        function couponCalculation(){
            $.ajax({
                type: 'GET',
                url: "/coupon-calculation",
                dataType: 'json',
                success:function(data){

                    function numberWithCommas(x) {
                        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${numberWithCommas(data.total)} Ks</h4>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${numberWithCommas(data.total)} Ks</h4>
                                </td>
                            </tr>`
                        )
                    }else{
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${numberWithCommas(data.subtotal)} Ks</h4>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">
                                        ${data.coupon_name}
                                        <a type="submit" onclick="couponRemove()">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Discount Amount  </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${numberWithCommas(data.discount_amount)} Ks</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${numberWithCommas(data.total_amount)} Ks</h4>
                                </td>
                            </tr> `
                        )
                    }
                }
            })
        }

        couponCalculation();

        // Start CouponCalculation Method


        function couponRemove(){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/coupon-remove",
                success:function(data){
                    couponCalculation();
                    $('#couponField').show();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }
            });
        }
        // Coupon Remove End

    </script>

     <!--  ////////////// End Apply Coupon ////////////// -->





    @stack('scripts')
</body>

</html>
