@extends('admin_layout')
@section('main_admin')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    {{-- <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <form action="{{ URL::to('/search-product-admin') }}" method="post">
                    {{ csrf_field() }}
                    <span>
                        <div class="input-group mb-3">
                            <input type="text" name="keywords_search" class="form-control"
                                placeholder="Tìm kiếm sản phẩm" aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <button type="submit" class="input-group-text btn-primary" id="basic-addon2">Tìm
                                kiếm</button>
                        </div>
                    </span>
                </form>
            </li>
        </ul>
    </nav> --}}
</div>
<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Liệt kê danh mục</h1>
            <div>
                <?php 
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: green">',$message,'</span>';
                        Session::put('message', null);
                    }
                ?>
            </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th  style="font-weight: bold;"> #ID </th>
              <th  style="font-weight: bold;"> Tên danh mục </th>
              <th  style="font-weight: bold;"> Mô tả danh mục </th>
              <th  style="font-weight: bold;"> Hiển thị </th>
              <th  style="font-weight: bold;"> Chức năng </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category as $key => $value_category)
            <tr class="table">
                    <td>{{$value_category->category_id}}</td>
                    <td>{{ $value_category->category_name }}</td>
                    <td>{{ $value_category->category_desc }}</td>
                    <td>
                        <?php 
                            if($value_category->category_status==0){    
                        ?>
                            <a href="{{ URL::to('/unactive-category-product/'.$value_category->category_id )}}"><i class="mdi mdi-lock-open" style="color: green; font-size: 1.2rem;"></i></a>
                        <?php 
                            }else{
                        ?>
                            <a href="{{ URL::to('/active-category-product/'.$value_category->category_id)}}"><i class="mdi mdi-lock" style="color: red; font-size: 1.2rem"></i></a>
                        <?php  
                            }
                        ?>
                    </td>
                    <td>
                        <div>
                            <a href="{{ URL::to('/delete-category?category_id='.$value_category->category_id) }}"
                                 onclick="return confirm('Bạn muốn xóa danh mục này không ?')">
                                <i class="mdi mdi-delete" style="color: red; margin-right: 10px; font-size: 1.4rem"></i>
                            </a>
                            <a href="{{ URL::to('/edit-category?category_id='.$value_category->category_id) }}">
                                <i class="mdi  mdi-open-in-new" style="color: green; font-size: 1.2rem"></i>
                            </a>
                        </div>
                    </td>
                @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
