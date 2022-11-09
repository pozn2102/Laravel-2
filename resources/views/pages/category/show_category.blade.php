@extends('user_layout')
@section('user_main')
<div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    <div class="features_items">
        @foreach ($category_name as $key => $value_name)
            <h2 class="title text-center">{{ $value_name->category_name }}</h2>
        @endforeach
        @foreach ($category_by_id as $key => $value_product)
        <a href="{{ URL::to('/detail-product?product_id='.$value_product->product_id) }}">
            <div class="col-sm-4">
                <div class="product-image-wrapper"> 
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('public/upload/product/'. $value_product->product_img ) }}" alt="" />
                                <h2>{{ number_format($value_product->product_price,0,',','.').' '.' VNĐ' }}</h2>
                                <p>{{ $value_product->product_name }}</p>
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
        </a>
        @endforeach
    </div>
    <div class="fb-comments" data-href="http://localhost/MyProject" data-width="" data-numposts="20"></div>
@endsection