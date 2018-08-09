@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Accounts")}}
@endsection


@section('content')
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Accounts List")}}</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>  
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>{{__("ID")}}</th>
                  <th>{{__("Name")}}</th>
                  <th>{{__("Email")}}</th>
                  <th>{{__("Status")}}</th>
                  <th>{{__("Role")}}</th>
                  <th>{{__("Member Since")}}</th>
                  <th>{{__("Actions")}}</th>
                </tr>
                @foreach($users as $user) 
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if($user->active)
                        <span class="label label-success">{{__("Active")}}</span>
                        @else
                        <span class="label label-danger">{{__("Disabled")}}</span>
                        @endif
                      </td>
                      <td>
                      @foreach($user->roles as $role)
                        {{ $role->name }}
                      @endforeach
                      </td>
                      <td>{{ $user->created_at }}</td>
                      <td>
                          
                        <form style="display:inline;" action="{{ route('toggleState') }}" method="post">
                          @csrf
                          <input type="hidden" name="user_id" value="{{ $user->id }}">  
                          <button type='submit' class="btn btn-success btn-xs" data-toggle='tooltip' title='Activate/Deactivate'>
                            @if($user->active)
                            <i class="fa fa-remove" aria-hidden="true"></i> {{__("Deactivate")}}
                            @else
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{__("Activate")}}
                            @endif
                          </button>
                        </form>
                        
  
                         
                      <a href="{{ route('accounts.edit',$user->id) }}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> {{__("Edit")}}</a>
                        <a id="{{ $user->id }}"  onclick="confirmDelete('{{ $user->id }}');" link="{{ route('deleteAccount') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> {{__("Delete")}} </a>
                      </td>
                    </tr>
                @endforeach
              </table>
  
              
            </div>
          <div class="box-footer clearfix">
              {{ $users->links('vendor.pagination.default') }}
          </div>
        </div>
        
      

@endsection