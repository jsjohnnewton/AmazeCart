<!DOCTYPE html>
<html lang="en">

@include('home.head')

<body>

    <!-- header -->
    @include('home.header')
    <!-- header -->


    <!-- NAVIGATION -->
    @include('home.navigation')
    <!-- /NAVIGATION -->




    <div class="section mb-4">
        <!-- container -->
        <div class="container">

            <div class="row">
                @if(session()->has('success'))

                <div class=" alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('success')}}
                </div>
                @endif

               
            </div>
            <!-- row -->
            <div class="row">

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">

                    </div>
                </div>
                <!-- /Product thumb imgs -->
                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product->title}}</h2>
                        <div class="product-preview">
                            <img src="/product/{{$product->image}}" alt="">
                        </div>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <!-- <a class="review-link" href="#">10 Review(s) | Add your review</a> -->
                        </div>
                        <div>

                            @if($product->discount_price)
                            <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product->discount_price}} <del class="product-old-price"><i class="fa fa-rupee"></i>{{$product->price}} </del></h4>
                            @else
                            <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product->price}}</h4>
                            @endif

                            @if($product->quantity)
                            <span class="product-available">In Stock</span>
                            @else
                            <del class="product-available">out of Stock</del>
                            @endif

                        </div>
                        <p>{{$product->description}}</p>
                        <div class="product-options">

                        </div>

                        <div class="add-to-cart">

                            <form action="{{ url('/addtocart') }}" method="get" class=""">
                                @csrf
                             <input type=" hidden" name="product" value="{{$product->id}}">

                                <div class="qty-label">
                                    Quantity
                                    <div class="input-number">
                                        <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                            </form>
                        </div>

                        <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="#">{{$product->category}}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>


    <!-- FOOTER -->
    @include('home.footer')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="home/js/jquery.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/slick.min.js"></script>
    <script src="home/js/nouislider.min.js"></script>
    <script src="home/js/jquery.zoom.min.js"></script>
    <script src="home/js/main.js"></script>

</body>

</html>