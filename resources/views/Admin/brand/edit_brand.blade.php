@extends('admin_layout')
@section('main_admin')
    <div class="col-lg-12 stretch-card">
        <div class="content-wrapper ">
            <div class="page-header">
                <h3 class="page-title"> Sữa thương hiệu </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Quản lý thương hiệu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sữa thương hiệu</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h2 class="card-title">Điền thông tin danh mục</h2> --}}
                            <h4>
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo '<span style="color: green">', $message, '</span>';
                                    Session::put('message', null);
                                }
                                ?>
                                </h2>
                                {{-- @foreach ($edit_brand as $key => $edit_brand) --}}
                                    <form class="forms-sample"
                                        action="{{ URL::to('/update-brand/' . $edit_brand->brand_id) }}" method="POST" >
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Tên danh mục</label>
                                            <input name="brand_name" type="text" value="{{ $edit_brand->brand_name }}"
                                                class="form-control" id="exampleInputUsername1"
                                                placeholder="Điền tên danh mục">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Mô tả danh mục</label>
                                            <textarea name="brand_desc" rows="10" type="text" class="form-control" id="exampleInputUsername1"
                                                placeholder="Điền mô tả danh mục">{{ $edit_brand->brand_desc }} </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Từ khóa thương hiệu</label>
                                            <textarea name="brand_keywords" rows="10" type="text" class="form-control" id="exampleInputUsername1" placeholder="Điền mô tả thương hiệu">{{ $edit_brand->meta_keywords }} </textarea>
                                          </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hiển thị</label>
                                            <div>
                                                <select name="brand_status" id="" class="form-control" id="exampleInputUsername1">
                                                    <option value="1">Ẩn</option>
                                                    <option value="0">Hiển thị</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2">Cập nhật</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
