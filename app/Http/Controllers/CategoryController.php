<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    public function add_category(){
        return view('Admin.add_category');
    }

    public function save_category(Request $request){
        // Model
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->meta_keywords = $data['category_keywords'];
        $category->category_status = $data['category_status'];
        $category->save();

        // DB
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_desc;
        // $data['meta_keywords'] = $request->category_keywords;
        // DB::table('tbl_category')->insert($data);
        Session::put('message', 'Thêm danh mục thành công');
        return redirect::to('/all-category');
    }

    public function all_category(){
        // DB
        // $all_category = DB::table('tbl_category')
        // ->orderBy('category_id', 'desc')->get();

        // Model
        $all_category = Category::orderBy('category_id', 'desc')->get();

        $manager_all_category = view('Admin.all_category')
        ->with('all_category', $all_category);

        return view('admin_layout')
        ->with('all_category', $manager_all_category);
    }

    public function hien_danh_muc($category_product_id){
        // DB::table('tbl_category')
        // ->where('category_id', $category_product_id)
        // ->update(['category_status' => 0]);
        Category::where('category_id', $category_product_id)
        ->update(['category_status' =>0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category');
    }

    public function an_danh_muc($category_product_id){
        // DB::table('tbl_category')
        // ->where('category_id', $category_product_id)
        // ->update(['category_status'=> 1]);
        Category::where('category_id', $category_product_id)
        ->update(['category_status' =>1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category');
    }

    public function delete_category(Request $request){
        // DB::table('tbl_category')
        // ->where('category_id', $request->category_id)
        // ->delete();

        Category::where('category_id', $request->category_id)->delete();
        Session::put('message', 'Xóa danh mục thành công');
        return Redirect::to('/all-category');
    }

    public function edit_category(Request $request){
        // DB
        // $edit_category = DB::table('tbl_category')
        // ->where('category_id', $request->category_id)->get();

        // Model
        $edit_category = Category::find($request->category_id);
        $manager_category = view('Admin.edit_category')
        ->with('edit_category', $edit_category);
        return view('admin_layout')->with('edit_category', $manager_category);
    }

    public function update_category(Request $request, $category_id){
        // $data = array();
        // $data['meta_keywords'] = $request->category_keywords;
        // $data['category_name'] = $request->category_name; 
        // $data['category_desc'] = $request->category_desc; 
        // DB::table('tbl_category')->where('category_id', $category_id)->update($data);

        // Model
        $data = $request->all();
        $category =  Category::find($request->category_id);
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_desc'];
        $category->meta_keywords = $data['category_keywords'];
        $category->category_status = $data['category_status'];
        $category->save();
        Session::put('message', 'Cập nhật danh mục thành công');
        return Redirect::to('/all-category');
    }


    // Show category home
    public function show_category_home(Request $request){
        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
        ->where('product_status', '0')
        ->where('tbl_product.category_id', $request->category_id)->get();

        foreach ($category_by_id as $key => $val){
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
        }

        $category_name = DB::table('tbl_category')
        ->where('tbl_category.category_id', $request->category_id)->get();

        return view('pages.category.show_category')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

}
