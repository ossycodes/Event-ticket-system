@if ($errors->any())
<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: #000;
                            font-size: 1.2em;
                            word-spacing: 2px;
                            letter-spacing: 1.3px;
                            font-weight: 600;
                            text-transform: lowercase;
                            margin-top: 20px;
                            margin-left: 15px;">
                    {{ $error }}
                 </li>
            @endforeach
        </ul>
    </div>
    @endif

<!-- displays flash session success message -->

@if( Session::has('success'))
    <div class="alert alert-success" style="color: #000;
                            font-size: 1.2em;
                            word-spacing: 2px;
                            letter-spacing: 1.3px;
                            font-weight: 600;
                            text-transform: lowercase;
                            margin-top: 20px;
                            margin-left: 15px;">
    <p>{{ session('success') }}</p>
    </div>
@endif