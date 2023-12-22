<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('backend/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('backend/assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{asset('backend/assets/images/profile/user-1.jpg')}}" width="180" alt="">
                </a>
                <p class="text-center">ADMIN-Quản Lý Kho</p>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                  <div class="mb-3">
                    <p class=" text-center text-danger" style="font-weight: bold;">
                        <?php
                        use Illuminate\Support\Facades\Session;
                        
                        $message = Session::get('message');
                        if ($message) {
                            echo $message;
                            Session::put('message', null); //chỉ cho message hiển thị một lần thôi
                        }
                        ?>
                    </p>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control"  id="username" name="username">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>
               
                  <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Login"/>
             
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>