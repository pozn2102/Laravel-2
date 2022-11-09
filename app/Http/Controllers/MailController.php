<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail(){
        $to_name = "Nhuận Phú";
        $to_email = "nhuan1609it@gmail.com";
    
        $data = array("name"=>"Mail từ tài khoản khách hàng", "body", "Mail gửi về hàng hóa");
    
        Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('Quên mật khẩu');
            $message->from($to_email, $to_name);
        });
        return Redirect::to('/trang-chu')->with('message','');
    }
}
