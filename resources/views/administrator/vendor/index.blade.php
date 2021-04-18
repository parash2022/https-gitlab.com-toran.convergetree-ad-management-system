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
<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area mb-4">
            <form>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="br-section-label">All vendors</h6>
                </div>
                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Keyword" value="{{request()->keyword}}">
                </div>
                <div class="col-md-3">
                   <select name="category" class="form-control">
                       <option value="">Select Category</option>
                       @if(!$categories->isEmpty())
                        @foreach($categories as $parent)
                            <option value="{{$parent->id}}" @if(request()->category==$parent->id) selected @endif>{{$parent->name}}</option>
                             @if($parent->children->count())
                                 @foreach($parent->children as $children)
                                    <option value="{{$children->id}}" @if(request()->category==$children->id) selected @endif>&nbsp;&nbsp; — {{$children->name}}</option>
                                 @endforeach
                             @endif
                        @endforeach
                       @endif
                   </select>
                </div>
                <div class="col-md-2">
                   <input type="submit" class="btn btn-primary" value="Search">
                </div>
            </div>
        </form>
        </div>
       <!-- <div class="tt__search-area">
           <input type="text" placeholder="search..."><button>Search</button>
        </div> -->
    </div>
        <div class="content__body">
        @if(!$vendors->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Reg date</th>
                     <th>Name</th>
                    <th>Category</th>
                    <th>Contact</th>
                    <th>Experience</th>
                    <th>Clients</th>
                    <th>Weight</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($vendors as $user)
                <tr> 
                    <td scope="row">{{$sn}}</td>
                    <td>{{$user->created_at->format('d M, Y')}}</td>
                    <td scope="row">
                        @isset($user->vendorProfile->name)
                        {{$user->vendorProfile->name}}
                        @endif
                    </td>
                    <td>
                        @isset($user->terms)
                            @if(!$user->terms->isEmpty())
                                @foreach($user->terms as $term)
                                <p>{{$term->name}}</p>
                                @endforeach
                            @endif
                        @endif
                    </td>
                    <td>
                        @isset($user->vendorContact)
                        <p>{{$user->vendorContact->name}}</p>
                        <p>{{$user->vendorContact->mobile}}</p>
                        <p>{{$user->vendorContact->email}}</p>
                        @endisset
                    </td>
                    <td>
                        @isset($user->vendorProfile)
                        {{$user->vendorProfile->no_of_experience_years}} years
                        @endif
                    </td>
                    <td>
                         @isset($user->vendorProfile)
                        {{$user->vendorProfile->no_of_clients}}
                        @endif
                    </td>
                     <td>
                        @isset($user->vendorProfile)
                        {{$user->vendorProfile->points}}
                        @endif
                    </td> 
                    <td>
                        <a href="{{route('administrator.vendors.view',[$user->id])}}"><i class="fa fa-eye"></i></a> | 
                        <a href="{{route('administrator.vendors.download',[$user->id])}}"><i class="fa fa-download"></i></a>
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
             {{$vendors->render()}}
         </div>
        @else
            <div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>
   
</div>
@endsection
