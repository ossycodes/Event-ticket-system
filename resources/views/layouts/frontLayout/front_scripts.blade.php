<script type="text/javascript">
				$(window).load(function() {
					
				$("#flexiselDemo2").flexisel({
						visibleItems: 4,
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