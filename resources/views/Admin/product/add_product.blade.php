@extends('admin_layout')
@section('main_admin')
<div class="col-lg-12 stretch-card">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Thêm sản phẩm </h3>
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
              <form class="forms-sample" action="{{ URL::to('/save-product') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputUsername1">Tên sản phẩm</label>
                  <input data-validation="length" data-validation-length="min3" data-validation-error-msg="Bạn chưa điền thông tin" name="product_name" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Giá sản phẩm</label>
                    <input name="product_price" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Hình ảnh sản phẩm</label>
                    <input name="product_img" type="file" class="form-control" id="exampleInputUsername1" >
                </div>
                <div class="form-group">
                  <label for="exampleInputUsername1">Mô tả sản phẩm</label>
                  <textarea name="product_desc" rows="10" type="text" class="form-control" id="ckeditor1" placeholder="Điền mô tả sản phẩm"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Nội dung sản phẩm</label>
                    <textarea name="product_content" rows="5" type="text" class="form-control" id="ckeditor2" placeholder="Điền nội dung sản phẩm"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Từ khóa sản phẩm</label>
                    <textarea name="product_keywords" rows="5" type="text" class="form-control" id="ckeditor2" placeholder="Điền nội dung sản phẩm"></textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Danh mục sản phẩm</label>
                    <select name="product_category" class="form-control" id="exampleInputUsername1">
                        @foreach ($product_category as $key => $value_category)
                            <option value="{{ $value_category->category_id }}">{{ $value_category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Thương hiệu sản phẩm</label>
                    <select name="product_brand" class="form-control" id="exampleInputUsername1">
                        @foreach ($product_brand as $key => $value_brand)
                            <option value="{{ $value_brand->brand_id }}">{{ $value_brand->brand_name }}</option>
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
                <button type="submit" class="btn btn-gradient-primary me-2">Thêm</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection