@extends('administrator.layouts.oreo')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  <h4>{{__('Please correct following error(s) and try again')}}</h4>
  <ul class="mb-0">
    @foreach ($errors->all() as $err)
    <li>{{ $err }}</li>
    @endforeach
  </ul>
</div>
@endif

@if ($alert = Session::get('alert'))
<div class="alert alert-{{ $alert['class']}}">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $alert['msg']}}</strong>
</div>
@endif

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label">All pages <span><a href="{{route('administrator.pages.create')}}">Add New</a></span></h6>
        </div>
       <!-- <div class="tt__search-area">
           <input type="text" placeholder="search..."><button>Search</button>
        </div> -->
    </div>
        <div class="content__body">
        @if(!$pages->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th width="50">ID</th> 
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($pages as $parent)  
                 @include('administrator.pages.loop.parent')
                 @if($parent->children->count())
                    @foreach($parent->children as $children)
                       @include('administrator.pages.loop.children')
                          @if($children->children->count())
                            @foreach($children->children as $grandchildren)
                               @include('administrator.pages.loop.grandchildren')
                            @endforeach  
                         @endif
                    @endforeach  
                 @endif   
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$pages->render()}}
         </div>
        @else
<div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
