E@extends('layouts.frontLayout.front_design')

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

								@include('layouts.errors3')
								
								<h3 class="head">{{ optional($eventDetails)->name ?? 'No description provided' }} Full Description</h3>
								<br>
								<p>Posted on - {{ optional($eventDetails)->created_at->toDayDateTimeString() ?? 'No date provided' }}</p>
								<br>
								@inject('redisService', 'App\Services\RedisService')
								
								<p>Views - {{ $redisService->countNoOfEventPageViews($eventDetails->id) }} </p>
									
								
									<div class="col-md-9 reviews-grids">
										
										<div class="review">
											
											<div class="movie-pic">
												<a href="{{ asset($eventDetails->image) }}"><img src="{{ asset($eventDetails->image) }}" alt="" /></a>
											</div>
											
													<div class="review-info">
														
															<p><strong>Venue: </strong> {{ optional($eventDetails)->venue }}</p>
															<br>
															<p><strong>Actors: </strong> {{ optional($eventDetails)->actors }}</p>
															<br>
															<p><strong>Time: </strong> {{ optional($eventDetails)->time }}</p>
															<br>
															<p><strong>Date: </strong> {{ optional($eventDetails)->date }} </p>
															<br>
															<p><strong>Age: </strong>{{ optional($eventDetails)->age }}</p>
															<br>
															<p><strong>Dress Code: </strong>{{ optional($eventDetails)->dresscode }}</p>
															<br>
															<!-- Trigger the modal with a button -->
															@auth
															<button type="button" class="btn btn-warning" style="margin-bottom: 15px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> @if($noOfTickets > 0) BUY TICKET NOW @else EVENT IS FREE @endif </button>
															@endauth
													</div>
													<div class="clearfix"></div>
										</div>
										
											<div class="best-review">
												<h4>Event Full Description</h4>
												<p>{{ optional($eventDetails)->description ?? 'No description provided' }}</p>
												<p><span>Posted on </span> {{ optional($eventDetails)->created_at->toDayDateTimeString() ?? 'No date provided' }} </p>
											</div>

											<div class="story-review">
													<h4>Available Tickets</h4>
													  @foreach($eventDetails->tickets as $ticket)
														<strong><p> {{ $ticket->tickettype.' ' ?? 'Ticket type not provided' }} : {{ is_numeric($ticket->price) ? $ticket->price.' '.'Naira' : 'Free' }}</p></strong>
													  @endforeach
											</div>

											<div class="story-review">
												<h4>PERFORMING ARTISTES:</h4>
												<p>{{ optional($eventDetails)->actors ?? 'no performing artiste(s) provided' }}</p>
											</div>

										<!-- comments-section-starts -->
										<div class="comments-section">
						
											<div class="comments-section-head">
												
												<div class="comments-section-head-text">
														<h3>{{ $noComments }} {{ str_plural('Comment', $noComments) }}</h3>
												</div>
												<div class="clearfix"></div>
											
											</div>

										<div class="comments-section-grids">
												
												@foreach($eventDetails->eventscomment as $comments)
											
													@commentForEventIsActive($comments)
													
														<div class="comments-section-grid">
															
															<div class="col-md-2 comments-section-grid-image">
																<img src="{{ asset('images/frontend_images/eye-brow.jpg') }}" class="img-responsive" alt="" />
															</div>
											
															<div class="col-md-10 comments-section-grid-text">
																<h4><a href="#">{{ optional($comments)->name ?? 'No name provided' }}</a></h4>
																<label>{{ optional($comments->created_at)->diffForHumans() ?? 'No date provided' }}</label>
																<p>{{ optional($comments)->email ?? 'No email provided' }}</p>
																<label>{{ optional($comments)->message ?? 'No comment provided' }}</label>
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
													@include('layouts.errors')
												<br>	
											</div>
									
									</div> 
								
									<div class="blog-form" id="formhere">
										
										@php $eventId = encrypt($eventDetails->id)  @endphp

										<form action="{{ url("/events/{$eventId}/comments") }}" method="post">{{ csrf_field() }}
											<input type="hidden" name="event_id" value="{{ encrypt($eventDetails->id) }}">
											<input type="text" class="text" placeholder="{{ Auth::user()->name ?? 'Enter name' }}" value="" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Name';}" required>
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
								@foreach($allPosts as $posts)
									@include('layouts.frontLayout.front_entertainment')
								@endforeach
							</div>

						</div>

						<div class="clearfix"></div>
				
					</div>
			
			</div>				
			
			<div class="review-slider">
				
				<ul id="flexiselDemo1">

					@foreach($eventSliderImages as $image)
						<li><img src="{{ asset($image->slider_imagename) }}" alt="{{ $image->slider_imagename }}"/></li>
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

@auth


		@if($noOfTickets  > 0)
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
		
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Book Ticket for {{ $eventDetails->name }}</h4>
				<br><br>
				</div>
					<div class="modal-body">
							
							@foreach($eventDetails->tickets as $ticket)
								<strong><p> {{ $ticket->tickettype }} : {{ is_numeric($ticket->price) ? $ticket->price.' '.'Naira' : 'Free' }}</p></strong>
							@endforeach

							<br>

							<strong><p id="total-pay"></p></strong>

							<br><br>

					<form action="{{ url('/makepayment') }}" method="post" role="form">{{ csrf_field() }}

						<?php
							$metadata = [
								'custom_fields' => [
									['event_name' => $eventDetails->name ],
									
								]
							];
					
						?> 
							
								<select class="form-control" id="sel1" name="amount">
									<option disabled>--- Select Tickets ---</option>
									@foreach($eventDetails->tickets as $ticket)
										@if(is_numeric($ticket->price)) 
												<option value="{{$ticket->price}}">{{$ticket->tickettype}}</option>
										@endif
									@endforeach
								</select>

								<br><br>

								<select class="form-control" id="sel2" name="qty">
									<?php 
										for ($x = 1; $x <= $eventDetails->quantity; $x++) {
											echo "<option value=$x>$x</option>";
										} 
									?>
								</select>

								<input type="hidden" name="metadata" value="{{ json_encode($metadata) }}" >

								<br><br>
							
								<input type="submit" class="btn btn-green" value="Pay Now" style="background-color:green; color:white;">

						</form>

						{{-- payment button for stripe --}}
						{{-- <form action="your-server-side-code" method="POST">
							<script
							var tickets = {{ json_encode($tickets) }}
							src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="pk_test_TYooMQauvdEDq54NiTphI7jx"
							data-amount="999"
							data-name="Stripe.com"
							data-description="Example charge"
							data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
							data-locale="auto"
							data-zip-code="true">
							</script>
						</form> --}}

					</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		
			</div>
		</div>
		@endif

  @endauth	

		<script>
			document.getElementById('sel2').addEventListener('click', function() {
				var ticketPrice = document.getElementById('sel1').value;
				var ticketQuantity = document.getElementById('sel2').value;
				var totalAmount = ticketPrice * ticketQuantity;
				document.getElementById('total-pay').innerHTML = 'Ticket Quantity - ' + ticketQuantity + '<br>' + 
				'Ticket Price - ' + ticketPrice + ' ' + 'Naira' + '<br>' +
				'Amount To Be Paid' + ' ' +  totalAmount + ' ' + 'Naira';
			});
			document.getElementById('sel2').addEventListener('change', function() {
				var ticketPrice = document.getElementById('sel1').value;
				var ticketQuantity = document.getElementById('sel2').value;
				var totalAmount = ticketPrice * ticketQuantity;
				document.getElementById('total-pay').innerHTML = 'Ticket Quantity - ' + ticketQuantity + '<br>' + 
				'Ticket Price - ' + ticketPrice + ' ' + 'Naira' + '<br>' +
				'Amount To Be Paid' + ' ' +  totalAmount + ' ' + 'Naira';
			});
		</script>
@endsection


