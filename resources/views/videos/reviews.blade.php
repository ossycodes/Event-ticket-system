<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Cinema A Entertainment Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
<link href="{{ asset('css/frontend_css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{ asset('css/frontend_css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="{{ asset('js/frontend_js/jquery.min.js') }}"></script>
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
		<div class="review-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="index.html"><img src="images/logo.png" alt="" /></a>
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
			
            <div class="reviews-section">
				<h3 class="head">Latest Events Happening</h3>
					
                    <div class="col-md-9 reviews-grids">
					  <?php 
						 $noOfReviews = count($reviews);
						 //echo $noOfReviews; die;
					  ?>

					  @if($noOfReviews)
                        @foreach($reviews as $review)
                            <div class="review">
                                <div class="movie-pic">
                                    <a href="single.html"><img src="{{ asset('images/frontend_images/r4.jpg') }}" alt="" style = "width:70%; height:100%;"/></a>
                                </div>

    
                                <div class="review-info">
                                    <a class="span" href="single.html">Event name goes in here</a>
                                    
									<br>
                                    <h3>{{ $review->customersname }}</h3>
                                                   
                                    <p class="">LOCATION:&nbsp; iKEJA NO 33 VORTEX LOUGE</p>
                                    <p class="">DURATION:&nbsp; 1 hour 45 minutes</p>
                      
                                    <br>
									<!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{ $review->id }}" style="margin-bottom: 15px;">More Details</button>
                                    
									<button type="button" class="btn btn-danger" style="margin-bottom: 15px;">Book Ticket</button>

										<!-- Modal -->
										<div id="myModal{{ $review->id }}" class="modal fade" role="dialog">
										  <div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">{{ $review->customersname }}</h4>
												</div>
												<div class="modal-body">
													<p><strong>Description: </strong> Description goes in here</p>
													<br>
													<p><strong>Actors: </strong> Actors goes in here</p>
													<br>
													<p><strong>Time Duration: </strong> Time duration goes in here</p>
													<br>
													<p><strong>Date: </strong> Date goes in here</p>
													<br>
													<p><strong>Age: </strong> Age goes in here</p>
													<br>
													<p><strong>Tickets: </strong> Ticket status goes in here</p>
													<br>
													<p><strong>Dress Code: </strong> Dress code goes in here</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
												</div>

										  </div>
										</div>
									
                               
                                </div>
                    
                                
                                <div class="clearfix"></div>
                                
                            </div>
                            
                        @endforeach
						@else
							<div class="">
								<div class="jumbotron">
									<h1>Oops! No Reviews At the Moment</h1> 
								</div>
							</div>
						@endif

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
				
                    
                    </div>
                  
                    

					<div class="col-md-3 side-bar">
				
				<div class="entertainment">
					<h3>Featured Today in Entertainment</h3>
					@foreach($reviews as $review)
						@include('layouts.frontLayout.front_entertainment')
					@endforeach
				</div>	
				
						
					<!---->
				<div class="grid-top">
				    <h4>Archives</h4>
						<ul>
							<li><a href="single.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></li>
							<li><a href="single.html">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</a></li>
							<li><a href="single.html">When an unknown printer took a galley of type and scrambled it to make a type specimen book. </a> </li>
							<li><a href="single.html">It has survived not only five centuries, but also the leap into electronic typesetting</a> </li>
							<li><a href="single.html">Remaining essentially unchanged. It was popularised in the 1960s with the release of </a> </li>
							<li><a href="single.html">Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing </a> </li>
							<li><a href="single.html">Software like Aldus PageMaker including versionsof Lorem Ipsum.</a> </li>
						</ul>
				</div>
				<!---->

				</div>

					<div class="clearfix"></div>
			</div>

			</div>
		
		<div class="review-slider">
			 <ul id="flexiselDemo1">
            @foreach($reviews as $review)
				<li><img src="{{ asset('images/frontend_images/r1.jpg') }}" alt="{{ $review->customersname }}"/></li>
			@endforeach
		</ul>
			<script type="text/javascript">
		$(window).load(function() {
			
		  $("#flexiselDemo1").flexisel({
				visibleItems: 6,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: false,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 2
					}, 
					landscape: { 
						changePoint:640,
						visibleItems: 3
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			});
		</script>
		<script type="text/javascript" src="{{ asset('js/frontend_js/jquery.flexisel.js') }}"></script>	
		<script type="text/javascript" src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>	
		</div>		
	
        @include('layouts.frontLayout.front_footer')	
	
    </div>
	<div class="clearfix"></div>
	</div>

</body>
</html>