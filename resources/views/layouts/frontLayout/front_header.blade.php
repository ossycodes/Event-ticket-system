
<div class="header" style = "background: url('../images/frontend_images/header-bg.jpg') no-repeat 0px 0px;">
    <div class="top-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
            <p>Movie Theater</p>
        </div>
        <div class="search">
            <form>
                <input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
                <input type="submit" value="">
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header-info">
        <h1>{{ $info->name }}</h1>
        <p class="age"><a href="#">Age: {{ $info->age }}</a>{{ $info->location }}</p>
        <p class="review reviewgo">Genre	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; Animation, Action, Comedy</p>
        <p class="review">Release &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; {{ $info->release }}</p>
        <p class="special">{{ $info->description }}</p>
        <a class="video" href="{{ url('movies') }}"><i class="video1"></i>WATCH TRAILER</a>
        <a class="book" href="{{ url('events/'.$info->linktoticket) }}"><i class=""></i>BOOK TICKET</a>
    </div>
</div>