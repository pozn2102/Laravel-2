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

class CartController extends Controller
{
    public function show_cart_ajax(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $request->brand_id)->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        return view('pages.cart.cart_ajax')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_img' => $data['cart_product_img'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_img' => $data['cart_product_img'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }

    public function delete_cart_ajax(Request $request){
        $cart = Session::get('cart');
        if($cart){
            foreach($cart as $key => $val){
                if($val['session_id'] == $request->product_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message', 'Xóa sản phẩm không thành công');
        }
    }

    public function update_cart_ajax(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $value) {
                    if($value['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message', 'Cập nhật số lượng không thành công');
        }
    }

    public function delete_cart_all(){
        $cart = Session::get('cart');
        if($cart){
            Session::forget('cart');
            return redirect()->back()->with('message', 'Xóa hết sản phẩm thành công');
        }
    }

    
    public function save_cart(Request $request){
        $producId = $request->product_id_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')
        ->where('product_id', $producId)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_img;
        $data['weight'] = $product_info->product_price;

        Cart::add($data);
        Cart::setGlobalTax(0);
        return Redirect::to('/show-cart');
    }

    public function show_cart(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $request->brand_id)->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        return view('pages.cart.show_cart')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function delete_cart(Request $request){
        Cart::update($request->rowId, 0);
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        Session::put('message', 'Cập nhật giỏ hàng thành công');
        return Redirect::to('/show-cart');
    }

}
