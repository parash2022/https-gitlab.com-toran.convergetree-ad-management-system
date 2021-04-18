@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

   <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">Edit Ad</h4>
        </div>
      </div>

  <div class="br-section-wrapper">

<form method="post" action="{{route('administrator.ads.update',['id'=>$ad->id])}}" enctype="multipart/form-data">
  @csrf
 
    

     <div class="row ">
      <label class="col-sm-4 form-control-label">{{__('Platform')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <select name="platform" class="form-control" >
          <option value="">Select Platform</option>
          @if(!$platforms->isEmpty())
          @foreach($platforms as $plt)
          <option value="{{$plt->id}}" @if($ad->platform_id == $plt->id) selected @endif>{{$plt->name}}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>

      <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Client')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
       <select name="client" class="form-control" >
          <option value="">Select client</option>
          @if(!$clients->isEmpty())
            @foreach($clients as $clt)
              <option value="{{$clt->id}}" @if($ad->client_id == $clt->id) selected @endif >{{$clt->name}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Ad Type')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
       <select name="adtype" class="form-control" >
          <option value="">Select Ad Type</option>
          @if(!$adtypes->isEmpty())
            @foreach($adtypes as $at)
              <option value="{{$at->id}}" @if($ad->adtype_id == $at->id) selected @endif>{{$at->name}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="row  mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Category')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
       <select name="cat[]" class="form-control" id="ad-category">
          <option value="">Select category</option>
          @if(!$categories->isEmpty())
            @foreach($categories as $cat)
              <?php 
                $activeCat = '';
                $selected = '';
               if($ad->terms->contains($cat->id)){
                $selected = 'selected';
                $activeCat = $cat;
               }
              ?>
              <option value="{{$cat->id}}" {{$selected}}>{{$cat->name}}</option>
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
           @if(!$categories->isEmpty())
            @foreach($categories as $cat)
               @if($cat->children->count()>0)
                @foreach($cat->children as $child)
                  <?php $selected = $ad->terms->contains($child->id)?'selected':'';?>
                  <option value="{{$child->id}}" {{$selected}}>{{$child->name}}</option>
                @endforeach
            @endif
         @endforeach
         @endif
        </select>
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="title" class="form-control" value="{{$ad->title}}">
      </div>
    </div>

     <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Destination URL')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="url" name="url" class="form-control" value="{{$ad->url}}">
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Image')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
         <div class="featured-photo-box">
            <?php $dnone = '';?>
            @if($ad->image && App\Helpers\Thumbnail::exist($ad->image))
            <?php $dnone = 'd-none';?>
            <div class="featured-input has-thumb position-relative">
              <div class="thumb-preview">
                <img  src="{{App\Helpers\Thumbnail::url($ad->image)}}">
                <a href="#" class="close remove-featured-photo position-absolute">x</a>
                <input type="hidden" name="old_featured_photo" value="{{$ad->image}}">
              </div>
            </div>
            @endif
            <div class="featured-input {{$dnone}}  hidable border bg-white">
                  <input type="file" data-name="featured_photo"  class="featured-photo d-none" />
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

 <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Starts on')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="date" name="publish_date" class="form-control" value="{{$ad->publish_date->format('Y-m-d')}}">
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Expires on')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="date" name="expiry" class="form-control" value="{{$ad->expiry->format('Y-m-d')}}">
      </div>
    </div>

    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>

</form>
</div>

<div class="featured-input clonable d-none position-relative">
  <div class="thumb-preview">
    <img  src="">
    <a href="#" class="close remove-featured-photo position-absolute">x</a>
    <input type="hidden" name="featured_photo" value="">
  </div>
</div>
@endsection