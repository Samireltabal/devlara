@extends('admin.layout.app')
<?php
$locale = get_locale();
  App::setLocale($locale);
?>
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
                    <div class="form-group col-lg-12">
                        <label for="role">{{ __("Role") }}</label>
                        <select name="role" class='form-control' id="role">
                            @foreach($roles as $role)
                        <option value="{{ $role->id }}" 
                            @foreach($user->roles as $user_role)
                            @if($user_role->id == $role->id)
                            selected
                            @endif
                            @endforeach
                            >{{ $role->name }} - <small>{{ $role->description }}</small></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                    <label for="active">{{ __("Do You like to activate the account now ?") }}</label>
                    <input type="checkbox" name="active" id="active"
                    @if($user->active)
                        checked
                    @endif
                    >
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