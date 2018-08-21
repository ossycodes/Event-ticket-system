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
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			
            <div class="reviews-section">
					
                    <div class="col-md-9 reviews-grids">
					  
				@if($categoryDetails)
					 @foreach($categoryDetails as $category)

					 <h3 class="head">Category: {{ $category->name }}</h3>
					
					@if($category)
						 @foreach($category->events as $event)

                            
							<div class="review">
                                <div class="movie-pic">
                                    <a href="{{ url('/events/') }}"><img src="{{ asset($event->image) }}" alt="" style = "width:70%; height:100%;"/></a>
                                </div>

    
                                <div class="review-info">
                                    <a class="span" href="{{ url('/events/') }}">{{ $event->name }}</a>
                                    
									<br>
                                                   
                                    <p class="">VENUE:&nbsp; {{ $event->venue }}</p>
									<p class="">DATE:&nbsp; {{ $event->date }}</p>
                                    <p class="">DURATION:&nbsp; {{ $event->time }}</p>
                      
                                    <br>
									<!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{ $event->id }}" style="margin-bottom: 15px;">More Details</button>
                                    
									<button type="button" class="btn btn-danger" style="margin-bottom: 15px;">Book Ticket</button>

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
													<p><strong>Description: </strong> {{ $event->description }} </p>
													<br>
													<p><strong>Venue: </strong> {{ $event->venue }} </p>
													<br>
													<p><strong>Actors: </strong> {{ $event->actors }} </p>
													<br>
													<p><strong>Time Duration: </strong> {{ $event->time }} </p>
													<br>
													<p><strong>Date: </strong> {{ $event->date }} </p>
													<br>
													<p><strong>Age: </strong> {{ $event->age }} </p>
													<br>
													<p><strong>Tickets: </strong> {{ $event->ticket }} </p> 
													<br>
													<p><strong>Dress Code: </strong>{{ $event->dresscode }} </p>
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
											<h1>Oops! No Events Of This Category At the Moment</h1> 
										</div>
									</div>
							@endif
                       
					    @endforeach
					@else					
							<div class="">
								<div class="jumbotron">
									<h1>Oops! No Category At the Moment</h1> 
								</div>
							</div>
					@endif	

					
					@if($categoryDetails)
					<div class="pagenation">
							{{ $categoryDetails->render() }}

					</div>
					@else

					@endif
					

				
				
                    
                    </div>
                  
                    

					<div class="col-md-3 side-bar">
				
				<div class="entertainment">
					
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
				
				@foreach($eventsimage as $image)
					<li><img src="{{ asset($image->image) }}" alt=""/></li>
				@endforeach
		    </ul>

		@include('layouts.frontLayout.front_scripts2')		
		
		</div>		

		<br>
        <div class ="container" style="background:#f3f3f3;">
		<strong>Categories: </strong>
	    @foreach($allCategories as $category)
			<a href="{{ url('category/'.$category->id) }}" style="text-decoration: none;"><span class="label label-warning">{{ $category->name }}</span></a>
		@endforeach
	   </div>
	   @include('layouts.frontLayout.front_footer')
	

	</div>
	<div class="clearfix"></div>
	</div>

@endsection