<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// Backend
// Login
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/login-admin', [AdminController::class, 'login_admin']);
Route::get('/register-admin', [AdminController::class, 'register_admin']);
Route::get('/signout-admin', [AdminController::class, 'signout_admin']);

Route::post('/login-check', [AdminController::class, 'login_check']);
Route::post('/add-register-admin', [AdminController::class, 'add_register_admin']);

// Category
Route::get('/add-category', [CategoryController::class, 'add_category']);
Route::get('/all-category', [CategoryController::class, 'all_category']);

Route::post('/save-category', [CategoryController::class, 'save_category']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryController::class, 'an_danh_muc']);
Route::get('/active-category-product/{category_product_id}', [CategoryController::class, 'hien_danh_muc']);

Route::get('/delete-category', [CategoryController::class, 'delete_category']);
Route::get('/edit-category', [CategoryController::class, 'edit_category']);
Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);

// Brand
Route::get('/add-brand', [BrandController::class, 'add_brand']);
Route::get('/all-brand', [BrandController::class, 'all_brand']);

Route::post('/save-brand', [BrandController::class, 'save_brand']);
Route::get('/unactive-brand-product/{brand_product_id}', [BrandController::class, 'an_thuong_hieu']);
Route::get('/active-brand-product/{brand_product_id}', [BrandController::class, 'hien_thuong_hieu']);

Route::get('/delete-brand', [BrandController::class, 'delete_brand']);
Route::get('/edit-brand', [BrandController::class, 'edit_brand']);
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand']);

// Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'an_san_pham']);
Route::get('/active-product/{product_id}', [ProductController::class, 'hien_san_pham']);

Route::get('/delete-product', [ProductController::class, 'delete_product']);
Route::get('/edit-product', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::post('/search-product-admin', [ProductController::class, 'search_product']);

// Order
Route::get('/manager-order', [CheckoutController::class, 'manager_order']);
Route::get('/view-order', [CheckoutController::class, 'view_order']);
Route::get('/delete-order', [CheckoutController::class, 'delete_order']);

// Send mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);

//Login facebook
Route::get('/login-facebook',[AdminController::class, 'login_facebook']);
Route::get('/login-admin/callback', [AdminController::class, 'callback_facebook']);

//Login google
Route::get('/login-google',[AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);


// <----------------------------------->
// Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/search-product', [HomeController::class, 'search_product']);

// Show category index
Route::get('/category', [CategoryController::class, 'show_category_home']);
Route::get('/brand-product', [BrandController::class, 'show_brand_home']);
Route::get('/detail-product', [ProductController::class, 'show_detail_product']);

// Cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-cart', [CartController::class, 'delete_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);

// Cart ajax
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);

Route::post('/update-cart-ajax', [CartController::class, 'update_cart_ajax']);
Route::get('/delete-cart-ajax', [CartController::class, 'delete_cart_ajax']);
Route::get('/delete-cart-all', [CartController::class, 'delete_cart_all']);


// Login checkout
Route::get('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/logout-customer', [CheckoutController::class, 'logout_customer']);
Route::get('/register-customer', [CheckoutController::class, 'register_customer']);

Route::post('/login-customer-check', [CheckoutController::class, 'login_customer_check']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);

Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::get('/checkout', [CheckoutController::class, 'show_checkout']);

Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);

























