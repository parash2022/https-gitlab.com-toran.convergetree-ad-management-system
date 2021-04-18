@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')
   <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">Edit Role</h4>
        </div>
      </div>

  <div class="br-section-wrapper">
<form method="post" action="{{route('administrator.roles.update',[$role->id])}}">
  @csrf
  <div class="form-inner">
  
    <div class="row">
      <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="title" class="form-control" value="{{$role->title}}">
      </div>
    </div><!-- row -->

    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </div>
</form>
</div>
@endsection
