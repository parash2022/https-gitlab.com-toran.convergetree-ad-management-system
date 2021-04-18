@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')
<?php 
$perpage = 10;
$page = request()->page?request()->page:1;
if($page>1){
    $sn = ($perpage * ($page-1) + 1);
}else{
    $sn = 1;
}
?>

 <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">All Users</h4>
        </div>
      </div>

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label"><span><a href="{{route('administrator.users.create')}}">Add New</a></span></h6>
        </div>
      
    </div>
        <div class="content__body">
        @if(!$users->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Verified at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr> 
                    <th scope="row">{{$sn}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@if(isset($user->role[0]->title)){{$user->role[0]->title}} @endif</td>
                    <td>@if($user->email_verified_at){{$user->email_verified_at->format('j F, Y')}}@endif</td>
                    <td>
                        <a href="{{route('administrator.users.edit',[$user->id])}}">Edit</a> | 
                        <a href="{{route('administrator.users.delete',[$user->id])}}" class="delete-data">Delete</a>
                        <form class="d-none" method="post" action="{{route('administrator.users.delete',[$user->id])}}">
                            @csrf
                        </form>
                    </td>
                </tr>
                @php
                $sn++;
                @endphp
               @endforeach
            </tbody>
        </table>
         </div>
          <div class="pagination__links mt-3">
             {{$users->render()}}
         </div>
        @else
<div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
