@extends('admin_layout')
@section('main_admin')
<div class="col-lg-12 stretch-card">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Sữa sản phẩm </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Quản lý sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
          </ol>
        </nav>
      </div>
      <div class="row">
              <?php 
              $message = Session::get('message');
              if($message){
                echo '<span style="color: green">',$message,'</span>';
                Session::put('message', null);
              }
              ?>
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              {{-- <h1 class="card-title">Điền thông tin danh mục</h1> --}}
              @foreach ($edit_product as $key => $value_product)
              <form class="forms-sample" action="{{ URL::to('/update-product/'. $value_product->product_id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputUsername1">Tên sản phẩm</label>
                    <input name="product_name" type="text" value="{{ $value_product->product_name }}" class="form-control" id="exampleInputUsername1" placeholder="Điền tên sản phẩm">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Giá sản phẩm</label>
                      <input name="product_price" type="text" value="{{ $value_product->product_price }}" class="form-control" id="exampleInputUsername1" placeholder="Điền giá sản phẩm">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Hình ảnh sản phẩm</label>
                      <input name="product_img" type="file" class="form-control" id="exampleInputUsername1" >
                      <img src="{{ URL::to('public/upload/product/'.$value_product->product_img) }}" style="width: 100px; height: 100px; object-fit: cover" alt="" srcset="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Mô tả sản phẩm</label>
                    <textarea name="product_desc" rows="10" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền mô tả sản phẩm"> {{ $value_product->product_desc }}
                    </textarea>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Nội dung sản phẩm</label>
                      <textarea name="product_content" rows="5" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền nội dung sản phẩm"> {{ $value_product->product_content }}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Từ khóa sản phẩm</label>
                      <textarea name="product_keywords" rows="5" type="text" class="form-control" id="ckeditor2" placeholder="Điền nội dung sản phẩm">{{ $value_product->meta_keywords }}</textarea>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Danh mục sản phẩm</label>
                      <select name="product_category" class="form-control" id="exampleInputUsername1">
                          @foreach ($category_product as $key => $value_category)
                            @if($value_category->category_id == $value_product->category_id)
                                <option selected value="{{ $value_category->category_id }}">{{ $value_category->category_name }}</option>
                            @else
                                <option value="{{ $value_category->category_id }}">{{ $value_category->category_name }}</option>
                            @endif    
                            @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Thương hiệu sản phẩm</label>
                      <select name="product_brand" class="form-control" id="exampleInputUsername1">
                          @foreach ($brand_product as $key => $value_brand)
                            @if($value_brand->brand_id == $value_product->brand_id)
                                <option selected value="{{ $value_brand->brand_id }}">{{ $value_brand->brand_name }}</option>
                            @else
                                <option value="{{ $value_brand->brand_id }}">{{ $value_brand->brand_name }}</option>
                            @endif
                            @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hiển thị</label>
                    <div>
                        <select name="product_status" id="" class="form-control" id="exampleInputUsername1">
                            <option value="1">Ẩn</option>
                            <option value="0">Hiển thị</option>
                        </select>
                    </div>
                </div>
                  <button type="submit" class="btn btn-gradient-primary me-2">Cập nhật</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection