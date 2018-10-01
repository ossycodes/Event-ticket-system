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

					<div class="review-content">

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
								
								<h3 class="head">Latest Events Happening</h3>
									
													<div class="col-md-9 reviews-grids">
													
														<?php 
															$noOfEvents = count($noofevents);
															//echo $noOfReviews; die;
														?>

															@if($noOfEvents)
																	
																	@foreach($events as $event)

																		<div class="review">
																				
																				<div class="movie-pic">
																					<a href="{{ url('/events/'.$event->id) }}"><img src="{{ asset($event->image) }}" alt="" style = "width:70%; height:100%;"/></a>
																				</div>
											
																				<div class="review-info">
																					
																					<a class="span" href="{{ url('/events/'.$event->id) }}">{{ $event->name }}</a>
																					<br>

																					<?php
																						//me just testing the transform() helper method
																						$res = transform(null, function($value){
																							return $value * 2;
																						}, 'gets return if value is returns null');
																				
																					?>
																						
																					<p class="">VENUE:&nbsp; {{ $event->venue ?? 'Venue was not provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																					<p class="">DATE:&nbsp; {{ $event->date ?? 'No date was set' }} {{-- ?? php 7 null coalesce operator --}}</p>
																					<p class="">DURATION:&nbsp; {{ $event->time ?? 'No time was set' }} {{-- ?? php 7 null coalesce operator --}}</p>
																	
																					<br>
																					<!-- Trigger the modal with a button -->
																					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{ $event->id }}" style="margin-bottom: 15px;">More Details</button>
																					
																					<a href="@guest{{ url('login') }}@else {{ url('/events/'.$event->id) }} @endif"><button type="button" class="btn btn-danger" style="margin-bottom: 15px;">Book Ticket</button></a>

																					<!-- Modal -->
																					<div id="myModal{{ $event->id }}" class="modal fade" role="dialog">
																					
																						<div class="modal-dialog">

																								<!-- Modal content-->
																								<div class="modal-content">
																								
																									<div class="modal-header">
																										<button type="button" class="close" data-dismiss="modal">&times;</button>
																										<h4 class="modal-title">{{ $event->name }}</h4>
																									</div>

																									<div class="modal-body">
																										<p><strong>Description: </strong> {{ $event->description ?? 'No description provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Venue: </strong> {{ $event->venue ?? 'No venue provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Actors: </strong> {{ $event->actors ?? 'No actors provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Time Duration: </strong> {{ $event->time ?? 'No time provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Date: </strong> {{ $event->date ?? 'No date provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Age: </strong>{{ $event->age ?? 'No age provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Tickets: </strong> {{ $event->ticket ?? 'No ticket category given' }} {{-- ?? php 7 null coalesce operator --}}</p> 
																										<br>
																										<p><strong>Dress Code: </strong>{{ $event->dresscode ?? 'No dresscode provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
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
																				<h1>Oops! No Events At the Moment</h1> 
																			</div>
																		</div>

															@endif

															@if($noOfEvents)
																<div class="pagenation">
																	{{ $events->render() }}
																</div>
															@else

															@endif`
													
													
													</div>
								
									

													<div class="col-md-3 side-bar">
													
																<div class="entertainment">
																	<h3>Event Blog</h3>
																	@foreach($allBlogPosts1 as $event)
																		@include('layouts.frontLayout.front_entertainment2')
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
								<li><img src="{{ asset($eventimage->image) }}" alt="{{ $eventimage->image }}"/></li>
							@endforeach
						</ul>

        @include('layouts.frontLayout.front_scripts2')
					</div>
					
		<!--Displays all the categories available-->
		@include('layouts.frontLayout.front_categories')
		
		@include('layouts.frontLayout.front_footer')


			</div>
			
			<div class="clearfix"></div>
		
	</div>

@endsection