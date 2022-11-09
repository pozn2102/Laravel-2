<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function add_product(){
        $product_category = DB::table('tbl_category')->orderBy('category_id', 'desc')->get();
        $product_brand = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        return view('Admin.product.add_product')->with('product_category', $product_category)->with('product_brand', $product_brand);
    }

    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['meta_keywords'] = $request->product_keywords;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_img'] = $request->product_img;

        $get_img = $request->file('product_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img =$name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product', $new_img);
            $data['product_img'] = $new_img;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        $data['product_img'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function all_product(){
        $all_product = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->orderBy('tbl_brand.brand_id', 'desc')
        ->orderBy('tbl_category.category_id', 'desc')
        ->orderBy('tbl_product.product_id', 'desc')->get();

        $manager_product = view('Admin.product.all_product')
        ->with('all_product', $all_product);

        return view('admin_layout')
        ->with('all_product', $manager_product);
    }

    public function hien_san_pham($product_id){
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function an_san_pham($product_id){
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product(Request $request){
        DB::table('tbl_product')->where('product_id', $request->product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product(Request $request){
        $category_product = DB::table('tbl_category')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->orderBy('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')
        ->where('product_id', $request->product_id)->get();

        $manager_product = view('Admin.product.edit_product')
        ->with('edit_product', $edit_product)
        ->with('category_product', $category_product)
        ->with('brand_product', $brand_product);
        return view('admin_layout')->with('all_product', $manager_product);
    }

    public function update_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['meta_keywords'] = $request->product_keywords;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_img = $request->file('product_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product', $new_img);
            $data['product_img'] = $new_img;
            DB::table('tbl_product')->where('product_id', $request->product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        $data['product_img'] = '';
        DB::table('tbl_product')
        ->where('product_id', $request->product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function search_product(Request $request){
        $keywords = $request->keywords_search;

        $search_product = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->orderBy('tbl_brand.brand_id', 'asc')
        ->where('product_name', 'like', '%'.$keywords.'%')->get();

        $manager_product = view('Admin.product.search_product')
        ->with('all_product', $search_product);

        return view('admin_layout')
        ->with('all_product', $manager_product);
    }


    // <----------------------------------->
    // Show detail product home
    public function show_detail_product(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $detail_product = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.product_id', $request->product_id)->get();

        foreach($detail_product as $key => $val){
            $category_id = $val->category_id;
            $meta_desc = $val->product_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->product_name;
            $url_canonical = $request->url();
        }

        $related_detail_product = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_category.category_id', $category_id)
        ->whereNotIn('tbl_product.product_id', [$request->product_id])
        ->get();
        
        return view('pages.detail.show_detail')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('product_detail', $detail_product)
        ->with('relate', $related_detail_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

}