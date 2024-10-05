<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeBrandController;
use App\Http\Controllers\EmployeeProductController;
use App\Http\Controllers\EmployeeUserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ShippingAreaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\EmployeeOrderController;


use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\CheckoutController;

use App\Http\Controllers\PosController;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSubCategory;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/employee/login', [EmployeeController::class, 'EmployeeLogin'])->name('employee.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/8ray/login', [FrontendController::class, 'EightRayLogin'])->name('8ray.login')->middleware('guest');
Route::post('/8ray/login', [AuthenticatedSessionController::class, 'store'])->name('8ray.login.post');
Route::get('/8ray/register', [FrontendController::class, 'EightRayRegister'])->name('8ray.register')->middleware('guest');
Route::post('/8ray/register', [RegisteredUserController::class, 'store'])->name('8ray.register.post');
Route::get('/8ray/logout', [FrontendController::class, 'EightRayLogOut'])->name('8ray.logout');

Route::get('/datacentre/login', [FrontendController::class, 'DatacentreLogin'])->name('datacentre.login')->middleware('guest');
Route::post('/datacentre/login', [AuthenticatedSessionController::class, 'store'])->name('datacentre.login.post');
Route::get('/datacentre/register', [FrontendController::class, 'DatacentreRegister'])->name('datacentre.register')->middleware('guest');
Route::post('/datacentre/register', [RegisteredUserController::class, 'store'])->name('datacentre.register.post');
Route::post('/datacentre/logout', [AuthenticatedSessionController::class, 'destroy'])->name('datacentre.logout');
Route::get('/product/check-stock/{id}', [ProductController::class, 'checkStock']);
Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');

    // Backend Admin routes
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout',  'LogOut')->name('admin.logout');
        Route::get('/admins/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store',  'AdminProfileStore')->name('admin.profile.store');


        Route::get('/admin/password',  'AdminPasswordEdit')->name('admin.password.edit');
        Route::post('/admin/update/password',  'AdminUpdatePassword')->name('admin.update.password');


        Route::get('/admins', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store',  'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/{id}' ,  'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/user/update/{id}',  'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/{id}' ,  'DeleteAdminRole')->name('delete.admin.role');

        Route::get('/inactive/admin/{id}' ,  'AdminInactive')->name('inactive.admin');
        Route::get('/active/admin/{id}' ,  'AdminActive')->name('active.admin');

    });

    // Backend Employee routes
    Route::controller(AdminEmployeeController::class)->group(function(){

        Route::get('/employees', 'AdminEmployee')->name('all.employee');
        Route::get('/add/employee', 'AddAdminEmployee')->name('add.employee');
        Route::post('/store/employee',  'StoreAdminEmployee')->name('store.employee');
        Route::get('/edit/employee/{id}' ,  'EditAdminEmployee')->name('edit.employee');
        Route::post('/update/employee/{id}',  'UpdateAdminEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}' ,  'DeleteAdminEmployee')->name('delete.employee');
        Route::get('/inactive/employee/{id}' ,  'AdminEmployeeInactive')->name('inactive.employee');
        Route::get('/active/employee/{id}' ,  'AdminEmployeeActive')->name('active.employee');

        Route::get('/edit/employee/salary/{id}' ,  'EditAdminEmployeeSalary')->name('edit.employee.salary');
        Route::put('/update/employee/salary/{id}', 'UpdateAdminEmployeeSalary')->name('update.employee.salary');

    });

    // Backend user routes
    Route::controller(AdminUserController::class)->group(function(){
        Route::get('/admin/users', 'AllAdminUser')->name('all.admin.user');
        Route::get('/add/admin/users', 'AddAdminUser')->name('add.admin.user');
        Route::post('/store/admin/users',  'StoreAdminUser')->name('store.admin.user');
        Route::get('/edit/admin/users/{id}' ,  'EditAdminUser')->name('edit.admin.user');
        Route::post('/update/admin/users/{id}',  'UpdateAdminUser')->name('update.admin.user');
        Route::get('/delete/admin/users/{id}' ,  'DeleteAdminUser')->name('delete..admin.user');
    });

    // Backend Product Category routes
    Route::controller(ProductCategoryController::class)->group(function(){
        Route::get('/backend/product/categories', 'AllProductCategories')->name('all.product.categories');
        Route::post('/backend/product/categories/store',  'StoreProductCategories')->name('store.product.categories');
        Route::get('/backend/product/categories/edit/{slug}', 'EditProductCategories')->name('edit.product.categories');
        Route::post('/backend/product/categories/update', 'UpdateProductCategories')->name('update.product.categories');
        Route::get('/backend/product/categories/delete/{id}' ,  'DestoryProductCategories')->name('delete.product.categories');
    });

    // Backend Product SubCategory routes
    Route::controller(ProductSubCategoryController::class)->group(function(){
        Route::get('/backend/product/sub_categories', 'AllProductSubCategories')->name('all.product.sub_categories');
        Route::post('/backend/product/sub_categories/store',  'StoreProductSubCategories')->name('store.product.sub_categories');
        Route::get('/backend/product/sub_categories/edit/{slug}', 'EditProductSubCategories')->name('edit.product.sub_categories');
        Route::post('/backend/product/sub_categories/update', 'UpdateProductSubCategories')->name('update.product.sub_categories');
        Route::get('/backend/product/sub_categories/delete/{id}' ,  'DestoryProductSubCategories')->name('delete.product.sub_categories');

    });

    // Backend Product Type routes
    Route::controller(ProductTypeController::class)->group(function(){
        Route::get('/backend/product/types', 'AllProductType')->name('all.product.types');
        Route::post('/backend/product/type/store',  'StoreProductType')->name('store.product.types');
        Route::get('/backend/product/type/edit/{slug}', 'EditProductType')->name('edit.product.types');
        Route::post('/backend/product/type/update', 'UpdateProductType')->name('update.product.types');
        Route::get('/backend/product/type/delete/{id}' ,  'DestoryProductType')->name('delete.product.types');
    });

    // Backend Brand routes
    Route::controller(BrandController::class)->group(function(){
        Route::get('/backend/brand', 'AllBrand')->name('all.brand');
        Route::post('/backend/brand/store',  'StoreBrand')->name('store.brand');
        Route::get('/backend/brand/edit/{slug}', 'EditBrand')->name('edit.brand');
        Route::post('/backend/brand/update', 'UpdateBrand')->name('update.brand');
        Route::get('/backend/brand/delete/{id}' ,  'DestoryBrand')->name('delete.brand');
    });

    Route::controller(StockController::class)->group(function(){
        Route::get('/backend/stock', 'AllStock')->name('all.stock');
        Route::post('/backend/stock/store',  'StoreStock')->name('store.stock');
        Route::get('/backend/stock/delete/{id}' ,  'DestoryStock')->name('delete.stock');
    });

    //Backend Product Management Routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('/backend/product', 'AllProduct')->name('all.product');
        Route::get('/backend/product/add', 'AddProduct')->name('product.add');
        Route::get('/backend/product/add/admin', 'AddProductAdmin')->name('product.add.admin');
        Route::post('/backend/product/store',  'StoreProduct')->name('store.product');
        Route::post('/backend/product/adminstoreproduct',  'AdminStoreProduct')->name('admin.store.product');
        Route::get('/backend/product/edit/{slug}','EditProduct')->name('edit.product');
        Route::post('/backend/product/update', 'UpdateProduct')->name('update.product');
        Route::get('/backend/product/delete/{id}' ,  'DestoryProduct')->name('delete.product');
        Route::get('/backend/inactive/product/{id}' ,  'ProductInactive')->name('inactive.product');
        Route::get('/backend/active/product/{id}' ,  'ProductActive')->name('active.product');

        Route::get('/colors/search', 'search')->name('colors.search');
        Route::post('/colors/add','store')->name('colors.store');
        Route::delete('/stock/delete/{colorId}', 'deleteStock')->name('stock.delete');
        Route::delete('/stocks/color/{colorId}', 'deleteStocksByColor')->name('stocks.deleteByColor');
        Route::delete('/stocks/{id}', 'destroy');

        //Test Youtube video Link Good
        Route::get('/product_infos', 'index');
    });

    Route::controller(AccountantController::class)->group(function(){
        Route::get('/accountant' , 'index')->name('accountant');
        Route::get('/accountant/brand/{brand_slug}', 'showBrandDetail')->name('brand.accountant');
    });

    //Backend Cupon Routes
    Route::controller(CouponController::class)->group(function(){
        Route::get('/all/coupon' , 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon' , 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon' , 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');
        Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');
        Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');
        Route::get('/admin/order/cancel/{order_id}', 'cancelOrder')->name('processing-cancel');
    });

    Route::controller(ReturnController::class)->group(function(){
        Route::get('/return/request' , 'ReturnRequest')->name('return.request');
        Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');
        Route::get('/complete/return/request' , 'CompleteReturnRequest')->name('complete.return.request');
    });

    //Backend sHIP Routes
    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/division' , 'AllDivision')->name('all.division');
        Route::get('/add/division' , 'AddDivision')->name('add.division');
        Route::post('/store/division' , 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
        Route::post('/update/division' , 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');

        Route::get('/all/district' , 'AllDistrict')->name('all.district');
        Route::post('/store/district' , 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}' , 'EditDistrict')->name('edit.district');
        Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}' , 'DeleteDistrict')->name('delete.district');

        Route::get('/all/state' , 'AllState')->name('all.state');
        Route::get('/add/state' , 'AddState')->name('add.state');
        Route::post('/store/state' , 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
        Route::post('/update/state' , 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

    });

    Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'GetDistrict']);

    // Backend Role routes
    Route::controller(RoleController::class)->group(function(){

        //Backend Permission Route
        Route::get('/backend/all/permission','AllPermission')->name('all.permission');
        Route::get('/backend/add/permission','AddPermission')->name('add.permission');
        Route::post('/backend/store/permission','StorePermission')->name('store.permission');
        Route::get('/backend/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/backend/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/backend/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        //Backend Role Route
        Route::get('/backend/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/backend/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/backend/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/backend/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/backend/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/backend/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

        // add role permission
        Route::get('/backend/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/backend/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/backend/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/backend/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/backend/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/backend/admin/delete/roles/{id}', 'AdminRolesDelete')->name('admin.delete.roles');

    });

});


Route::middleware(['auth','role:employee'])->group(function () {

    Route::controller(EmployeeDashboardController::class)->group(function(){

        Route::get('/employee/page',  'EmployeePage')->name('employee.page');
        //Route::get('/employee/dashboard',  'EmployeeDashboard')->name('employee.dashboard');

        //////////// Start 8Ray Route ////////////
        Route::get('/employee/8ray/dashboard',  'Employee8rayDashboard')->name('employee.8ray.dashboard');
        //////////// End 8Ray Route ////////////

        //////////// Start DataCentre Route ////////////
        Route::get('/employee/datacentre/dashboard',  'EmployeeDatacentreDashboard')->name('employee.datacentre.dashboard');
        //////////// End DataCentre Route ////////////

    });

    // Backend user routes
    Route::controller(EmployeeUserController::class)->group(function(){
        Route::get('/employee/users', 'AllEmployeeUser')->name('all.employee.user');
        Route::get('/add/employee/users', 'AddEmployeeUser')->name('add.employee.user');
        Route::post('/store/employee/users',  'StoreEmployeeUser')->name('store.employee.user');
        Route::get('/edit/employee/users/{id}' ,  'EditEmployeeUser')->name('edit.employee.user');
        Route::post('/update/employee/users/{id}',  'UpdateEmployeeUser')->name('update.employee.user');
        Route::get('/delete/employee/users/{id}' ,  'DeleteEmployeeUser')->name('delete..employee.user');
    });

    Route::controller(EmployeeBrandController::class)->group(function(){
        Route::get('/backend/employee/brand', 'AllEmployeeBrand')->name('all.employee.brand');
        Route::post('/backend/employee/brand/store',  'StoreEmployeeBrand')->name('store.employee.brand');
        Route::get('/backend/employee/brand/edit/{slug}', 'EditEmployeeBrand')->name('edit.employee.brand');
        Route::post('/backend/employee/brand/update', 'UpdateEmployeeBrand')->name('update.employee.brand');
        Route::get('/backend/employee/brand/delete/{id}' ,  'DestoryEmployeeBrand')->name('delete.employee.brand');
    });

    Route::controller(ProductCategoryController::class)->group(function(){
        Route::get('/backend/employee/product/categories', 'AllEmployeeProductCategories')->name('all.employee.product.categories');
        Route::post('/backend/employee/product/categories/store',  'StoreEmployeeProductCategories')->name('store.employee.product.categories');
        Route::get('/backend/employee/product/categories/edit/{slug}', 'EditEmployeeProductCategories')->name('edit.employee.product.categories');
        Route::post('/backend/employee/product/categories/update', 'UpdateEmployeeProductCategories')->name('update.employee.product.categories');
        Route::get('/backend/employee/product/categories/delete/{id}' ,  'DestoryEmployeeProductCategories')->name('delete.employee.product.categories');
    });

    Route::controller(ProductSubCategoryController::class)->group(function(){
        Route::get('/backend/employee/product/sub_categories', 'AllEmployeeProductSubCategories')->name('all.employee.product.sub_categories');
        Route::post('/backend/employee/product/sub_categories/store',  'StoreEmployeeProductSubCategories')->name('store.employee.product.sub_categories');
        Route::get('/backend/employee/product/sub_categories/edit/{slug}', 'EditEmployeeProductSubCategories')->name('edit.employee.product.sub_categories');
        Route::post('/backend/employee/product/sub_categories/update', 'UpdateEmployeeProductSubCategories')->name('update.employee.product.sub_categories');
        Route::get('/backend/employee/product/sub_categories/delete/{id}' ,  'DestoryEmployeeProductSubCategories')->name('delete.employee.product.sub_categories');
    });

    Route::controller(ProductTypeController::class)->group(function(){
        Route::get('/backend/employee/product/types', 'AllEmployeeProductType')->name('all.employee.product.types');
        Route::post('/backend/employee/product/type/store',  'StoreEmployeeProductType')->name('store.employee.product.types');
        Route::get('/backend/employee/product/type/edit/{slug}', 'EditEmployeeProductType')->name('edit.employee.product.types');
        Route::post('/backend/employee/product/type/update', 'UpdateEmployeeProductType')->name('update.employee.product.types');
        Route::get('/backend/employee/product/type/delete/{id}' ,  'DestoryEmployeeProductType')->name('delete.employee.product.types');
    });

    Route::controller(EmployeeProductController::class)->group(function(){
        Route::get('/employee/product', 'AllEmployeeProduct')->name('all.employee.product');
        Route::get('/employee/product/add', 'AddEmployeeProduct')->name('add.employee.product');
        Route::post('/employee/product/store',  'StoreEmployeeProduct')->name('store.employee.product');
        Route::get('/employee/product/edit/{slug}','EditEmployeeProduct')->name('edit.employee.product');
        Route::post('/employee/product/update', 'UpdateEmployeeProduct')->name('update.employee.product');
        Route::get('/employee/product/delete/{id}' ,  'DestoryEmployeeProduct')->name('delete.employee.product');

        Route::get('/inactive/employee/product/{id}' ,  'ProductEmployeeInactive')->name('inactive.employee.product');
        Route::get('/active/employee/product/{id}' ,  'ProductEmployeeActive')->name('active.employee.product');

        Route::get('/colors/search', 'search')->name('colors.search');
        Route::post('/colors/add','store')->name('colors.store');
        Route::delete('/stock/delete/{colorId}', 'deleteStock')->name('stock.delete');
        Route::delete('/stocks/color/{colorId}', 'deleteStocksByColor')->name('stocks.deleteByColor');
        Route::delete('/stocks/{id}', 'destroy');
    });


    Route::controller(EmployeeOrderController::class)->group(function(){
        Route::get('/employee/pending/order' , 'EmployeePendingOrder')->name('employee.pending.order');
        Route::get('/employee/order/details/{order_id}' , 'EmployeeOrderDetails')->name('employee.order.details');
        Route::get('/employee/confirmed/order' , 'EmployeeConfirmedOrder')->name('employee.confirmed.order');
        Route::get('/employee/processing/order' , 'EmployeeProcessingOrder')->name('employee.processing.order');
        Route::get('/employee/delivered/order' , 'EmployeeDeliveredOrder')->name('employee.delivered.order');
        Route::get('/employee/cancel/order' , 'EmployeeOrderCancel')->name('employee.cancel.order');
        Route::get('/employee/pending/confirm/{order_id}' , 'EmployeePendingToConfirm')->name('employee.pending-confirm');
        Route::get('/employee/confirm/processing/{order_id}' , 'EmployeeConfirmToProcess')->name('employee.confirm-processing');
        Route::get('/employee/processing/delivered/{order_id}' , 'EmployeeProcessToDelivered')->name('employee.processing-delivered');
        Route::get('/employee/order/cancel/{order_id}', 'EmployeeCancelOrder')->name('employee.processing-cancel');
    });

    Route::controller(ReturnController::class)->group(function(){
        Route::get('/employee/return/request' , 'EmployeeReturnRequest')->name('employee.return.request');
        Route::get('/employee/return/request/approved/{order_id}' , 'EmployeeReReturnRequestApproved')->name('employee.return.request.approved');
        Route::get('/employee/complete/return/request' , 'EmployeeReCompleteReturnRequest')->name('employee.complete.return.request');
    });

    Route::controller(EmployeeController::class)->group(function(){
        //8Ray Route
        Route::get('/employee/logout',  'EmployeeLogOut')->name('employee.logout');
    });
});

Route::middleware(['auth'],['role'=>'admin','employee'])->group(function () {
    Route::get('/pos', [PosController::class, 'PosIndex'])->name('pos.page');
});

Route::get('/subcategory/ajax/{product_category_id}', [ProductSubCategoryController::class, 'getSubCategory'])->name('getSubCategory');

Route::delete('/delete-multi-image/{id}', [ProductController::class, 'deleteMultiImage']);
Route::post('/update-multi-images', [ProductController::class,'updateMultiImages']);

Route::delete('/employee/delete-multi-image/{id}', [EmployeeProductController::class, 'EmployeedeleteMultiImage']);
Route::post('/employee/update-multi-images', [EmployeeProductController::class,'EmployeeupdateMultiImages']);
Route::post('/employee/update-image-order', [EmployeeProductController::class, 'employeeUpdateImageOrder'])->name('update.image.order');


Route::post('/fetch-prices', [StockController::class, 'fetchPrices'])->name('fetch.prices');
Route::post('/fetch-stock', [StockController::class,'fetchStock'])->name('fetch.stock');
Route::post('/fetch-products-by-brand', [StockController::class,'fetchProductsByBrand'])->name('fetch.products.by.brand');

Route::get('/brands', function() {
    $brands = Brand::pluck('brand_name')->toArray();
    return response()->json($brands);
});

Route::get('/product-colors', function() {
    $product_colors = ProductColor::pluck('color_name')->toArray();
    return response()->json($product_colors);
});

Route::get('/product-category', function() {
    $product_categories = ProductCategory::pluck('product_category_name')->toArray();
    return response()->json($product_categories);
});

Route::get('/product-subcategory', function() {
    $product_subcategories = ProductSubCategory::pluck('product_subcategory_name')->toArray();
    return response()->json($product_subcategories);
});


////// Frontend  ///////

Route::controller(FrontendController::class)->group(function(){

    //8Ray Route
    Route::get('/', 'EightRayFrontend')->name('8ray.frontend');
    Route::get('/8ray/contact_us',  'contactUs')->name('8ray.contactus');
    Route::get('/8ray/about_us',  'aboutUs')->name('8ray.aboutus');
    Route::get('/8ray/brandzone',  'brandZone')->name('8ray.brandzone');
    Route::get('/8ray/allproduct',  'AllProductList')->name('8ray.allproduct');
    Route::get('/product/details/{id}/{slug}', 'ProductDetails')->name('8ray.productDetails');
    Route::get('/product/category/{id}/{slug}','CategoryProductList')->name('8ray.productCategoryList');
    Route::get('/product/subcategory/{id}/{slug}', 'SubcategoryProductList')->name('8ray.productSubcategoryList');
    Route::get('/product/brandzone/{id}', 'BrandZoneProductList')->name('8ray.brandzone.productList');

    Route::post('/search' , 'ProductSearch')->name('products.search');
    Route::post('/search-product' , 'SearchProduct');

    // Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', 'ProductViewAjax');


    //Datacentre Route
    Route::get('/datacentre',  'DatacentreFrontend')->name('datacentre.frontend');

});

Route::middleware(['auth'],['role'=>'admin','employee','user'])->group(function () {

    //8ray Profile Route
    Route::get('/8ray/user/profile', [ProfileController::class, 'EditEightRayUserProfile'])->name('8ray.user.profile.edit');
    Route::post('/8ray/user/profile/update', [ProfileController::class, 'UpdateEightRayUserProfile'])->name('8ray.user.profile.update');
    Route::post('/8ray/update/password', [ProfileController::class, 'UpdateEightRayUserPassword'])->name('8ray.user.profile.update.password');
    Route::get('/8ray/user/order', [ProfileController::class, 'EditEightRayUserOrder'])->name('8ray.user.order');
    Route::get('/8ray/user/order_details/{order_id}', [ProfileController::class, 'EightRayUserOrderDetails'])->name('8ray.user.order.details');
    Route::get('/8ray/user/invoice_download/{order_id}', [ProfileController::class, 'EightRayUserOrderInvoice'])->name('8ray.user.order.invoice');
    Route::post('/8ray/return/order/{order_id}' , [ProfileController::class, 'ReturnOrder'])->name('return.order');
    Route::get('/8ray/return/order/page' ,[ProfileController::class, 'ReturnOrderPage'])->name('return.order.page');

    Route::get('/8ray/user/password', [ProfileController::class, 'EditEightRayUserPassword'])->name('8ray.user.password');
    Route::get('/8ray/user/track-order', [ProfileController::class, 'EditEightRayUserTrackOrder'])->name('8ray.user.track.order');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

    Route::controller(WishlistController::class)->group(function(){
        Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product' , 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}' , 'WishlistRemove');
    });

    Route::controller(CompareController::class)->group(function(){
        Route::get('/compare' , 'AllCompare')->name('compare');
        Route::get('/get-compare-product' , 'GetCompareProduct');
        Route::get('/compare-remove/{id}' , 'CompareRemove');
    });

    Route::controller(CartController::class)->group(function(){
        Route::get('/mycart' , 'MyCart')->name('mycart');
        Route::get('/get-cart-product' , 'GetCartProduct');
        Route::get('/cart-remove/{rowId}' , 'CartRemove');
        Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
        Route::get('/cart-increment/{rowId}' , 'CartIncrement');
    });

    Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
    Route::post('/cash/order', [CheckoutController::class, 'CashOrder'])->name('cash.order');


});

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);
Route::post('/coupon-apply', [CartController::class, 'CouponApply'])->name('coupon.apply');
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);



require __DIR__.'/auth.php';
