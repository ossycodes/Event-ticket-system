<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
@extends('layouts.frontLayout.front_design')

<link href="{{ asset('css/frontend_css/style2.css') }}" rel="stylesheet" type="text/css" media="all" />

@section('content')

<div class = "full">
	<!-- header-section-starts -->

    @include('layouts.frontLayout.front_menu')

<div class ="main">
	
	 @include('layouts.frontLayout.front_mainheader2')	
	
			<div class="right-content">
				
				<div class="about-grids">
					
					<div class="col-md-6 about-grid">
						<h3>Who We Are</h3>
						<img src="{{ asset('images/frontend_images/a1.jpg') }}" alt="" />
						<h4>Donec elit enim, egestas sed malesuada et ornare et lectus</h4>
						<p>Sed ut luctus nibh, non faucibus massa. Mauris aliquam odio quis nisi volutpat, a malesuada enim 
							interdum. Praesent at leo nec purus viverra lobortis. Vestibulum eget eros semper, tempus massa 
							nec, iaculis dolor.<span>Donec dapibus risus quis cursus fringilla. Quisque finibus porttitor ligula, 
							ut sagittis ipsum. Donec sit amet purus euismod tellus dapibus aliquet.</span>
						</p>
					</div>

					<div class="col-md-6 about-grid">
						<h3>We Offer</h3>
						<h4>Donec elit enim, egestas sed malesuada et ornare et lectus</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue tellus ut lacinia ullamcorper. 
							Aliquam ultrices suscipit blandit. Sed in libero ipsum. Quisque efficitur aliquam neque, vel venenatis 
							tellus placerat quis. Etiam molestie tellus at urna blandit, vel porta ipsum auctor. 
						</p>
						<ul>
							<li>Proin elementum ultrices sapien</li>
							<li>Lorem ipsum dolor sit amet</li>
							<li>Quisque efficitur aliquam neque</li>
							<li>Praesent ultricies varius aliquam</li>
							<li>Nullam nisl velit hendrerit quis </li>
							<li>Sed ut luctus nibhnon faucibus massa</li>
						</ul>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue tellus ut lacinia ullamcorper. 
							Aliquam ultrices suscipit blandit. Sed in libero ipsum. Quisque efficitur aliquam neque, vel venenatis 
							tellus placerat quis. 
						</p>
					</div>

					<div class="clearfix"> </div>
				
				</div>
				
			</div>

			<div class="clearfix"> </div>
		</div>	
	
	@include('layouts.frontLayout.front_footer')

</div>	
	<div class="clearfix"></div>
</div>

@endsection