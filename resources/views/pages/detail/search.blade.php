@extends('user_layout')
@section('user_main')
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        @foreach ($search_product as $key => $value_product)
        <div class="col-sm-4"> 
            <div class="product-image-wrapper">
                <a href="{{ URL::to('/detail-product?product_id='.$value_product->product_id) }}">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ URL::to('public/upload/product/'. $value_product->product_img ) }}" width="256px" height="256px" style="object-fit: cover" alt="" />
                            <h2>{{ number_format($value_product->product_price,0,',','.').' '.' VNĐ' }}</h2>
                            <p>{{ $value_product->product_name }}</p>
                        </div>
                    </div>
                </a>
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
</div>
@endsection