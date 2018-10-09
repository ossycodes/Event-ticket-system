<!-- displays flash success messages if any -->
@if( Session::has('subscriptionsuccess') )
    <div class="alert alert-success">
    {{ Session('subscriptionsuccess') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{!! session('error') !!}</strong>
    </div>
@endif 

@if(Session::has('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{!! session('success') !!}</strong>
    </div>
@endif
					
<!-- displays flash error messages if any -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {!! $error !!}
            </li>
        @endforeach
    </ul>
</div>
@endif