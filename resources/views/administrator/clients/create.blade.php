@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

   <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">Add Client</h4>
        </div>
      </div>

  <div class="br-section-wrapper">

<form method="post" action="{{route('administrator.clients.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="form-inner">
    <h6 class="br-section-label">{{__('Add new Client')}}</h6>
  
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Name')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
      </div>
    </div>

    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </div>
</form>
</div>

@endsection