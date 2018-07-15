@extends('admin.layout.app')

@section('title')
  Edit Account
@endsection


@section('content')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ __("Edit Account")}} {{__("For")}} {{ $user->name }}</h3>
            </div>  
            <form action="{{ route("accounts.update",$user->id) }}" method="POST" >
            @csrf
            <input type="hidden" name="_method" value="put" >
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} col-lg-12">
                    <label for="name">{{ __("Name") }} :</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __("Name") }}" value="{{ $user->name }}" aria-describedby="helpId">
                    @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} col-lg-12">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __("Email Address") }}" value="{{ $user->email }}" aria-describedby="helpId">
                    @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                    

          </div>
          <div class="box-footer clearfix">
            <div class="form-group col-lg-6">
                <button type="reset" class="btn btn-warning btn-flat btn-block">{{ __("Cancel") }}</button>
            </div>
            <div class="form-group col-lg-6">
                <button type="submit" class="btn btn-success btn-flat btn-block">{{ __("Submit") }}</button>
                </div>
        </div>
        </form>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ __("Edit Password")}}</h3>
            </div>
            <div class="box-body">
                <hr>
            <form action="{{ route('accounts.password') }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-lg-12">
                <label for="oldPassword">{{ __("Old Password") }}</label>
            <input type="password"class='form-control' name="oldPassword" id="oldPassword" placeholder="{{ __("Password") }}" />
                @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-lg-6">
                <label for="password">{{ __("New Password") }}</label>
                <input type="password"class='form-control' name="password" id="password" placeholder="{{ __("Password") }}"/>
                @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('passwordConfirmation') ? ' has-error' : '' }} col-lg-6">
                    <label for="password_confirmation">{{ __("New Password Confirmation") }}</label>
                    <input type="password"class='form-control' name="password_confirmation" id="password_confirmation" placeholder="{{ __("Password Confirmation") }}"/>
                    @if($errors->has('password_confirmation'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
                </div>
            </div>
                <div class="box-footer clearfix">
                        <div class="form-group col-lg-6">
                            <button type="reset" class="btn btn-warning btn-flat btn-block">{{ __("Cancel") }}</button>
                        </div>
                        <div class="form-group col-lg-6">
                            <button type="submit" class="btn btn-success btn-flat btn-block">{{ __("Change Password") }}</button>
                            </div>
                    </div>
        </form>
        </div>
        
      
        <script>
                $(function () {
                  $('input').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                    increaseArea: '20%' /* optional */
                  });
                });
              </script>
@endsection