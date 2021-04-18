@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

   <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">Edit User</h4>
        </div>
      </div>

  <div class="br-section-wrapper">

<form method="post" action="{{route('administrator.users.update',[$user->id])}}">
  @csrf
  <div class="form-inner">
   
    <div class="row">
      <label class="col-sm-4 form-control-label">{{__('Name')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="first_name" class="form-control" value="{{$user->name}}">
      </div>
    </div><!-- row -->
     <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Email')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="email" class="form-control" value="{{$user->email}}">
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Password')}}:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="password" class="form-control" value="">
        <small>Leave this field blank to skip password change</small>
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('User Role')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <select name="role" class="form-control" >
          <option value="">{{__('Select role')}}</option>
          @if(!$roles->isEmpty())
            @foreach($roles as $role)
              <option value="{{$role->id}}" @isset($user_role->id) @if($role->id == $user_role->id) selected @endif @endisset  
                @if($user->id == 1 && $role->id>1) disabled @endif>{{$role->title}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </div>
</form>
</div>
@endsection