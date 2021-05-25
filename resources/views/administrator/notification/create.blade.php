@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')



<div class="br-pagetitle">
    <div>
        <h4 class="mb-0">Push Notification</h4>
    </div>
</div>

<div class="br-section-wrapper">

    <form method="post" action="{{route('administrator.notification.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-inner">
            <h6 class="br-section-label">{{__('Push New Notification')}}</h6>


            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">{{__('Title')}}:<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">{{__('Message')}}:<span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <textarea class="editable" rows="2" cols="80" name="message"></textarea>
                </div>
            </div>

            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">{{__('Slug')}}:</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="slug" class="form-control" value="{{old('slug')}}">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="input-label">{{__('Message')}}:<span class="tx-danger">*</span></label>
                <div class="input-field">
                    <textarea class="editable" name="message"></textarea>
                </div>
            </div> -->

            <div class="form-layout-footer mg-t-30">
                <button class="btn btn-primary">{{__('Push')}}</button>
            </div>
        </div>
    </form>
</div>



@endsection