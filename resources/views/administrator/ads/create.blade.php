<?php

use App\Http\Controllers\Admin\CategoryController;
?>

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
        <select name="platform" class="form-control">

          <option value="">Select Platform</option>
          @if(!$platforms->isEmpty())
          @foreach($platforms as $plt)
          <?php
          $pid = (old('platform') != '') ? old('platform') : 3;
          $pselected = ($pid == $plt->id) ? 'selected' : '';
          //  @if(old('platform')==$plt->id) selected @endif
          ?>
          <option value="{{$plt->id}}" <?php echo $pselected ?>>{{$plt->name}}</option>
          @endforeach
          @endif

        </select>
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Client')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <select name="client" class="form-control" id="client_id">
          <option value="">Select client</option>
          @if(!$clients->isEmpty())
          @foreach($clients as $clt)
          <option value="{{$clt->id}}" @if(old('client')==$clt->id) selected @endif >{{$clt->name}}</option>
          @endforeach
          @endif
          <option value="0" @if(old('client')!='' and old('client')==0) selected @endif> >> Create New Client</option>
        </select>
      </div>
    </div>

    <?php $cid = old('client') ?>

    <div class="row mg-t-20  <?php echo ($cid == '' || $cid != 0) ? 'd-none' : ''; ?>" id="create-client">
      <label class="col-sm-4 form-control-label">{{__('Client Name')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="client_name" class="form-control" value="{{old('client_name')}}">
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Ad Type')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <select name="adtype" class="form-control">
          <option value="">Select Ad Type</option>
          @if(!$adtypes->isEmpty())
          @foreach($adtypes as $at)
          <?php
          $atid     = (old('adtype') != '') ? old('adtype') : 14;
          $selected = ($atid == $at->id) ? 'selected' : '';
          // @if(old('adtype')==$at->id) selected @endif
          ?>
          <option value="{{$at->id}}" <?php echo $selected ?>>{{$at->name}}</option>
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
          <option @if(old('cat.0')==$cat->id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Subcategory')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <select name="cat[]" class="form-control" id="ad-subcategory" multiple>
          <option value="">Select sub-category</option>
          <?php
          if (old('cat.0') != '') {
            $subCategory = CategoryController::getSubCategory(old('cat.0'));
            foreach ($subCategory as $s) {
          ?>
              <option @if(old('cat.1')==$s->id) selected @endif value="{{ $s->id }}">{{ $s->name }}</option>
          <?php
            }
          }
          ?>
        </select>
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="title" class="form-control" value="{{old('title')}}">
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Destination URL')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="url" class="form-control" value="{{old('url')}}">
      </div>
    </div>

    <div class="row mg-t-20">
      <label class="col-sm-4 form-control-label">{{__('Image')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <?php
        $oldpic = old('featured_photo');
        $ddnone = ($oldpic != '') ? 'd-none' : '';
        ?>
        <div class="featured-photo-box {{ $ddnone }}">
          <div class="featured-input hidable border bg-white">
            <input type="file" data-name="featured_photo" class="featured-photo d-none" />
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

    <?php if ($oldpic != '') { ?>
      <div class="row mg-t-20 old-pic">
        <label class="col-sm-4 form-control-label"></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          <div class="featured-photo-box">
            <div class="featured-input position-relative">
              <div class="thumb-preview">
                <img src="{{ old('featured_photo') }}">
                <a href="#" class="close remove-featured-old-photo position-absolute">x</a>
                <input type="hidden" name="featured_photo" value="{{ old('featured_photo') }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

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
      <img src="">
      <a href="#" class="close remove-featured-photo position-absolute">x</a>
      <input type="hidden" name="featured_photo" value="">
    </div>
  </div>
</div>
@endsection