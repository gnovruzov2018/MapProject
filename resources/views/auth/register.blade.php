<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MapProject | Qeydiyyat</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_Lte/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_Lte/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin_Lte/css/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Map</b>Project</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Qeydiyyat</p>

        @include('partials.flash')

        <form method="POST" action="{{ route('register') }}">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Ad" name="name" id="name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Soyad" name="surname" id="surname" value="{{ old('surname') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('surname'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Ata adı" id="father_name" name="father_name" value="{{ old('father_name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('father_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('father_name  ') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Şifrə" name="password" id="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Təkrar şifrə" name="password_confirmation" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">

                <!-- /.col -->
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Üzv Ol</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


        <a href="{{route('login')}}" class="text-center">Artıq Hesabım Var</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{asset('admin_Lte/js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin_Lte/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('admin_Lte/js/icheck.min.js')}}"></script>
<script>
//    $(function () {
//        $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//        });
//    });
</script>
</body>
</html>

