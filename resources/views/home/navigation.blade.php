<nav id="navigation" class="z-10">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                @foreach($categories as $category)
                <li class="{{ Request::path() == 'categorypage/' . $category->category_name ? 'active' : '' }}">
                    <a href="{{url('/categorypage/' . $category->category_name)}}">{{ $category->category_name }}</a>
                </li>
                @endforeach
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>