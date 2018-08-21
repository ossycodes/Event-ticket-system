<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Cinema A Entertainment Category Flat Bootstarp Resposive Website Template | Videos :: w3layouts</title>
<link href="{{ asset('css/frontend_css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{ asset('css/frontend_css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="{{ asset('css/frontend_js/jquery.min.js') }}"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- header-section-starts -->
	<div class="full">
			
	@include('layouts.frontLayout.front_menu')

		<div class="main">
		<div class="video-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
					<p>Movie Theater</p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="right-content">
				<div class="right-content-heading">
					<div class="right-content-heading-left">
						<h3 class="head">Latest Colletcion of Movies</h3>
					</div>
				</div>
				<!-- pop-up-box --> 
		<link href="{{ asset('css/frontend_css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all" />
		<script src="{{ asset('js/frontend_js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
		 <script>
				$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
				});
				});
		</script>		

		<!--//pop-up-box -->

				<div class="content-grids">
				<?php 
					//count no of videos available
					$noOfVideos = count($videos);
				?>
				   @if($noOfVideos)
					@foreach($videos as $video)

					<div class="content-grid">
						<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="{{ asset('images/frontend_images/gridallbum1.jpg') }}" title="allbum-name" /></a>
						<h3>{{ $video->customersname }} hkkgkjhkjj</h3>
						<ul>
							<li><a href="#"><img src="{{ asset('images/frontend_images/likes.png') }}" title="image-name" /></a></li>
							<li><a href="#"><img src="{{ asset('images/frontend_images/views.png') }}" title="image-name" /></a></li>
							<li><a href="#"><img src="{{ asset('images/frontend_images/link.png') }}" title="image-name" /></a></li>
						</ul>
						<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Watch Trailer</a>
					</div>
					<div id="small-dialog" class="mfp-hide last-grid">
						<iframe  src="https://www.youtube.com/embed/2LqzF5WauAw" frameborder="0" allowfullscreen></iframe>
					</div>


					@endforeach
					 
					 @else 
					<div class="container">
						<div class="jumbotron">
							<h1>Oops! No Movies At the Moment</h1> 
						</div>
					</div>
				    @endif


					<div class="clearfix"> 

					 </div>
					
					<br><br>
				
				@if($noOfVideos)
					<div class="pagenation">
						<ul>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				@else	

				@endif
			  
					
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>	
	
			@include('layouts.frontLayout.front_footer')

	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>