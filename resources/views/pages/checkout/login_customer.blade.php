@extends('user_layout')
@section('user_main')
<div class="col-sm-9">
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <?php 
                        $message = Session::get('message');
                        if($message){
                            echo '<span style="color: red">',$message,'</span>';
                            Session::put('message', null);
                        }    
                    ?>
                        <h2>ĐĂNG NHẬP</h2>
                        <form action="{{ URL::to('/login-customer-check') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="email" placeholder="Email"  name="customer_email"/>
                            <input type="password" placeholder="Mật khẩu" name="customer_pass" />
                                <span>
                                    <input type="checkbox" class="checkbox" value="on" name="remember"> Lưu đăng nhập của tôi
                                </span>
                                <button type="" href="{{ URL::to('/checkout') }}" class="btn btn-default">Đăng nhập</button>
                                <a type="" href="{{ URL::to('/register-customer') }}" class="btn btn-default">Đăng ký</a>
                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
</div>
@endsection