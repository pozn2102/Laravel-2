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
            <h1 class="card-title">Liệt kê đơn hàng</h1>
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
              <th  style="font-weight: bold;"> Tên người đặt</th>
              <th  style="font-weight: bold;"> Tổng giá tiền </th>
              <th  style="font-weight: bold;"> Tình trạng </th>
              <th  style="font-weight: bold;"> Chức năng </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_order as $key => $value_order)
            <tr class="table">
                    <td>{{$value_order->order_id}}</td>
                    <td>{{ $value_order->customer_name }}</td>
                    <td>{{ $value_order->order_total}}</td>
                    <td>{{ $value_order->order_status }}</td>
                    <td>
                        <div>
                            <a href="{{ URL::to('/delete-order?order_id='.$value_order->order_id) }}"
                                 onclick="return confirm('Bạn muốn xóa đơn hàng này không ?')">
                                <i class="mdi mdi mdi-delete-forever" style="color: red; margin-right: 10px; font-size: 1.4rem"></i>
                            </a>
                            <a href="{{ URL::to('/view-order?order_id='.$value_order->order_id) }}">
                                <i class="mdi  mdi mdi-eye" style="color: green; font-size: 1.2rem"></i>
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
