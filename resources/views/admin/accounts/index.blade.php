@extends('admin.layout.app')

@section('title')
  Accounts
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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Member Since</th>
                <th>Actions</th>
              </tr>
              @foreach($users as $user) 
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @if($user->active)
                      <span class="label label-success">Active</span>
                      @else
                      <span class="label label-danger">Disabled</span>
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
                          <i class="fa fa-remove" aria-hidden="true"></i> Deactivate
                          @else
                          <i class="fa fa-check-circle-o" aria-hidden="true"></i> Activate
                          @endif
                        </button>
                      </form>
                      

                       
                      <a href="#" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Edit</a>
                        

                        <form style="display:inline;" action="{{ route('deleteAccount') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">  
                            <input type="hidden" name="_method" value='delete'>
                            <button type='submit' class="btn btn-danger btn-xs" title="Remove"><i class="fa fa-remove fa-lg" aria-hidden="true"></i> Remove</button>
                          </form>
                      
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