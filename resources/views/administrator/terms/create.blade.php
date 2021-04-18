@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')
   <div class="br-pagetitle">
        <div>
          <h4 class="mb-0">Add Term</h4>
        </div>
      </div>

  <div class="br-section-wrapper">
<form method="post" action="{{route('administrator.terms.store',[$taxonomy->slug])}}">
  @csrf
  <div class="form-inner">
     <div class="row mg-b-20">
      <label class="col-sm-4 form-control-label">{{__('Parent')}}:</label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
       <select name="parent" class="form-control">
         <option value="">No Parent</option>
         @if(!$parent->isEmpty())
           @foreach($parent as $prnt)
            <option value="{{$prnt->id}}">{{$prnt->name}}</option>
            @if($prnt->children->count()>0)
              @foreach($prnt->children as $chld)
                 <option value="{{$chld->id}}">&nbsp;&nbsp;&nbsp; — {{$chld->name}}</option>
              @endforeach
            @endif
            @endforeach
         @endif
       </select>
      </div>
    </div><!-- row -->

    <div class="row">
      <label class="col-sm-4 form-control-label">{{__('Name')}}:<span class="tx-danger">*</span></label>
      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
      </div>
    </div><!-- row -->

    <div class="form-layout-footer mg-t-30">
      <button class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </div>
</form>
</div>
@endsection