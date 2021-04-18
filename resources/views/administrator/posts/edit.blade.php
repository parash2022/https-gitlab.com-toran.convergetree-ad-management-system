@extends('administrator.layouts.oreo')
@section('content')

  @include('administrator.notices.flash')
<div class="page-head">
  <h6 class="br-section-label">{{__('Edit post')}}</h6>
  <p class="br-section-text">{{__('Lorem ipsum dollor site amet.')}}</p>
</div>
<form method="post" action="{{route('administrator.posts.update',[$post->id])}}">
  @csrf
  <div class="row">
    <div class="col-md-9">
      <div class="form-group">
        <label class="input-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
        <div class="input-field">
          <input type="text" name="title" class="form-control" value="{{$post->title}}">
        </div>
      </div>
      <div class="form-group">
        <label class="input-label">{{__('Content')}}:</label>
        <div class="input-field">
          <textarea class="editable" name="content">{{$post->content}}</textarea>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      
       <div class="a__sidebar-box a__FI-box mt-4 mb-3">
        <div class="card">
        <div class="card-header">
                  Featured Image
        </div>
        <div class="card-body">
          <div class="featured-photo-box">
            <?php $dnone = '';?>
            @if($post->image && App\Helpers\Thumbnail::exist($post->image))
            <?php $dnone = 'd-none';?>
            <div class="featured-input position-relative">
              <div class="thumb-preview">
                <img  src="{{App\Helpers\Thumbnail::url($post->image,'xx')}}">
                <a href="#" class="close remove-featured-photo position-absolute">x</a>
                <input type="hidden" name="old_featured_photo" value="{{$post->image}}">
              </div>
            </div>
            @endif
            <div class="featured-input {{$dnone}} hidable border bg-white">
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

      @if(is_array($activePostTaxonomies))
        @foreach($activePostTaxonomies as $taxonomy)
         <div class="a__sidebar-box a__TxNm-box a__TxNm-{{$taxonomy->slug}}-box mb-3">
            <div class="card ">
                <div class="card-header">
                    {{$taxonomy->name}}
                </div>
                <div class="card-body">
                @if($taxonomy->terms->count())
                  <ul>
                    @foreach($taxonomy->parentTerms as $parent )
                    <li>
                      <label>
                        <?php $checked = $post->terms->contains($parent->id)?'checked':'';?>
                        <input type="checkbox" {{$checked}} name="term[]" value="{{$parent->id}}"> <span>{{$parent->name}}</span>
                      </label>
                    @if($parent->children->count())
                      <ul>
                        @foreach($parent->children as $children)
                         <li>
                          <label>
                             <?php $checked = $post->terms->contains($children->id)?'checked':'';?>
                            <input type="checkbox" {{$checked}} name="term[]" value="{{$children->id}}"> 
                            <span>{{$children->name}}</span>
                          </label>
                          @if($children->children->count())
                            <ul>
                              @foreach($children->children as $grandchildren)
                              <li>
                                <label>
                                   <?php $checked = $post->terms->contains($grandchildren->id)?'checked':'';?>
                                  <input type="checkbox" {{$checked}} name="term[]" value="{{$grandchildren->id}}"> 
                                  <span>{{$grandchildren->name}}</span>
                                </label>
                              </li>
                              @endforeach
                            </ul>
                          @endif
                        </li>
                        @endforeach
                      </ul>
                    @endif
                    </li>
                    @endforeach
                  </ul>
                @endif                   
                </div>
            </div>
        </div>
        @endforeach
      @endif


        <div class="a__sidebar-box a__SV-box ">
        <div class="card">
        <div class="card-header">
                  Publish
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
              <option value="Published" @if($post->status=='Published') selected @endif >{{__('Publish')}}</option>
              <option value="Draft" @if($post->status=='Draft') selected @endif >{{__('Draft')}}</option>
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
</form>
<div class="featured-input clonable d-none position-relative">
  <div class="thumb-preview">
    <img  src="">
    <a href="#" class="close remove-featured-photo position-absolute">x</a>
    <input type="hidden" name="featured_photo" value="">
  </div>
</div>
@endsection