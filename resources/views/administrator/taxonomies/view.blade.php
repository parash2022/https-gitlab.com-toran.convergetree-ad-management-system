@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label">All Taxonomies <span><a href="{{route('administrator.taxonomies.create')}}">Add New</a></span></h6>
        </div>
       <!-- <div class="tt__search-area">
           <input type="text" placeholder="search..."><button>Search</button>
        </div> -->
    </div>
        <div class="content__body">
        @if(!$taxonomies->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Terms</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxonomies as $taxonomy)
                <tr> 
                    <th scope="row">{{$taxonomy->id}}</th>
                    <td>{{$taxonomy->name}}</td>  
                    <td> 
                        @if($taxonomy->terms->count()) 
                       <a href="{{route('administrator.terms.index',['taxonomy'=>$taxonomy->slug])}}"> {{$taxonomy->terms->count()}} </a>
                        @else
                        <a href="{{route('administrator.terms.create',['taxonomy'=>$taxonomy->slug])}}">{{__('Add new')}}</a>
                        @endif

                    </td>                  
                    <td>
                       <a href="{{route('administrator.taxonomies.edit',[$taxonomy->id])}}">Edit</a>
                        <a href="{{route('administrator.taxonomies.delete',[$taxonomy->id])}}" class="delete-data">Delete</a>
                        <form class="d-none" method="post" action="{{route('administrator.taxonomies.delete',[$taxonomy->id])}}">
                            @csrf
                        </form>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$taxonomies->render()}}
         </div>
        @else
            <div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
