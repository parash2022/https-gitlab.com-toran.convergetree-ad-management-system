@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

<div class="page-head">
<h6 class="br-section-label">{{__('Add page')}}</h6>
<p class="br-section-text">{{__('Lorem ipsum dollor site amet.')}}</p>
</div>

<form method="post" action="{{route('administrator.pages.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="row">

    <div class="col-md-9">
      
     
        <div class="form-group">
          <label class="input-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
          <div class="input-field">
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
          </div>
        </div>

        <div class="form-group">
          <label class="input-label">{{__('Content')}}:</label>
          <div class="input-field">
            <textarea class="editable" name="content"></textarea>
          </div>
        </div>
      
    </div>

    <div class="col-md-3">
     
      <div class="a__sidebar-box a__FI-box mb-3 mt-4">
          <div class="card ">
              <div class="card-header">
                  Featured Image
              </div>
              <div class="card-body">
                 
                      <div class="featured-photo-box">
                          <div class="featured-input hidable border bg-white">
                              <input type="file" name="" id="featured-photo" class="featured-photo d-none" />
                              <a href="#" class=" img-inner-wrapper text-center browse-featured-photo">
                                  <div class="img-inner">
                                      <img src="{{asset('public/assets/images/browse.png')}}" class="center">
                                      <div class="caption-center">Browse</div>
                                  </div>
                              </a>
                          </div>
                      </div>
                 
              </div>
          </div>

      </div>

      <div class="a__sidebar-box a__PA-box  mb-3">
        <div class="card">
        <div class="card-header">
        Page Attributes
          </div>
        <div class="card-body">
           <div class="form-group">
             <label>Parent</label>
             <select class="form-control" name="parent">
               <option value="">No parent</option>
               @if(!$parent->isEmpty())
                 @foreach($parent as $prnt)
                  <option value="{{$prnt->id}}">{{$prnt->title}}</option>
                  @if($prnt->children->count()>0)
                    @foreach($prnt->children as $chld)
                       <option value="{{$chld->id}}">&nbsp;&nbsp;&nbsp;- {{$chld->title}}</option>
                    @endforeach
                  @endif
                  @endforeach
               @endif
             </select>
           </div>
        </div>
      </div>
      </div> 

      <div class="a__sidebar-box a__SV-box mb-3">
          <div class="card">
              <div class="card-header">
                  Publish
              </div>
              <div class="card-body">
                  <div class="a__sidebar-box__inner">
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="Published">{{__('Publish')}}</option>
                              <option value="Draft">{{__('Draft')}}</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <input type="submit" value="Save" class="btn btn-primary">
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div>

  </div>
</form>

<div class="featured-input clonable d-none position-relative">
  <div class="thumb-preview">
    <img  src="">
    <a href="#" class="close remove-featured-photo position-absolute">
        <i class="fas fa-times"></i>
    </a>
    <input type="hidden" name="featured_photo" value="">
  </div>
</div>

@endsection