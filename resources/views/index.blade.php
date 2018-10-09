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
				
			@include('layouts.frontLayout.front_mainheader')
			
			<!--@foreach($backgroundInfo as $info)	
				@include('layouts.frontLayout.front_header')
			@endforeach-->
		
				<div class="review-slider">
					
					<ul id="flexiselDemo1">
					
						@foreach($noofeventsimages as $image)
							<li><img src="{{ asset($image->image) }}" alt="{{ $image->name }}"/></li>
						@endforeach
						
					</ul>

					@include('layouts.frontLayout.front_scripts2')	
				
				</div>
		
				<div class="news">
				
						<div class="col-md-6 news-left-grid">
							
							<h3>Don’t be late,</h3>
							<h2>Book your ticket now!</h2>
							<h4>Easy, simple & fast.</h4>
							<a href="{{ url('events') }}"><i class="book"></i>BOOK TICKET</a>
							<!--<p>Get Discount up to <strong>10%</strong> if you are a member!</p>-->

								<div class="contact-form">
					
									<form action="{{ url('/newsletter') }}" method="post">{{ csrf_field() }}
									
										@include('layouts.errors2')
									
										<p>Subscribe <strong>to</strong> our Newsletter </p>		
										<input type="email" placeholder="{{ Auth::user() ? Auth::user()->email :  'Enter your E-mail' }}" name="email" class="form-control" required/>
										<br>
										<input type="submit" value="Subscribe" class="btn btn-warning"/>
										<div class="clearfix"></div>
								
									</form>
									
					
								</div>	

						</div>
				
				

					
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
					@foreach($noofeventsimages as $image)
						<li><img src="{{ asset($image->image) }}" alt=""/></li>
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