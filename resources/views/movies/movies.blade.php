<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Moderns a Interior Category Flat Bootstarp Responsive Website Template | Blog :: w3layouts</title>
<link href="{{ asset('css/frontend_css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!-- Custom Theme files -->
@extends('layouts.frontLayout.front_design')

@section('content')

	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				@include('layouts.frontLayout.front_menu')
				
			</div>
				<script type="text/javascript">
					$(function() {
						$('#navigation a').stop().animate({'marginLeft':'-120px'},1000);

						$('#navigation > li').hover(
							function () {
								$('a',$(this)).stop().animate({'marginLeft':'-2px'},10);
							},
							function () {
								$('a',$(this)).stop().animate({'marginLeft':'-120px'},10);
							}
						);
					});
				</script>
		<div class="main">
		<div class="review-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
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
				<h3 class="head">Our Blog</h3>
					<div class="col-md-9 reviews-grids">
						<div class="blog-grids">
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b1.jpg') }}" alt="" /></a>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b2.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b3.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="blog-grids">
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b4.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>								
									<p class="ratingview">$200.00</p>									</p>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b5.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b2.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="blog-grids">
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b1.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>								
									<p class="ratingview">$200.00</p>									</p>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b4.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="col-md-4 review">
								<div class="movie-pic">
									<a href="single.html"><img src="{{ asset('images/frontend_images/movies/b5.jpg') }}" alt="" /></a>
								</div>
								<div class="review-info">
									<a class="span" href="single.html">Ut porta leo nuncet facilisis orci accumsan ac</a>
									<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>
									<p class="ratingview">$200.00</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 side-bar">
						<div class="featured">
							<h3>Collections</h3>
							<ul>
								<li>
									<a href="single.html"><img src="images/f1.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f2.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f3.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f4.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f5.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f6.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<div class="clearfix"></div>
							</ul>
						</div>
						
						<div class="entertainment">
							<h3>Best Sellers</h3>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f6.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
								
								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f5.jpg" alt="" /></a>
								</li>
									<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
							
								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f3.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
								
								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f4.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
								
								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f2.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
							
								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f1.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>
								
								</li>
								<div class="clearfix"></div>
							</ul>
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
	<div class="footer">
			<div class="footer-grids">
				<div class="col-md-3 footer-left">
					<h3>About</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry galley of type and scrambled it to make a type specimen book......</p>
				</div>
				<div class="col-md-3 footer-left touch">
					<h3>Get in touch</h3>
					<ul>
						<li>Los Angeles</li>
						<li>CA, United States</li>
						<li>Phone:+1 234 456 7890</li>		
						<li>Email: <a href="mailto:info@example.com">info@example.com</a></li>
					</ul>
				</div>
				<div class="col-md-3 footer-left footer-nav">
					<h3>Follow Us</h3>
					<ul>
						<li><a href="#" class="facebook">Facebook +</a> </li>
						<li><a href="#" class="twitter">Twitter +</a></li>
						<li><a href="#" class="dribbble">Dribbble +</a></li>
						<li><a href="#" class="pinterest">pinterest +</a></li>
					</ul>
				</div>
				<div class="col-md-3 footer-left footer-nav">
					<h3>Copyright</h3>
					<p>Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>