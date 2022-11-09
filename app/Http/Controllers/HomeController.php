<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

session_start();

class HomeController extends Controller
{
    public function send_mail(){
        $to_name = "Phu Nhuan";
        $to_email = "nhuan1609it@gmail.com";
    
        $data = array("name" => $to_name, 
                      "number_rand" => "dãy số random" );

        Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('Xác nhận mật khẩu');
            $message->from($to_email, $to_name);
        });
        return Redirect::to('/trang-chu')->with('message','');
    }

    public function index(Request $request){
        // SEO: Dòng mô tả
        $meta_desc = " Lập trình web bán hàng Laravel ";
        $meta_keywords = " Lập trình web bán hàng Laravel , Lập trình web bán hàng Laravel ";
        $meta_title = "SHOP | HOME";
        $url_canonical = $request->url();

        $category_product = DB::table('tbl_category')
        ->where('category_status', '0')
        ->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status', '0')
        ->orderBy('brand_id', 'desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status', '0')
        ->orderBy('product_id', 'desc')->limit(6)->get();

        return view('pages.home')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('show_product', $all_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);

    }
    
    public function search_product(Request $request){
        $keywords = $request->keyword_submit;

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

        $search_product = DB::table('tbl_product')
        ->where('product_name', 'like', '%'.$keywords.'%')->get();

        return view('pages.detail.search')
        ->with('show_category', $category_product)
        ->with('show_brand', $brand_product)
        ->with('search_product', $search_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }
}
