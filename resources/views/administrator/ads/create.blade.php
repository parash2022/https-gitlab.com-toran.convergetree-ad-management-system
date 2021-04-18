@extends('administrator.layouts.oreo')
@section('content')
@include('administrator.notices.flash')
<div class="br-pagetitle">
  <div>
    <h4 class="mb-0">Add New Ad</h4>
  </div>
</div>
<div class="br-section-wrapper">
  <form method="post" action="{{route('administrator.ads.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <label class="col-sm-4 form-control-label">{{__('Platform')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
     @if(!$platforms->isEmpty())
        @foreach($platforms as $plt)
        <label class="mg-r-20"><input type="checkbox" name="platform[]" value="{{$plt->id}}" @if(in_array($plt->id,(array)old('platform'))) checked @endif> {{$plt->name}}</label> 
        @endforeach
        @endif
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Client')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <select name="client" class="form-control" id="client_id">
        <option value="">Select client</option>
        @if(!$clients->isEmpty())
        @foreach($clients as $clt)
        <option value="{{$clt->id}}" @if(old('client') == $clt->id) selected @endif >{{$clt->name}}</option>
        @endforeach
        @endif
        <option value="0"> >> Create New Client</option>
      </select>
    </div>
  </div>
  <div class="row mg-t-20 d-none"  id="create-client">
    <label class="col-sm-4 form-control-label">{{__('Client Name')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <input type="text" name="client_name" class="form-control" value="{{old('client_name')}}">
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Ad Type')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <select name="adtype" class="form-control" >
        <option value="">Select Ad Type</option>
        @if(!$adtypes->isEmpty())
        @foreach($adtypes as $at)
        <option value="{{$at->id}}" @if(old('adtype') == $at->id) selected @endif>{{$at->name}}</option>
        @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Category')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <select name="cat[]" class="form-control" id="ad-category">
        <option value="">Select category</option>
        @if(!$categories->isEmpty())
        @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Subcategory')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <select name="cat[]" class="form-control" id="ad-subcategory">
        <option value="">Select sub-category</option>
      </select>
    </div>
  </div>
  <div class="mg-t-20 p-4 bg-light tab-wrap position-relative">
    <div class="tab-data-check position-absolute">
      <label><input type="checkbox" name="skip_mobile" value="1"> Mobile entry same as desktop</label>
    </div>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#desktop" role="tab" aria-controls="home" aria-selected="true">Desktop</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mobile" role="tab" aria-controls="profile" aria-selected="false">Mobile</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="desktop" role="tabpanel" aria-labelledby="home-tab">
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <input type="text" name="desktop_title" class="form-control" value="{{old('desktop_title')}}">
        </div>
      </div>
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Destination URL')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <input type="text" name="desktop_url" class="form-control" value="{{old('desktop_url')}}">
        </div>
      </div>
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Image')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <div class="featured-photo-box">
            <div class="featured-input hidable border bg-white">
              <input type="file" data-name="desktop_featured_photo" class="featured-photo d-none" />
              <a href="#" class=" img-inner-wrapper text-center browse-featured-photo">
                <div class="img-inner">
                  <img src="{{asset('/img/browse.png')}}" class="center">
                  <div class="caption-center">Browse</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="mobile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <input type="text" name="mobile_title" class="form-control" value="{{old('mobile_title')}}">
        </div>
      </div>
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Destination URL')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <input type="text" name="mobile_url" class="form-control" value="{{old('mobile_url')}}">
        </div>
      </div>
      <div class="row mg-t-20">
        <label class="col-sm-4 form-control-label">{{__('Image')}}:<span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <div class="featured-photo-box">
            <div class="featured-input hidable border bg-white">
              <input type="file" data-name="mobile_featured_photo" class="featured-photo d-none" />
              <a href="#" class=" img-inner-wrapper text-center browse-featured-photo">
                <div class="img-inner">
                  <img src="{{asset('/img/browse.png')}}" class="center">
                  <div class="caption-center">Browse</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Starts on')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <input type="date" name="publish_date" class="form-control" value="{{$today->format('Y-m-d')}}">
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{__('Expires on')}}:<span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <input type="date" name="expiry" class="form-control" value="{{old('expiry')}}">
    </div>
  </div>
  <div class="form-layout-footer mg-t-30">
    <button class="btn btn-primary">{{__('Save')}}</button>
  </div>
</form>
<div class="featured-input clonable d-none position-relative">
  <div class="thumb-preview">
    <img  src="">
    <a href="#" class="close remove-featured-photo position-absolute">x</a>
    <input type="hidden" name="featured_photo" value="">
  </div>
</div>
</div>
@endsection