<div class="main">

    <div class="top-header">
        
          <div class="logo">
              <a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
              <p>For All Events</p>
          </div>

          <div class="search">
          
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