@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')
<?php
$perpage = 10;
$page = request()->page ? request()->page : 1;
if ($page > 1) {
    $sn = ($perpage * ($page - 1) + 1);
} else {
    $sn = 1;
}

$today = \Carbon\Carbon::today()->format('Y-m-d');
$defaultDate = \Carbon\Carbon::now();
$plus7Days = $defaultDate->addDays(7)->format('Y-m-d');
?>
<div class="br-pagetitle">
    <div>
        <h4 class="mb-0">All Ads</h4>
    </div>
</div>

<div class="br-section-wrapper">
    <div class="table-top">
        <form action="{{route('administrator.ads.index')}}" method="get">
            <div class="tt__title-area">
                <div class="row mg-b-20">
                    <div class="col-md-1">
                        <h6 class="br-section-label"><span><a href="{{route('administrator.ads.create')}}">Add New</a></span></h6>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-2">
                        <select name="platform" class="form-control">
                            <option value="">Select Platform</option>
                            @if(!$platforms->isEmpty())
                            @foreach($platforms as $plt)
                            <option value="{{$plt->id}}" @if(request()->platform == $plt->id) selected @endif>{{$plt->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="client" class="form-control">
                            <option value="client">Select Client</option>
                            @if(!$clients->isEmpty())
                            @foreach($clients as $clt)
                            <option value="{{$clt->id}}" @if(request()->client == $clt->id) selected @endif >{{$clt->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-control">
                            <option value="">Select Category</option>
                            @if(!$categories->isEmpty())
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}" @if(request()->category == $cat->id) selected @endif>{{$cat->name}}</option>
                            @if($cat->children->count()>0)
                            @foreach($cat->children as $child)
                            <option value="{{$child->id}}" @if(request()->category == $child->id) selected @endif>&nbsp;&nbsp;— {{$child->name}}</option>
                            @endforeach
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="running" @if(request()->status == 'running') selected @endif>Running</option>
                            <option value="scheduled" @if(request()->status == 'scheduled') selected @endif>Scheduled</option>
                            <option value="going-to-expire" @if(request()->status == 'going-to-expire') selected @endif>Going to expire</option>
                            <option value="expired" @if(request()->status == 'expired') selected @endif>Expired</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="content__body">
        @if(!$ads->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-hover mg-b-0">
                <thead>
                    <tr>
                        <th width="20">S.N.</th>
                        <th width="50">Platform</th>
                        <th width="20%">Preview</th>
                        <th>Name</th>
                        <!-- <th>Ad Type</th> -->
                        <th>Cats</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $ad)
                    <tr>
                        <th width="20">{{$sn}}</th>
                        <td width="50">
                            @isset($ad->platform->name)
                            <img src="{{asset('img/'.$ad->platform->name)}}.png" width="32">
                            @endisset
                        </td>
                        <td width="">
                            @if($ad->image && App\Helpers\Thumbnail::exist($ad->image))
                            <img src="{{App\Helpers\Thumbnail::url($ad->image)}}" style="width: 100%;height: auto;">
                            @endif
                        </td>
                        <td>{{$ad->title}}</td>
                        <!-- <td>@isset($ad->adtype->name) {{$ad->adtype->name}} @endisset</td> -->
                        <td>
                            @isset($ad->categories)
                            @foreach($ad->categories as $cat)
                            @isset($cat->name)
                            <p>{{$cat->name}}</p>
                            @endisset
                            @endforeach
                            @endisset
                        </td>
                        <td>
                            @if($ad->publish_date->lte($today) && $ad->expiry->gte($today))
                            <span class="btn btn-success">Running</span>
                            @elseif($ad->publish_date->gte($today))
                            <span class="btn btn-info">Scheduled</span>
                            @elseif($ad->expiry->lte($today))
                            <span class="btn btn-danger">Expired</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('administrator.ads.copy',['id'=>$ad->id])}}" onclick="return confirm('Are you sure?')">Copy</a> |
                            <a href="{{route('administrator.ads.edit',[$ad->id])}}">Edit</a> |
                            <a href="{{route('administrator.ads.delete',[$ad->id])}}" class="delete-data">Delete</a>
                            <form class="d-none" method="post" action="{{route('administrator.ads.delete',[$ad->id])}}">
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
            {{$ads->render()}}
        </div>
        @else
        <div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>

</div>
@endsection