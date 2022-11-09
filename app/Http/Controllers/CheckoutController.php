<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function login_customer(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $meta_desc = " Lập trình web bán hàng Laravel ";
        $meta_keywords = " Lập trình web bán hàng Laravel , Lập trình web bán hàng Laravel ";
        $meta_title = "SHOP | HOME";
        $url_canonical = $request->url();

        return view('pages.checkout.login_customer')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function logout_customer(){
        Session::flush();
        return Redirect::to('/login-customer');
    }

    public function login_customer_check(Request $request){
        $customer_email = $request->customer_email;
        $customer_pass = $request->customer_pass;

        $result =  DB::table('tbl_customers')
        ->where('customer_email', $customer_email)
        ->where('customer_password', $customer_pass)->first();
    
        if($result){
            if(isset($_POST['remember']) and ($_POST['remember']=="on")){
                setcookie("customer_email", $customer_email, time() + (60*60*24*7));
                setcookie("customer_password", $customer_pass, time() + (60*60*24*7));
            }
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/checkout');
        }else{
            Session::put('message', 'Đăng nhập thất bại');
            return Redirect::to('/login-customer');
        }
    }

    public function register_customer(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $meta_desc = " Lập trình web bán hàng Laravel ";
        $meta_keywords = " Lập trình web bán hàng Laravel , Lập trình web bán hàng Laravel ";
        $meta_title = "SHOP | HOME";
        $url_canonical = $request->url();

        return view('pages.checkout.register_customer')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_pass;
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id); 
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function show_checkout(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        return view('pages.checkout.show_checkout')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id); 
        return Redirect::to('/payment');
    }

    public function payment(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        return view('pages.checkout.payment')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function order_place(Request $request){
        // insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_options;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $order_data = array();
         $order_data['customer_id'] = Session::get('customer_id');
         $order_data['shipping_id'] = Session::get('shipping_id');
         $order_data['payment_id'] = $payment_id;
         $order_data['order_total'] = Cart::total();
         $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // insert order detail
        $content = Cart::content();
        foreach ($content as $v_content){
            $order_d_detail = array();
            $order_d_detail['order_id'] = $order_id;
            $order_d_detail['product_id'] = $v_content->id;
            $order_d_detail['product_name'] = $v_content->name;
            $order_d_detail['product_price'] = $v_content->price;
            $order_d_detail['product_sales_quantity'] = $v_content->qty;
            $order_data = DB::table('tbl_order_detail')->insertGetId($order_d_detail);
        }

        // meta seo
        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        if($data['payment_method']==1){
            echo 'ATM';
        }else{
            $category_product = DB::table('tbl_category')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

            Cart::destroy();
            return view('pages.checkout.handcash')
            ->with('show_category', $category_product)
            ->with('show_brand', $brand_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
        }
    }

    // Manager order
    public function manager_order(){
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->orderBy('tbl_order.order_id', 'desc')->get();

        $manager_order = view('Admin.manager_order')
        ->with('all_order', $all_order);

        return view('admin_layout')
        ->with('manager_order', $manager_order);
    }

    public function view_order(Request $request){
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_order_detail', 'tbl_order.order_id', '=', 'tbl_order_detail.order_id')
        ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*','tbl_order_detail.*')
        ->where('tbl_order.order_id', $request->order_id)
        ->first();

        $manager_order_by_id = view('Admin.view_order')
        ->with('order_by_id', $order_by_id);

        return view('admin_layout')
        ->with('manager_order', $manager_order_by_id);
    }

    public function delete_order(Request $request){
        DB::table('tbl_order')
        ->where('order_id', $request->order_id)->delete();
        
        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect::to('/manager-order');
    }
}
