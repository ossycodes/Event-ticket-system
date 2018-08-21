<div class="more-reviews">
			 <ul id="flexiselDemo2">
                <li><img src="{{ asset('images/frontend_images/m1.jpg') }}" alt=""/></li>
                <li><img src="{{ asset('images/frontend_images/m2.jpg') }}" alt=""/></li>
                <li><img src="{{ asset('images/frontend_images/m3.jpg') }}" alt=""/></li>
                <li><img src="{{ asset('images/frontend_images/m4.jpg') }}" alt=""/></li>
		     </ul>

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
		 <script type="text/javascript" src="{{ asset('js/backend_js/jquery.flexisel.js') }}"></script>	
		
</div>