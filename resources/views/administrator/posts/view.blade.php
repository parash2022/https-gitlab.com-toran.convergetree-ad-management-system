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
            <h6 class="br-section-label">All posts <span><a href="{{route('administrator.posts.create')}}">Add New</a></span></h6>
        </div>
       <!-- <div class="tt__search-area">
           <input type="text" placeholder="search..."><button>Search</button>
        </div> -->
    </div>
        <div class="content__body">
        @if(!$posts->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $row)
                <tr> 
                    <td>{{$row->id}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->status}}</td>
                    
                    <td>
                       <a href="{{route('administrator.posts.edit',[$row->id])}}">Edit</a>
                        <a href="{{route('administrator.posts.delete',[$row->id])}}" class="delete-data">Delete</a>
                        <form class="d-none" method="post" action="{{route('administrator.posts.delete',[$row->id])}}">
                            @csrf
                        </form>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$posts->render()}}
         </div>
        @else
<div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
