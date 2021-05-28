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
?>

<div class="br-pagetitle">
    <div>
        <h4 class="mb-0">All Push Notification</h4>
    </div>
</div>

<div class="br-section-wrapper">

    <div class="content__body">
        @if(!$notices->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-hover mg-b-0">
                <thead>
                    <tr>
                        <th width="20">S.N.</th>
                        <th width="">Title</th>
                        <th width="">Message</th>
                        <th width="">Response</th>
                        <!-- <th width="">Status</th> -->
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notices as $notice)
                    <tr>
                        <th scope="row">{{$sn}}</th>
                        <td>{{$notice->title}}</td>
                        <td>{!! $notice->body !!}</td>
                        <td>{!! $notice->response !!}</td>
                        <!-- <td>{{$notice->status == 1 ? 'success' : 'failed'}}</td> -->
                        <td>{{$notice->created_at->format('Y-m-d')}}</td>
                    </tr>
                    @php
                    $sn++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination__links mt-3">
            {{$notices->render()}}
        </div>
        @else
        <div class="alert alert-warning mb-0">Nothing to display!</div>
        @endif
    </div>

</div>
@endsection