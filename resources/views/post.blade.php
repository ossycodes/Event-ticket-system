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
						
                        <h3>{{ $postDetails->title }}</h3>
                    
                        <p>Posted {{ $postDetails->created_at->diffForHumans() }} </p>

                        <!-- TODO HAD A PPOST PICTURE FROM DB, USING MODELS-->

                        <br>
						<img src="{{ asset(optional($postImage)->imagename ?? 'images/frontend_images/posts/default.jpg') }}" alt="" />
						
						
					</div>

					<div class="col-md-6 about-grid">

                        <h4>{{ $postDetails->description }}</h4>

						<p>
                            {{ $postDetails->body }} 
						</p>
                		
					</div>

                    
                    <div class="clearfix"> </div>
                        <br><br><br>

                        <div class="reply-section-head-text">
											
                            <h3>Leave A Comment</h3>
                            <br><br>
                            <!-- displays flash error messages if any -->
                                @include('layouts.errors')
                            <br>	
                        </div>

                        <div class="comments-section-grids">
										
                                        @foreach($postComments as $comments)
                                        
                                                <div class="comments-section-grid">
                                                    
                                                    <div class="col-md-10 comments-section-grid-text">
                                                        <h4><a href="#">{{ $comments->name }}</a></h4>
                                                        <label>{{ $comments->created_at->diffForHumans() }}</label>
                                                        <label>{{ $comments->message }}</label>
                                                        <i class="rply-arrow"></i>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                
                                                </div>

                                        @endforeach


                                </div>

                        <div class="clearfix"> </div>
                        <br><br>
                        
                        <div class="blog-form">
								
                                <form action="{{ url('/add-comment-event') }}" method="post">{{ csrf_field() }}
                                    <input type="hidden" name="post_id" value="{{ encrypt($postDetails->id) }}">
                                    <input type="text" class="text" placeholder="{{ Auth::user() ? Auth::user()->name : 'Enter name' }}" value="" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Name';}" required>
                                    <input type="text" class="text" placeholder = "{{ Auth::user() ? Auth::user()->email : 'Enter Email' }}" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Email';}" required>
                                    <textarea name="message" required></textarea>
                                    <input type="submit" value="SUBMIT COMMENT" class="btn btn-warning">
                                </form>
                        
                        </div>
				

				</div>
				
			</div>

			<div class="clearfix"> </div>
		</div>	
	
	@include('layouts.frontLayout.front_footer')

</div>	
	<div class="clearfix"></div>
</div>

@endsection