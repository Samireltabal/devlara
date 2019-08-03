@include('admin.main.head')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/">{{ env("APP_NAME") }}</a>
      <br>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ __('custom.signInMessage') }}</p>
  @if(session('Error'))
      <div class="alert alert-danger alert-dismissible">{{session('Error')}}</div>
    @endif
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('custom.email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('custom.password') }}" name="password" required />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif            
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('custom.rememberMe') }}</label>
                     </div>
                </div>
        <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-success btn-block btn-flat">{{ __('custom.signIn') }}</button>
                </div>
        <!-- /.col -->
            </div>
    </form>
    <a href="{{ route('password.request') }}">{{ __('custom.passwordRestore') }}</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="{{ asset('admin/app.js') }}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
