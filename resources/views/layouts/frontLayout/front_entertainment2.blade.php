<ul>
    <li class="ent">
          <a href="single.html"><img src="{{ asset(optional($event->blogimage)->imagename ?? 'images/frontend_images/posts/default.jpg') }}" alt="" /></a>
       
    </li>
    <li>
        <a href="{{ url('/posts/'.$event->id) }}">{{ $event->title }}</a>

    </li>
    <div class="clearfix"></div>
</ul>             