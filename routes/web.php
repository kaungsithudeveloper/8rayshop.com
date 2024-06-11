<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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


use App\Http\Controllers\Frontend\FrontendController;

use App\Http\Controllers\PosController;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSubCategory;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/employee/login', [EmployeeController::class, 'EmployeeLogin'])->name('employee.login')->middleware(RedirectIfAuthenticated::class);


Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');

    // Backend Admin routes
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout',  'LogOut')->name('admin.logout');
        Route::get('/admins/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/update/password',  'AdminUpdatePassword')->name('update.password');
        Route::post('/admin/profile/store',  'AdminProfileStore')->name('admin.profile.store');

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

    //Backend Product Management Routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('/backend/product', 'AllProduct')->name('all.product');
        Route::get('/backend/product/add', 'AddProduct')->name('product.add');
        Route::post('/backend/product/store',  'StoreProduct')->name('store.product');
        Route::get('/backend/product/edit/{slug}', 'EditProduct')->name('edit.product');
        Route::post('/backend/product/update', 'UpdateProduct')->name('update.product');
        Route::get('/backend/product/delete/{id}' ,  'DestoryProduct')->name('delete.product');
    });



    Route::get('/brands', function() {
        $brands = Brand::pluck('brand_name')->toArray();
        return response()->json($brands);
    });

    Route::get('/product-colors', function() {
        $product_colors = ProductColor::pluck('color_name')->toArray();
        return response()->json($product_colors);
    });






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
        Route::get('/employee/dashboard',  'EmployeeDashboard')->name('employee.dashboard');

        //////////// Start 8Ray Route ////////////
        Route::get('/employee/8ray/dashboard',  'Employee8rayDashboard')->name('employee.8ray.dashboard');


        //////////// End 8Ray Route ////////////


        //////////// Start DataCentre Route ////////////
        Route::get('/employee/datacentre/dashboard',  'EmployeeDatacentreDashboard')->name('employee.datacentre.dashboard');


        //////////// End DataCentre Route ////////////

    });

    Route::controller(EmployeeController::class)->group(function(){

        //8Ray Route
        Route::get('/employee/logout',  'EmployeeLogOut')->name('employee.logout');



    });

});

Route::middleware(['auth'],['role'=>'admin','employee'])->group(function () {
    Route::get('/pos', [PosController::class, 'PosIndex'])->name('pos.page');
});

////// Frontend  ///////

Route::controller(FrontendController::class)->group(function(){

    //8Ray Route
    Route::get('/8ray',  'EightRayFrontend')->name('8ray.frontend');

    //Datacentre Route
    Route::get('/datacentre',  'DatacentreFrontend')->name('datacentre.frontend');

});

require __DIR__.'/auth.php';
