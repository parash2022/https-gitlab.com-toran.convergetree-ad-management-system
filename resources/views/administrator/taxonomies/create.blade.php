@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

<form method="post" action="{{route('administrator.taxonomies.store')}}">
  @csrf
  <div class="form-layout form-layout-4">
    <h6 class="br-section-label">{{__('Add Taxonomy')}}</h6>
    <p class="br-section-text">{{__('Lorem ipsum dollor site amet.')}}</p>
    <div class="row">
      <label class="col-sm-4 form-control-label">{{__('Name')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
      </div>
    </div><!-- row -->

    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </div>
</form>
@endsection