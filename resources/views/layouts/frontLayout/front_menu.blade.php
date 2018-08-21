<div class="menu">
    <?php 
          //gets the name of the url segment after the domain name(base url segment)
          $segment = Request::segment(1);
          //echo $segment; die;
    ?>

    <ul>
        <li><a class="{{ !$segment ? 'active' : ''}}" href="{{ route('/') }}"><i class="home"></i></a></li>
        <li><a class="{{ $segment == 'aboutus' ? 'active' : '' }}" href="{{ route('aboutus') }}"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
        <li><a class="{{ $segment == 'events' ? 'active' : '' }}" href="{{ route('events') }}"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
        <li><a class="{{ $segment == 'contactus' ? 'active' : '' }}" href="{{ route('contactus') }}"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
    </ul>
</div>