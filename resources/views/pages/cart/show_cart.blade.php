@extends('user_layout')
@section('user_main')
<div  class="col-sm-9">
    <section id="cart_items">
        {{-- <div class="container"> --}}
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">Trang chủ</a></a></li>
                  <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <?php 
                $content = Cart::content();
            ?>
            <?php 
                $message = Session::get('message');
                if($message){
                    echo '<span style="color: green">',$message,'</span>';
                    Session::put('message', null);
                }
            ?>
            <div class="table-responsive cart_info">
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
                        @foreach ($content as $value_content)
                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{ URL::to('public/upload/product/'.$value_content->options->image) }}" width="50px" alt="" />
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""> {{ $value_content->name }}</a></h4>
                                <p>ID: {{ $value_content->id }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{  number_format($value_content->price,0,'.',',').' '.'vnđ' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <form action="{{ URL::to('/update-cart') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="cart_quantity_button">
                                        <input style="width: 50px" class="cart_quantity_input" type="number" name="cart_quantity" value="{{ $value_content->qty }}" min="1" autocomplete="off" size="2">
                                        <input type="hidden" name="rowId_cart", class="btn btn-sm" value="{{ $value_content->rowId }}">
                                        <input type="submit" name="update_qty", class="btn btn-sm" value="Cập nhật">
                                    </div>
                                </form>
                            </td>
                            <td class="cart_total">
                                <p style="font-size: 1.8rem" class="cart_total_price">
                                    <?php 
                                        $subtotal = $value_content->price * $value_content->qty;
                                        echo number_format($subtotal,0,'.',',').' '.'vnđ'
                                    ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/delete-cart?rowId='.$value_content->rowId) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- </div> --}}
    </section> <!--/#cart_items-->

    <section id="do_action">
		{{-- <div class="container"> --}}
			<div class="heading">
				<h3>Thanh toán </h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span> {{ Cart::priceTotal(0, ',', '.').' '.'vnđ'; }}</span></li>
							<li>Thuế <span> {{ Cart::tax(0, ',', '.').' '.'vnđ' }}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng thanh toán <span>{{ Cart::total(0, ',', '.') .' '.'vnđ'}}</span></li>
						</ul>
                        <?php 
                            $customer_id = Session::get('customer_id');
                            if($customer_id!=NULL){
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
		{{-- </div> --}}
	</section>
</div>
@endsection