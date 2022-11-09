@extends('admin_layout')
@section('main_admin')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
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
                    {{-- <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Liệt kê sản phẩm</h1>
                <div>
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span style="color: green">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
                </div>
                <table class="table-bordered table">
                    <thead>
                        <tr>
                            <th style="font-weight: bold;"> #ID </th>
                            <th style="font-weight: bold;"> Tên sản phẩm </th>
                            <th style="font-weight: bold;"> Hình ảnh sản phẩm </th>
                            <th style="font-weight: bold;"> Giá sản phẩm </th>
                            <th style="font-weight: bold;"> Danh mục </th>
                            <th style="font-weight: bold;"> Thương hiệu </th>
                            <th style="font-weight: bold;"> Nội dung sản phẩm </th>
                            <th style="font-weight: bold;"> Hiển thị </th>
                            <th style="font-weight: bold;"> Chức năng </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $value_product)
                            <tr class="table">
                                <td scope="row">{{ $value_product->product_id }}</td>
                                <td>{{ $value_product->product_name }}</td>
                                <td>
                                    <img src="public/upload/product/{{ $value_product->product_img }}" alt="Ảnh sản phẩm"
                                        style="width: 50px; height: 50px; object-fit: cover">
                                </td>
                                <td>{{ number_format($value_product->product_price, 0, '.', ',') . ' ' . 'VNĐ' }}</td>
                                <td>{{ $value_product->category_name }}</td>
                                <td>{{ $value_product->brand_name }}</td>
                                <td>{{ $value_product->product_content }}</td>
                                <td>
                                <?php 
                                    if($value_product->product_status==0){    
                                ?>
                                <a href="{{ URL::to('/unactive-product/' . $value_product->product_id) }}"><i class="mdi mdi-lock-open" style="color: green; font-size: 1.2rem;"></i></a>
                                <?php 
                                    }else{
                                ?>
                                    <a href="{{ URL::to('/active-product/' . $value_product->product_id) }}"><i
                                            class="mdi mdi-lock" style="color: red; font-size: 1.2rem"></i></a>
                                <?php  
                                    }
                                ?>
                                </td>
                                <td>
                                    <div>
                                        <a href="{{ URL::to('/delete-product?product_id=' . $value_product->product_id) }}"
                                            onclick="return confirm('Bạn muốn xóa sản phẩm này không ?')">
                                            <i class="mdi mdi-delete"
                                                style="color: red; margin-right: 10px; font-size: 1.4rem"></i>
                                        </a>
                                        <a href="{{ URL::to('/edit-product?product_id=' . $value_product->product_id) }}">
                                            <i class="mdi  mdi-open-in-new" style="color: green; font-size: 1.2rem"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
