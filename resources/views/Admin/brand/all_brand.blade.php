@extends('admin_layout')
@section('main_admin')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
</div>
<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Liệt kê thương hiệu</h1>
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
            <tr class="table"> 
              <th  style="font-weight: bold;"> #ID </th>
              <th  style="font-weight: bold;"> Tên thương hiệu </th>
              <th  style="font-weight: bold;"> Mô tả thương hiệu </th>
              <th  style="font-weight: bold;"> Hiển thị </th>
              <th  style="font-weight: bold;"> Chức năng </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand as $key => $value_brand)
            <tr class="table">
                    <td scope="row">{{$value_brand->brand_id}}</td>
                    <td>{{ $value_brand->brand_name }}</td>
                    <td>{{ $value_brand->brand_desc }}</td>
                    <td>
                        <?php 
                            if($value_brand->brand_status==0){    
                        ?>
                            <a href="{{ URL::to('/unactive-brand-product/'.$value_brand->brand_id )}}"><i class="mdi mdi-lock-open" style="color: green; font-size: 1.2rem;"></i></a>
                        <?php 
                            }else{
                        ?>
                            <a href="{{ URL::to('/active-brand-product/'.$value_brand->brand_id)}}"><i class="mdi mdi-lock" style="color: red; font-size: 1.2rem"></i></a>
                        <?php  
                            }
                        ?>
                    </td>
                    <td>
                        <div>
                            <a href="{{ URL::to('/delete-brand?brand_id='.$value_brand->brand_id) }}"
                                 onclick="return confirm('Bạn muốn xóa thương hiệu này không ?')">
                                <i class="mdi mdi-delete" style="color: red; margin-right: 10px; font-size: 1.4rem"></i>
                            </a>
                            <a href="{{ URL::to('/edit-brand?brand_id='.$value_brand->brand_id) }}">
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
