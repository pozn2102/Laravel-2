<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Login;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Social;
use Illuminate\Support\Facades\Log;

session_start();

class AdminController extends Controller{

    public function login_google(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(){
        $users = Socialite::driver('google')->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
    }
    public function findOrCreateUser($users, $provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }
      
        $hieu = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();
            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_pass' => '',
                    'admin_phone' => ''
                ]);
            }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
    }

    // Login face
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect::to('/admin')->with('message', 'Đăng nhập Admin thành công');
        }else{
            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_pass' => '',
                    'admin_phone' => ''
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect::to('/admin')->with('message', 'Đăng nhập Admin thành công');
        }   
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id==null){
            return view('Admin.login');
        }
    }

    public function index(){
        $this->AuthLogin();
        if(isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_pass'])){
            $admin_email = $_COOKIE['admin_email'];
            $admin_pass = $_COOKIE['admin_pass'];
            // $result = Login::where('admin_email', $admin_email)->where('admin_pass', $admin_pass)->first();

            $result = Login::check_login($admin_email, $admin_pass);
            if($result){
                Session::put('admin_name', $result->admin_name);
                Session::put('admin_id', $result->admin_id);
                // return Redirect::to('/admin');
                return view('Admin.dashboard');
            }else{
                return Redirect::to('/login-admin');
            }
        }else{
            return Redirect::to('/login-admin');
        }
        // $this->AuthLogin();
    }

    public function login_admin(){
        return view('Admin.login');
    }

    public function register_admin(){
            return view('Admin.register');
    }

    public function add_register_admin(Request $request){
        $data = $request->all();
            $Login = new Login();
            $Login->admin_email = $data['admin_email'];
            $Login->admin_pass = md5($data['admin_pass']);
            $Login->admin_name = $data['admin_name'];
            $Login->admin_phone = $data['admin_phone'];
            $Login->save();

            Session::put('message', 'Đăng ký tài khoản thành công');
            return Redirect::to('/register-admin');
    }

    public function login_check(Request $request){
        $data = $request->all();

        $admin_email = $data['admin_email'];
        $admin_pass = md5($data['admin_pass']);
        $remember = $request->remember;

        // $login = Login::where('admin_email', $admin_email)->where('admin_pass', $admin_pass)->first();
        $login = Login::check_login($admin_email, $admin_pass);
        if($login){
            if(isset($remember)){
                if($remember == 'on'){
                    setcookie("admin_email", $admin_email, time() + (60*60*24*7));
                    setcookie("admin_pass", $admin_pass, time() + (60*60*24*7));
                }
            }
            Session::put('admin_name', $login->admin_name);
            Session::put('admin_id', $login->admin_id);
            return Redirect::to('/admin');
        }else{
            Session::put('message', 'Email hoặc mật khẩu không đúng');
            return Redirect::to('/login-admin');
        }
    }


    public function signout_admin(){
        Session::forget('admin_password');
        Session::forget('admin_email');
        // Session::flush();
        setcookie("admin_email", null, time() + -100);
        setcookie("admin_pass", null, time() + -100);
        return view('Admin.login');
    }

}
