@if(Session::has('trn_error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{!! session('trn_error') !!}</strong>
</div>
@endif

@if(Session::has('trn_failed'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{!! session('trn_success') !!}</strong>
</div>
@endif


@if(Session::has('trn_success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{!! session('trn_success') !!}</strong>
</div>
@endif