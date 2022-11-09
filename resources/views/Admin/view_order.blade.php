@extends('admin_layout')
@section('main_admin')
    <div class="col-lg-12 stretch-card">
        <?php
        $message = Session::get('message');
        if ($message) {
            echo '<span style="color: green">', $message, '</span>';
            Session::put('message', null);
        }
        ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Thông tin người mua</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="font-weight: bold;"> #ID </th>
                            <th style="font-weight: bold;"> Tên khách hàng</th>
                            <th style="font-weight: bold;"> Email khách hàng </th>
                            <th style="font-weight: bold;"> Số điện thoại </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($all_order as $key => $value_order) --}}
                        <tr class="table">
                            <td>{{ $order_by_id->customer_id }}</td>
                            <td>{{ $order_by_id->customer_name }}</td>
                            <td>{{ $order_by_id->customer_email }}</td>
                            <td>{{ $order_by_id->customer_phone }}</td>
                            {{-- @endforeach --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Thông tin vận chuyển</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="font-weight: bold;"> #ID </th>
                            <th style="font-weight: bold;"> Tên người vận chuyển</th>
                            <th style="font-weight: bold;"> Địa chỉ </th>
                            <th style="font-weight: bold;"> Số điện thoại </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($all_order as $key => $value_order) --}}
                        <tr class="table">
                            <td>{{ $order_by_id->shipping_id }}</td>
                            <td>{{ $order_by_id->shipping_name }}</td>
                            <td>{{ $order_by_id->shipping_address }}</td>
                            <td>{{ $order_by_id->shipping_phone }}</td>
                            {{-- @endforeach --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Liệt kê chi tiết đơn hàng</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="font-weight: bold;"> #ID </th>
                            <th style="font-weight: bold;"> Tên sản phẩm</th>
                            <th style="font-weight: bold;"> Số lượng </th>
                            <th style="font-weight: bold;"> Giá </th>
                            <th style="font-weight: bold;"> Tổng tiền </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($all_order as $key => $value_order) --}}
                        <tr class="table">
                            <td>{{ $order_by_id->product_id }}</td>
                            <td>{{ $order_by_id->product_name }}</td>
                            <td>{{ $order_by_id->product_sales_quantity }}</td>
                            <td>{{ number_format($order_by_id->product_price, 0, '.', ',') . ' ' . 'vnđ' }}</td>
                            <td>{{ $order_by_id->order_total }}</td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
