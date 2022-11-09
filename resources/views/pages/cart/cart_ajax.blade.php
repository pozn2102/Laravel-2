@extends('user_layout')
@section('user_main')
    <div class="col-sm-9">
        <section id="cart_items">
            {{-- <div class="container"> --}}
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Trang chủ</a></a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
            <form action="{{ url('/update-cart-ajax') }}" method="post">
                @csrf
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Sản phẩm</td>
                            <td class="description"></td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(Session::get('cart'))
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                            @php
                                $total = 0;
                            @endphp
                        @foreach (Session::get('cart') as $key => $cart)
                            @php
                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                $total+=$subtotal;
                            @endphp
                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{ asset('public/upload/product/'.$cart['product_img']) }}" width="50px" alt="" />
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $cart['product_name'] }} </a></h4>
                                <p>ID: {{ $cart['product_id'] }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart['product_price'],0, ',', '.').' '.'vnđ' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input style="width: 50px" class="cart_quantity_input" type="number" name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}" min="1" autocomplete="off" size="2">
                                    <input type="hidden" name="rowId_cart", class="btn btn-sm" value="">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p style="font-size: 1.8rem" class="cart_total_price">
                                    {{ number_format($subtotal,0, ',', '.').' '.'vnđ' }}
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ url('/delete-cart-ajax?product_id='.$cart['session_id']) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <input type="submit" name="update_qty", class="btn btn-default check_out" value="Cập nhật">
                            </td>
                            <td>
                                <a type="submit" href="{{ url('delete-cart-all') }}" name="delete_all" class="btn btn-default check_out"> Xóa tất cả
                            </td>
                            <td>
                                <li>Tổng <span> {{ number_format($total,0, ',', '.').' '.'vnđ' }}</span></li>
                                <li>Thuế <span> </span></li>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Tổng thanh toán <span></span></li>
                            </td>
                        </tr>
                    @else
                    <tr>
                        <td>
                            @php
                                echo '<span> Chưa có sản phẩm </span>';
                            @endphp
                        </td>
                    </tr>
                    @endif
                    </tbody>
                </form>
                </table>
            </div>
            {{-- </div> --}}
        </section>
        <!--/#cart_items-->

        <section id="do_action">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <?php
                            $customer_id = Session::get('customer_id');
                            if ($customer_id) {
                        ?>
                            <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}"> Thanh toán</a>
                        <?php
                            }else{
                        ?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/login-customer') }}"> Thanh toán</a>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
