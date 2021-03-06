<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\GuestController;
use App\Http\Controllers\Ecommerce\LoginController;
use App\Http\Controllers\Ecommerce\OrderController as EcommerceOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [GuestController::class, 'index'])->name('guest.index');
Route::get('/shop', [GuestController::class, 'shop'])->name('guest.shop');
Route::get('/category/{slug}', [GuestController::class, 'categoryProduct'])->name('guest.category');
Route::get('/shop/{slug}', [GuestController::class, 'show'])->name('guest.show_product');
Route::get('/search', [GuestController::class, 'search'])->name('search');

Route::post('cart', [CartController::class, 'addToCart'])->name('guest.cart');
Route::get('/carts', [CartController::class, 'listCart'])->name('guest.list_cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('guest.update_cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('guest.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('guest.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('guest.finish_checkout');

Route::get('/contact', [ContactController::class, 'contact'])->name('guest.contact');
Route::post('/contact', [ContactController::class, 'contactPost'])->name('post.contact');

Route::get('/news', [GuestController::class, 'newsList'])->name('ls.news');
Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function() {
    Route::get('login', [LoginController::class, 'loginForm'])->name('customer.login');
    Route::post('/post/login', [LoginController::class, 'login'])->name('customer.post_login');
    Route::get('verify/{token}', [GuestController::class, 'verifyCustomerRegistration'])->name('customer.verify');
    Route::get('/verify', [LoginController::class, 'verify'])->name('customer.verify.sms');
    Route::post('/verify', [LoginController::class, 'postVerify'])->name('post.verify');

    Route::group(['middleware' => 'customer'], function() {
        Route::get('dashboard', [LoginController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('customer.logout');

        Route::get('orders', [EcommerceOrderController::class, 'index'])->name('guest.order');
        Route::get('orders/{invoice}', [EcommerceOrderController::class, 'view'])->name('customer.view_order');
        Route::get('orders/pdf/{invoice}', [EcommerceOrderController::class, 'pdf'])->name('customer.order_pdf');
        Route::post('orders/accept', [EcommerceOrderController::class, 'acceptOrder'])->name('customer.order_accept');
        Route::get('orders/return/{invoice}', [EcommerceOrderController::class, 'returnForm'])->name('customer.order_return');
        Route::put('orders/return/{invoice}', [EcommerceOrderController::class, 'processReturn'])->name('customer.return');

        Route::get('payment', [EcommerceOrderController::class, 'paymentForm'])->name('customer.paymentForm');
        Route::post('payment', [EcommerceOrderController::class, 'storePayment'])->name('customer.savePayment');

        Route::get('cod/accept/{id}', [EcommerceOrderController::class, 'formUpdatePayment'])->name('form.payment');
        Route::put('cod/update/{id}', [EcommerceOrderController::class, 'updatePayment'])->name('update.payment');

        Route::get('setting', [GuestController::class, 'customerSettingForm'])->name('customer.settingForm');
        Route::post('setting', [GuestController::class, 'customerUpdateProfile'])->name('customer.setting');

        Route::get('/afiliasi', [GuestController::class, 'listCommission'])->name('customer.affiliate');

        Route::get('/order', [EcommerceOrderController::class, 'index'])->name('guest.order');

        Route::get('/comment/{slug}', [GuestController::class, 'formComment'])->name('form.comment');
        Route::post('/comment', [GuestController::class, 'coment'])->name('comment.post');
    });
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* role super admin */
    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::resource('superadmin/role', RoleController::class)->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::resource('superadmin/users', UserController::class)->except([
            'show'
        ]);
        Route::get('superadmin/users/roles/{id}', [UserController::class, 'roles'])->name('users.roles');
        Route::put('/users/roles/{id}', [UserController::class, 'setRole'])->name('users.set_role');
        Route::post('/users/permission', [UserController::class, 'addPermission'])->name('users.add_permission');
        Route::get('superadmin/role-permission', [UserController::class, 'rolePermission'])->name('users.roles_permission');
        Route::put('/users/permission/{role}', [UserController::class, 'setRolePermission'])->name('users.setRolePermission');
    });

    /* role admin */
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin/other', [DashboardController::class, 'other'])->name('other');
        /* route news */
        Route::get('admin/post/news/{id}', [DashboardController::class, 'newsEdit'])->name('post.edit');
        Route::post('admin/post/news', [DashboardController::class, 'newsPost'])->name('post.news');
        Route::put('admin/post/{id}', [DashboardController::class, 'newsUpdate'])->name('post.update');
        Route::delete('admin/post/delete/{id}', [DashboardController::class, 'newsDelete'])->name('post.delete');
        /* route cs */
        Route::post('admin/post/cs', [DashboardController::class, 'cspost'])->name('cs.post');
        Route::delete('admin/delete/{id}', [DashboardController::class, 'csdelete'])->name('cs.delete');
        Route::get('admin/dashboard/cs-edit/{id}', [DashboardController::class, 'csedit'])->name('cs.edit');
        Route::put('admin/cs/update/{id}', [DashboardController::class, 'csupdate'])->name('cs.update');
        /* route kategori */
        Route::resource('admin/category', CategoryController::class)->except(['create', 'show']);
        /* route product */
        Route::resource('admin/product', ProductController::class)->except(['show']);
        Route::get('admin/product/bulk', [ProductController::class, 'massUploadForm'])->name('product.bulk');
        Route::post('admin/product/bulk', [ProductController::class, 'massUpload'])->name('product.saveBulk');
        Route::post('admin/product/marketplace', [ProductController::class, 'uploadViaMarketplace'])->name('product.marketplace');
        /* route order */
        Route::group(['prefix' => 'admin/orders'], function() {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/{invoice}', [OrderController::class, 'view'])->name('orders.view');
            Route::get('/payment/{invoice}', [OrderController::class, 'acceptPayment'])->name('orders.approve_payment');
            Route::post('/shipping', [OrderController::class, 'shippingOrder'])->name('orders.shipping');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
            Route::get('/return/{invoice}', [OrderController::class, 'return'])->name('orders.return');
            Route::post('/return', [OrderController::class, 'approveReturn'])->name('orders.approve_return');
        });
        /* route report */
        Route::group(['prefix' => 'administrator/reports'], function() {
            Route::get('/order', [DashboardController::class, 'orderReport'])->name('report.order');
            Route::get('/order/pdf/{daterange}', [DashboardController::class, 'orderReportPdf'])->name('report.order_pdf');
            Route::get('/return', [DashboardController::class, 'returnReport'])->name('report.return');
            Route::get('/return/pdf/{daterange}', [DashboardController::class, 'returnReportPdf'])->name('report.return_pdf');
        });
    });
    /* end role admin */

    /* role gudang */
    Route::group(['middleware' => ['role:gudang']], function () {
        /* route update stock */
        Route::get('gudang/produk', [ProductController::class, 'indexGudang'])->name('gudang.product.index');
        Route::get('gudang/produk/{product_id}/edit', [ProductController::class, 'editGudang'])->name('gudang.product.edit');
        Route::put('gudang/produk/{product_id}', [ProductController::class, 'updateGudang'])->name('gudang.product.update');

        Route::post('gudang/daily', [DashboardController::class, 'dailyPost'])->name('daily.post');
        Route::put('gudang/daily/{id}', [DashboardController::class, 'dailyUpdate'])->name('daily.update');
        Route::get('gudang/daily/edit/{id}', [DashboardController::class, 'dailyEdit'])->name('daily.edit');
        Route::delete('gudang/destroy/{id}', [DashboardController::class, 'dailyDelete'])->name('daily.destroy');
    });
    /* end role gudang */
});
require __DIR__.'/auth.php';
