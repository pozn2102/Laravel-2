@extends('admin_layout')
@section('main_admin')
<div class="col-lg-12 stretch-card">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Thêm danh mục </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Quản lý danh mục</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
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
              <form class="forms-sample" action="{{ URL::to('/save-category') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputUsername1">Tên danh mục</label>
                  <input  name="category_name" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền tên danh mục">
                </div>
                <div class="form-group">
                  <label for="exampleInputUsername1">Mô tả danh mục</label>
                  <textarea name="category_desc" rows="10" type="text"  class="form-control" id="exampleInputUsername1" placeholder="Điền mô tả danh mục">
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputUsername1">Từ khóa danh mục</label>
                  <textarea name="category_keywords" rows="10" type="text"  class="form-control" id="exampleInputUsername1" placeholder="Điền mô tả danh mục">
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Hiển thị</label>
                  <div>
                    <select name="category_status" id="" class="form-control" id="exampleInputUsername1">
                        <option value="1">Ẩn</option>
                        <option value="0">Hiển thị</option>
                      </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection