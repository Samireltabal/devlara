@extends('admin.layout.app')

@section('title')
  Create Account
@endsection


@section('content')

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Create New Account")}}</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>  
            <form action="{{ route("accounts.createAdd") }}" method="POST" >
            @csrf
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} col-lg-12">
                    <label for="name">{{ __("Name") }} :</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __("Name") }}" aria-describedby="helpId">
                    @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} col-lg-12">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __("Email Address") }}" aria-describedby="helpId">
                    @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-lg-6">
                    <label for="password">{{ __("Password") }}</label>
                    <input type="password"class='form-control' name="password" id="password" placeholder="{{ __("Password") }}"/>
                    @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('passwordConfirmation') ? ' has-error' : '' }} col-lg-6">
                        <label for="password_confirmation">{{ __("Password Confirmation") }}</label>
                        <input type="password"class='form-control' name="password_confirmation" id="password_confirmation" placeholder="{{ __("Password Confirmation") }}"/>
                        @if($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="role">{{ __("Role") }}</label>
                        <select name="role" class='form-control' id="role">
                            @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }} - <small>{{ $role->description }}</small></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                    <label for="active">{{ __("Do You like to activate the account now ?") }}</label>
                    <input type="checkbox" name="active" id="active ">
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