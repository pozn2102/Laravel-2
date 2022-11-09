@extends('user_layout')
@section('user_main')
<div class="col-sm-9 padding-right">
    <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    @foreach ($product_detail as $key => $value_detail)
    <div class="product-details">
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{ URL::to('public/upload/product/'.$value_detail->product_img) }}" alt="" />
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                        </div>
                        <div class="item">
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                        </div>
                        <div class="item">
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                          <a href=""><img src="{{ asset('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                        </div>
                    </div>

                  <!-- Controls -->
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                  </a>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{ $value_detail->product_name }}</h2>
                <p>ID: {{ $value_detail->product_id }}</p>
                <img src="images/product-details/rating.png" alt="" />
                <form action="{{ URL::to('/save-cart') }}" method="post">
                    {{ csrf_field() }}
                    <span>
                        <span>{{ number_format($value_detail->product_price,0,',','.').' '.'VNĐ' }}</span>
                        <label>Quantity:</label>
                        <input name="qty" type="number" value="1" min="1" />
                        <input name="product_id_hidden" type="hidden" value="{{ $value_detail->product_id  }}" />
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </span>
                </form>
                <p><b>Tình trạng: </b> Còn hàng</p>
                <p><b>Thương hiệu:</b> {{ $value_detail->brand_name }}</p>
                <p><b>Danh mục: </b> {{ $value_detail->category_name }}</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div>
    @endforeach
    

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">	
                    @foreach ($relate as $key => $value_relate)
                    <a href="{{ URL::to('/detail-product?product_id='.$value_relate->product_id) }}">
                    <div class="col-sm-4">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ URL::to('public/upload/product/'. $value_relate->product_img ) }}" alt="" />
                                <h2>{{ number_format($value_relate->product_price,0,',','.').' '.' VNĐ' }}</h2>
                                <p>{{ $value_relate->product_name }}</p>
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
                <div class="item">	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>			
        </div>
    </div><!--/recommended_items-->
    <div class="fb-comments" data-href="" data-width="" data-numposts="20"></div>
    <div class="fb-comments" data-href="http://localhost/MyProject" data-width="" data-numposts="20"></div>
</div>
@endsection
