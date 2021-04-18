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