<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
@extends('layouts.frontLayout.front_design')

@section('content')

	<!-- header-section-starts -->
	<div class="full">
			@include('layouts.frontLayout.front_menu')
		<div class="main">

            <div class="error-content">
                <div class="top-header span_top">
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
                        <p>For All Events</p>
                    </div>
                    <div class="search v-search">
                        <form>
                            <input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="error-404 text-center">
                    <h2>404</h2>
                    <p>Sorry this was unexpected</p>
                    <a class="b-home" href="{{ url('/') }}">Back to Home</a>
                </div>	
	
    @include('layouts.frontLayout.front_footer')

	</div>
	<div class="clearfix"></div>
	</div>

@endsection