<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class BrandController extends Controller
{
    public function add_brand(){
        return view('Admin.brand.add_brand');
    }

    public function save_brand(Request $request){
        // Sử dụng Model
        $data = $request->all();
        // CSDL             = $data['name input'];   
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->meta_keywords = $data['brand_keywords'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();

        // Sử dụng DB
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['brand_desc'] = $request->brand_desc;
        // $data['brand_status'] = $request->brand_status;
        // $data['meta_keywords'] = $request->brand_keywords;
        // DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    public function all_brand(){
        // Sử dụng DB
        // $all_brand = DB::table('tbl_brand')
        // ->orderBy('tbl_brand.brand_id', 'desc')->get();

        // Sử dụng Model
        // Take(): giới hạn
        // Pagination: phân trang
        $all_brand = Brand::orderBy('brand_id', 'desc')->get();

        $manager_brand = view('Admin.brand.all_brand')
        ->with('all_brand', $all_brand);

        return view('admin_layout')
        ->with('all_brand', $manager_brand);
    }

    public function an_thuong_hieu($brand_product_id){
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }

    public function hien_thuong_hieu($brand_product_id){
        DB::table('tbl_brand')
        ->where('brand_id', $brand_product_id)
        ->update(['brand_status'=> 0]);

        Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }

    public function delete_brand(Request $request){
        DB::table('tbl_brand')
        ->where('brand_id', $request->brand_id)->delete();

        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    public function edit_brand(Request $request){
        // DB
        // $edit_brand = DB::table('tbl_brand')
        // ->where('brand_id', $request->brand_id)->get();

        // Model
        $edit_brand = Brand::find($request->brand_id); // Id Danh mục truyền vào 

        $manager_brand = view('Admin.brand.edit_brand')
        ->with('edit_brand', $edit_brand);

        return view('admin_layout')
        ->with('edit_brand', $manager_brand);
    }

    public function update_brand(Request $request, $brand_id){
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['brand_desc'] = $request->brand_desc;
        // $data['meta_keywords'] = $request->brand_keywords;
        // DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);

        $data = $request->all();
        // CSDL             = $data['name input'];   
        $brand = Brand::find($request->brand_id);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->meta_keywords = $data['brand_keywords'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    // home
    public function show_brand_home(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $request->brand_id)->get();

        foreach ($brand_by_id as $key => $val){
            $meta_desc = $val->brand_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
        }

        $brand_name = DB::table('tbl_brand')
        ->where('tbl_brand.brand_id', $request->brand_id)->get();

        return view('pages.brand.show_brand')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('brand_by_id', $brand_by_id)
        ->with('brand_name', $brand_name)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }
}