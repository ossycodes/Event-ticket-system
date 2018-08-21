<div class="menu">
    <?php 
          //gets the name of the url after the domain name
          $segment = Request::segment(1);
          //echo $segment; die;
    ?>

    <ul>
        <li><a class="@if(!$segment) active @endif" href="{{ route('/') }}"><i class="home"></i></a></li>
        <li><a class="@if($segment == 'aboutus') active @endif" href="{{ url('aboutus') }}"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
        <li><a class="@if($segment == 'events') active @endif" href="{{ route('events') }}"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
        <li><a class="@if($segment == 'contactus') active @endif" href="{{ url('contactus') }}"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
    </ul>
</div>