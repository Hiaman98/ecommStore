<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Log in (v2)</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset ("plugins/fontawesome-free/css/all.min.css")}}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset ("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset("css/admin_css/adminlte.min.css")}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
    <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
    <p class="login-box-msg">Sign in to start your session</p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('login') }}" method="post">
        @csrf
        @if(Session::has("error_message")) 
            <div class="alert alert-dange alert-dismissible fade show" role="alert">
                    {{ Session::get("error_message") }}                
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
            <span class="fas fa-lock"></span>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
            <input type="checkbox" id="remember">
            <label for="remember">
                Remember Me
            </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
        </div>
    </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.login-box -->

</body>
</html>
