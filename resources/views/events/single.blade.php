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
				
					<div class="single-content">
					
							<div class="top-header span_top">
								
									<div class="logo">
										<a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
										<p>For All Events</p>
									</div>

									<div class="search v-search">
											@guest
										
										<a href="{{ route('login') }}"><button type="button" class="btn btn-default" style="margin-bottom: 15px;">Login</button></a>
										<a href="{{ route('register') }}"><button type="button" class="btn btn-default" style="margin-bottom: 15px;">Register</button></a>
												
											@else
												<a href="{{ route('home') }}"><p>Welcome {{ Auth::user()->name }} <span class="glyphicon glyphicon-envelope"></span></p></a>  
												<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-default" style="margin-bottom: 15px;">Logout</button></a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
												</form>
											@endif 
									
									</div>
									<div class="clearfix"></div>
							</div>
						
							<div class="reviews-section">
								
								<h3 class="head">{{$eventDetails->name }} Full Description</h3>
								<p>Posted on - {{ $eventDetails->created_at->toDayDateTimeString() }}</p>
									
									<div class="col-md-9 reviews-grids">
										
										<div class="review">
											
											<div class="movie-pic">
												<a href="{{ asset($eventDetails->image) }}"><img src="{{ asset($eventDetails->image) }}" alt="" /></a>
											</div>
											
													<div class="review-info">
													
															<h2><a class="span" href="">{{ optional($eventDetails)->name }}</a></h2>
															<br>
															<p><strong>Venue: </strong> {{ optional($eventDetails)->venue }}</p>
															<br>
															<p><strong>Actors: </strong> {{ optional($eventDetails)->actors }}</p>
															<br>
															<p><strong>Time Duration: </strong> {{ optional($eventDetails)->time }}</p>
															<br>
															<p><strong>Date: </strong> {{ optional($eventDetails)->date }} </p>
															<br>
															<p><strong>Age: </strong>{{ optional($eventDetails)->age }}</p>
															<br>
															<p><strong>Tickets: </strong> {{ optional($eventDetails)->ticket }} </p> 
															<br>
															<p><strong>Dress Code: </strong>{{ optional($eventDetails)->dresscode }}</p>
											
															<br>
															<!-- Trigger the modal with a button -->
															<button type="button" class="btn btn-warning" style="margin-bottom: 15px;"> BUY TICKET NOW </button>
													
													</div>
													<div class="clearfix"></div>
										</div>
										
											<div class="single">
											
												<h3>Lorem Ipsum IS A TENSE, TAUT, COMPELLING THRILLER</h3>
												<p>STORY:<i> Meera and Arjun drive down Lorem Ipsum - can they survive a highway from hell?</i></p>
											
											</div>

											<div class="best-review">
												<h4>Event Full Description</h4>
												<p>{{ $eventDetails->description }}</p>
												<p><span>Neeraj Upadhyay (Noida)</span> 16/03/2015 at 12:14 PM</p>
											</div>

											<div class="story-review">
												<h4>PERFORMING ARTISTES:</h4>
												<p>{{ $eventDetails->actors }}</p>
											</div>

										<!-- comments-section-starts -->
										<div class="comments-section">
						
											<div class="comments-section-head">
												
												<div class="comments-section-head-text">
													<?php $noOfcCmments = count($eventcomments); ?>
														<h3>{{ $noOfcCmments }} @if($noOfcCmments > 1) {{str_plural('Comment')}} @else Comment @endif</h3>
												</div>
												<div class="clearfix"></div>
											
											</div>

										<div class="comments-section-grids">
										
												@foreach($eventcomments as $comments)
												@if($comments->status == 1) 
													
														<div class="comments-section-grid">
															
															<div class="col-md-2 comments-section-grid-image">
																<img src="{{ asset('images/frontend_images/eye-brow.jpg') }}" class="img-responsive" alt="" />
															</div>
											
															<div class="col-md-10 comments-section-grid-text">
																<h4><a href="#">{{ optional($comments)->name }}</a></h4>
																<label>{{ optional($comments->created_at)->diffForHumans() }}</label>
																<p>{{ optional($comments)->email }}</p>
																<label>{{ optional($comments)->message }}</label>
																<i class="rply-arrow"></i>
															</div>
															<div class="clearfix"></div>
														
														</div>

												@endif
												@endforeach


										</div>
							</div>

							<!-- comments-section-ends -->
							<div class="reply-section">
								
									<div class="reply-section-head">
									
											<div class="reply-section-head-text">
											
												<h3>Leave A Comment</h3>
												<br><br>
												<!-- displays flash error messages if any -->
													@include('layouts.errors')
												<br>	
											</div>
									
									</div> 
								
									<div class="blog-form">
								
										<form action="{{ url('/add-comment-event') }}" method="post">{{ csrf_field() }}
											<input type="hidden" name="event_id" value="{{ encrypt($eventDetails->id) }}">
											<input type="text" class="text" placeholder="{{ Auth::user() ? Auth::user()->name : 'Enter name' }}" value="" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Name';}" required>
											<input type="text" class="text" placeholder = "{{ Auth::user() ? Auth::user()->email : 'Enter Email' }}" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Email';}" required>
											<textarea name="message" required></textarea>
											<input type="submit" value="SUBMIT COMMENT" class="btn btn-warning">
										</form>
								
									</div>

								</div>
							
							</div>
						
						<div class="col-md-3 side-bar">
							
							<div class="entertainment">
								<h3>Event Blog</h3>
								@foreach($allBlogPosts as $posts)
									@include('layouts.frontLayout.front_entertainment')
								@endforeach
							</div>

							<!---->
							<div class="grid-top">
								<h4>Other Events</h4>
									@include('layouts.frontLayout.front_otherevents')
							</div>
							<!---->

						</div>

						<div class="clearfix"></div>
				
					</div>
			
			</div>				
			
			<div class="review-slider">
				
				<ul id="flexiselDemo1">
					@foreach($eventsimage as $eventimage)
						<li><img src="{{ asset($eventimage->image) }}" alt="{{ $eventimage->description }}"/></li>
					@endforeach
				</ul>
			
				@include('layouts.frontLayout.front_scripts2')	

			</div>	

			<br><br>
			<div class ="container" style="background:#f3f3f3;">
			
				<strong> Categories: </strong>
				@foreach($allCategories as $category)
					<a href="{{ url('category/'.$category->id) }}" style="text-decoration:none;"><span class="label label-warning">{{ $category->name }}</span></a>
				@endforeach
				
				</div>

				@include('layouts.frontLayout.front_footer')		
		
			</div>

			<div class="clearfix"></div>
	
	</div>

@endsection