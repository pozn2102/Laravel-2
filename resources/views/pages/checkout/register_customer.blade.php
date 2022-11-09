@extends('user_layout')
@section('user_main')
<div class="col-sm-9">
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="signup-form"><!--sign up form-->
                        <h2>ĐĂNG KÝ</h2>
                        <?php 
                            $message = Session::get('message');
                            if($message){
                                echo '<span style="color: green">',$message,'</span>';
                                Session::put('message', null);
                            }    
                        ?>
                        <form action="{{ URL::to('/add-customer') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="customer_name" placeholder="Họ và tên"/>
                            <input type="email" name="customer_email"  placeholder="Email"/>
                            <input type="password" name="customer_pass"  placeholder="Password"/>
                            <input type="text" name="customer_phone" placeholder="Phone"/>
                            <button type="submit" href="{{ URL::to('/checkout') }}" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
</div>
@endsection