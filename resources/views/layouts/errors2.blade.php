<!-- displays flash success messages if any -->
@if( Session::has('subscriptionsuccess') )
    <div class="alert alert-success">
    {{ Session('subscriptionsuccess') }}
    </div>
@endif
					
<!-- displays flash error messages if any -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
</div>
@endif