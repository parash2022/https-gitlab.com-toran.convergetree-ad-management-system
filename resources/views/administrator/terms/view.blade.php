@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

 <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">All {{$taxonomy->name}}</h4>
        </div>
      </div>

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label"><span><a href="{{route('administrator.terms.create',[$taxonomy->slug])}}">Add New</a></span></h6>
        </div>
    </div>
        <div class="content__body">
        @if(!$terms->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($terms as $parent)  
                 @include('administrator.terms.loop.parent')
                 @if($parent->children->count())
                    @foreach($parent->children as $children)
                       @include('administrator.terms.loop.children')
                          @if($children->children->count())
                            @foreach($children->children as $grandchildren)
                               @include('administrator.terms.loop.grandchildren')
                            @endforeach  
                         @endif
                    @endforeach  
                 @endif   
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$terms->render()}}
         </div>
        @else
            <div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
