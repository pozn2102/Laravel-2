<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/style.css') }}">
    <!-- End layout styles -->
<link rel="shortcut icon" href="{{ asset('public/backend/images/favicon.ico') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{ asset('public/backend/images/logo.svg') }}">
                </div>
                <h3 style="text-align: center; color: #a861ff; font-weight: bolder">Đăng ký</h3>
                <form class="pt-3" action="{{ URL::to('/add-register-admin') }}" method="post">
                    {{ csrf_field() }}
                    <h6 class="font-weight-light">
                        <?php 
                            $message = Session::get('message');
                            if($message){
                                echo '<span style="color: green">',$message ,'</span>';
                                Session::put('message', null);
                            }
                        ?>
                    </h6>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Name" name="admin_name">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="email" name="admin_email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="admin_pass">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Phone" name="admin_phone">
                  </div>
                  <div class="mt-3" style="display: flex; justify-content: space-around">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="">Đăng ký</button>
                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="{{ URL::to('/login-admin') }}">Đăng nhập</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/backend/js/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>