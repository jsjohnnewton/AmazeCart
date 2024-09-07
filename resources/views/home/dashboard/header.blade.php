    <!-- HEADER -->
    <header class="sm:flex sm:justify-center sm:items-center">
        <!-- TOP HEADER -->
        <!-- <div id="top-header" class="sm:fixed sm:top-0 w-full z-10">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +91 99999 88888</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> contact@amazecart.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    @if (Route::has('login'))
                    <li class="sm:fixed sm:top-0 sm:right-0 p-6  z-10">
                        @auth
                        <a href="{{ url('/redirect') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <i class="fa fa-user-o"></i>
                            My Account</a>
                        <form action="{{ route('logout') }}" method="post" class="inline-flex   ">
                            @csrf
                            <a class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><input type="submit" value="Logout"></a>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                        @endauth
                    </li>
                    @endif
                </ul>
            </div>
        </div> -->
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header" class="w-full mt-16">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row sm:flex sm:justify-center sm:items-center ">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo ">
                            <a href="{{url('/')}}" class="logo">
                                <img src="./img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="{{ route('search') }}" method="GET">
                                <select name="category" class="input-select">
                                    <option value="all" selected>All Categories</option>
                                    @foreach($categories as $key => $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <input name="search_query" class="input" placeholder="Search here">
                                <button type="submit" class="search-btn">Search</button>
                            </form>

                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">


                            <!-- Wishlist -->
                            <div>
                                <a href="{{ url('/viewwish') }}">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    @if($wishes>0)
                                    <div class="qty">{{$wishes}}</div>
                                    @endif
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                @if(sizeof($cart_products)>0)

                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{sizeof($cart_products)}}</div>
                                </a>


                                <div class="cart-dropdown">
                                    <div class="cart-list">

                                        <?php $subtotal = 0; ?>
                                        @foreach($cart_products as $cart_product)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="/product/{{$cart_product['product']->image}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{$cart_product['product']->title}}</a></h3>
                                                @if($cart_product['product']->discount_price)
                                                <h4 class="product-price"><span class="qty">{{$cart_product['quantity']}}</span><i class="fa fa-rupee"></i>{{$cart_product['product']->discount_price}}</h4>
                                                <?php $subtotal = $subtotal + $cart_product['quantity'] * $cart_product['product']->discount_price; ?>
                                                @else
                                                <h4 class="product-price"><span class="qty">{{$cart_product['quantity']}}</span><i class="fa fa-rupee"></i>{{$cart_product['product']->price}}</h4>
                                                <?php $subtotal = $subtotal + $cart_product['quantity'] * $cart_product['product']->price; ?>
                                                @endif
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{sizeof($cart_products)}} Item(s) selected</small>
                                        <h5>SUBTOTAL: <i class="fa fa-rupee"></i>{{$subtotal}}</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ url('/viewcart') }}">View Cart</a>

                                    </div>
                                </div>


                                @else
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                </a>
                                @endif
                            </div>
                            <!-- /Cart -->
                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->