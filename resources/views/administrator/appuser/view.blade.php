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
        <h4 class="mb-0">All App User</h4>
    </div>
</div>

<div class="br-section-wrapper">

    <div class="content__body">
        @if(!$users->isEmpty())
        <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-hover mg-b-0">
                <thead>
                    <tr>
                        <th width="20">S.N.</th>
                        <th width="">Token ID</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$sn}}</th>
                        <td>{{$user->deviceID}}</td>
                        <td>{{$user->created_at->format('Y-m-d H:i:s')}}</td>
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