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
          <h4 class="mb-0">All Clients</h4>
        </div>
      </div>

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area">
            <h6 class="br-section-label"><span><a href="{{route('administrator.clients.create')}}">Add New</a></span></h6>
        </div>
    </div>
        <div class="content__body">
        @if(!$clients->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr> 
                    <th scope="row">{{$sn}}</th>
                    <td>{{$client->name}}</td>
                    <td>
                        <a href="{{route('administrator.clients.edit',[$client->id])}}">Edit</a> | 
                        <a href="{{route('administrator.clients.delete',[$client->id])}}" class="delete-data">Delete</a>
                        <form class="d-none" method="post" action="{{route('administrator.clients.delete',[$client->id])}}">
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
             {{$clients->render()}}
         </div>
        @else
<div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
