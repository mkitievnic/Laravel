<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>San Antonio</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page" style="background: url({{ asset('images/logo_10.jpeg')  }}) repeat center top">
<div class="login-box" style="width: 500px; margin-top: 200px">
    <!-- /.login-logo -->
    <div class="login-box-body"
         style="border: 1px solid #D0D0D0; box-shadow: 0 3px 12px rgba(0, 0, 0, .09); border-radius: 7px">
        <div class="row">
            <div class="col-sm-5 text-center" style="margin-top: 15px">
                <img src="{{ asset('images/logo.png') }}" width="150px" alt="">
                <h4 style="color: orange">SAN ANTONIO</h4>
                <small style="color: #8a6d3b">I N T E R N A C I O N A L</small>
            </div>
            <div class="col-sm-7" style="border-left: 1px solid #D0D0D0; padding-top: 7px;">
                <p class="login-box-msg"><strong>SAN ANTONIO TRADING</strong>
                    <br>
                    <small>Ingrese sus credendiales de acceso</small>
                </p>

                <div class="clearfix"></div>
                @include('flash::message')
                <div class="clearfix"></div>

                <form method="post" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="Cuenta">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                        @endif

                    </div>

                    <div class="row">
                        <div class="col-xs-12" style="margin-top: -10px; margin-bottom: 25px">
                            <input type="checkbox" name="remember"> Recordar nombre de usuario
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-12" style="margin-bottom: 10px">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar al Sistema
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
