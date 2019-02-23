<ul>
    <li class="ent">
          <a href="{{ asset(optional($event->blogimage)->imagename ?? 'images/frontend_images/posts/default.jpg') }}"><img src="{{ asset(optional($event->blogimage)->imagename ?? 'images/frontend_images/posts/default.jpg') }}" alt="" /></a>
       
    </li>
    <li>
        <a href="{{ route('posts.index', $event->id) }}">{{ $event->title }}</a>

    </li>
    <div class="clearfix"></div>
</ul>             