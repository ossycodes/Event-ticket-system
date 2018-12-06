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

									<form action="{{ route('search.events') }}" method="get">
                                        {{ csrf_field() }}
                                        <input type="text" name="q" value="{{ old('q') }}" />
                                        <button type="submit" value="Search" class="btn btn-danger"> Search </button>
                                    </form>
							
							</div>
						
							<div class="reviews-section">
									
													<div class="col-md-9 reviews-grids">
                                                        
															@if(count($events) > 0)
                                                        
                                                            <h2 class="head">Search Event Results For "  {{ old('q') }} "</h2>

																	@foreach($events as $event)
																	 
																		<div class="review">
																				
																				<div class="movie-pic">
																					<a href="{{ url('/events/'.$event->id) }}"><img src="{{ asset($event->image) }}" alt="" /></a>
																				</div>
											
																				<div class="review-info">
																					
																					<a class="span" href="{{ url('/events/'.$event->id) }}">{{ $event->name }}</a>
																					<br>
																						
																					<p class="">VENUE:&nbsp; {{ $event->venue ?? 'Venue was not provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																					<p class="">DATE:&nbsp; {{ $event->date ?? 'No date was set' }} {{-- ?? php 7 null coalesce operator --}}</p>
																					<p class="">TIME:&nbsp; {{ $event->time ?? 'No time was set' }} {{-- ?? php 7 null coalesce operator --}}</p>
																	
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
																										<p><strong>Time: </strong> {{ $event->time ?? 'No time provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Date: </strong> {{ $event->date ?? 'No date provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Age: </strong>{{ $event->age ?? 'No age provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<p><strong>Dress Code: </strong>{{ $event->dresscode ?? 'No dresscode provided' }} {{-- ?? php 7 null coalesce operator --}}</p>
																										<br>
																										<h3>Available Tickets</h3>
																										<br>
																										@foreach($event->tickets as $ticket)
																									    	<p><strong>{{ optional($ticket)->tickettype.' ' ?? 'Free' }}</strong>{{ is_numeric(optional($ticket)->price) ? optional($ticket)->price.' '.'Naira' : 'Free' }}</p><br>
																										@endforeach
																										
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
                                                                                @if(old('q'))
                                                                                 <h2 class="head">No Event Found For "  {{ old('q') }} "</h2> 
                                                                                @else
                                                                                 <h2>Type And Search For An Event</h2>
                                                                                @endif
																			</div>
																		</div>

															@endif

															@if(count($events) > 0)
																<div class="pagenation">
																	{{ $events->render() }}
																</div>
															@else

															@endif
													
													
													</div>
								
									

													

													<div class="clearfix"></div>
								
							</div>

					</div>
					
					<div class="review-slider">
						<ul id="flexiselDemo1">
							@foreach($eventSliderImages as $eventimage)
								<li><img src="{{ asset($eventimage->slider_imagename) }}" alt="{{ $eventimage->slider_imagename }}"/></li>
							@endforeach
						</ul>

        @include('layouts.frontLayout.front_scripts2')
					</div>
					
		
		@include('layouts.frontLayout.front_footer')


			</div>
			
			<div class="clearfix"></div>
		
	</div>

@endsection