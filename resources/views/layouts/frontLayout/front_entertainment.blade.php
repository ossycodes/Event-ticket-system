        <ul>
            <li class="ent">
                <a href="single.html"><img src="{{ asset(optional($posts->blogimage)->imagename ?? 'images/frontend_images/posts/default.jpg') }}" alt="" /></a>
            </li>
            <li>
                <a href="{{ url('/posts/'.$posts->id) }}">{{ $posts->title }}</a>
            
            </li>
            <div class="clearfix"></div>
        </ul>             