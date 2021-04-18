@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

 <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">All Roles</h4>
        </div>
      </div>

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label"><span><a href="{{route('administrator.roles.create')}}">Add New</a></span></h6>
        </div>
      
    </div>
        <div class="content__body">
        @if(!$roles->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Users</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($roles as $role)
                <tr> 
                    <th scope="row">{{$role->id}}</th>
                    <td>{{$role->title}}</td>
                    <td>@isset($role->user){{$role->user->count()}}@endisset</td>
                    
                    <td>
                       <a href="{{route('administrator.roles.edit',[$role->id])}}">Edit</a> | 
                        <a href="{{route('administrator.roles.delete',[$role->id])}}" class="delete-data">Delete</a>
                        <form class="d-none" method="post" action="{{route('administrator.roles.delete',[$role->id])}}">
                            @csrf
                        </form>
                    </td>
                </tr>
                @php
                $i++;
                @endphp
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$roles->render()}}
         </div>
        @else
<div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
