@extends('layouts.frontLayout.front_design')

@section('content')

	<!-- header-section-starts -->
	<div class="full">
	
			@include('layouts.frontLayout.front_menu')
				
			@include('layouts.frontLayout.front_mainheader')
			
				<div class="review-slider">
					
					<ul id="flexiselDemo1">
					
						@foreach($eventSliderImages as $image)
							<li><img src="{{ asset($image->slider_imagename) }}" alt="{{ $image->slider_imagename }}"/></li>
						@endforeach
						
					</ul>

					@include('layouts.frontLayout.front_scripts2')	
				
				</div>
		
				<div class="news">
				
						<div class="col-md-6 news-left-grid">
							
							<h3>Don’t be late,</h3>
							<h2>Book your ticket now!</h2>
							<h4>Easy, simple & fast.</h4>
							<a href="{{ route('search.events') }}"><i class="eye"></i>SEARCH FOR EVENTS</a>
							<br><br><br>
							<a href="{{ url('events') }}"><i class="book"></i>BOOK TICKET</a>
						
							<div id="app">
								<div class="contact-form">
									<vue-newsletter-component></vue-newsletter-component>
								</div>	
							</div>
						
						</div>
				
						{{-- newsletter vue component --}}
						<vue-newsletter-component></vue-newsletter-component>

					
						<div class="col-md-6 news-right-grid">
							
							<h3> Upcoming Events/Parties </h3>
								<?php
									$noOfevents = count($events);
									//echo $noOfevents; die; 
								?>

									@if($noOfevents)
										@foreach($events as $event)
											<div class="news-grid">

												<h5>{{ optional($event)->name }}</h5>
												<label>{{ optional($event)->date }}</label>
												<p>{{ str_limit($event->description, 150) }}</p>
												<br>
												<a href="{{ route('events') }}"><button type="button" class="btn btn-default">More Details</button></a>
											
											</div>
										@endforeach		
								
							<a class="more" href="{{ route('events') }}">MORE</a>		
							@else
							<h5>No Upcoming Events/Parties At The Moment.</h5>
							@endif
						
						</div>
					

						<div class="clearfix"></div>
			
				</div>
		
				<div class="more-reviews">
				
					<ul id="flexiselDemo2">
						@foreach($eventSliderImages as $image)
							<li><img src="{{ asset($image->slider_imagename) }}" alt="{{ $image->slider_imagename }}"/></li>
						@endforeach
					</ul>
					
					@include('layouts.frontLayout.front_scripts')	
				
				</div>	

			<!--Displays all the categories available-->
			@include('layouts.frontLayout.front_categories')	
	
			@include('layouts.frontLayout.front_footer')
	

	</div>
	
	<div class="clearfix"></div>

@endsection