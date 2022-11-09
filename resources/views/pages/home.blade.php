@extends('user_layout')
@section('user_main')
<div class="col-sm-9 padding-right">
    {{-- <div class="fb-share-button" data-href="http://localhost/MyProject" data-layout="button_count" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
            Chia sẻ
        </a>
    </div> --}}
    <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    <div class="features_items">
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach ($show_product as $key => $value_product)
        <div class="col-sm-4"> 
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            {{ csrf_field() }} 
                            <input type="hidden" class="cart_product_id_{{ $value_product->product_id }}" value="{{ $value_product->product_id }}">
                            <input type="hidden" class="cart_product_name_{{ $value_product->product_id}}" value="{{ $value_product->product_name }}">
                            <input type="hidden" class="cart_product_price_{{ $value_product->product_id }}" value="{{ $value_product->product_price }}">
                            <input type="hidden" class="cart_product_img_{{ $value_product->product_id }}" value="{{ $value_product->product_img }}">
                            <input type="hidden" class="cart_product_qty_{{ $value_product->product_id }}" value="1">
                            <a href="{{ URL::to('/detail-product?product_id='.$value_product->product_id) }}">
                                <img src="{{ URL::to('public/upload/product/'. $value_product->product_img ) }}" width="256px" height="256px" style="object-fit: cover" alt="" />
                                <h2>{{ number_format($value_product->product_price,0,',','.').' '.' VNĐ' }}</h2>
                                <p>{{ $value_product->product_name }}</p>
                            </a>
                                <button type="button" class="btn btn-default add-to-cart" data-id="{{ $value_product->product_id }}" name="add-to-cart">Thêm giỏ hàng</button>
                        </form>
                        </div>
                    </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="fb-comments" data-href="http://localhost/MyProject" data-width="" data-numposts="20"></div>
    <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
</div>
@endsection