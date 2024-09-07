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
                @php
                $images = json_decode($product->image); // Decode the JSON string into an array
                @endphp
                <div class="col-md-4">
                    <div class="your-carousel">
                        @foreach($images as $image)
                        <div>
                            <img src="/product/{{$image}}" alt="Image" class="zoom-image">
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->
                <!-- Product details -->
                <div class="col-md-8">

                    <div class="zoom-view"></div>

                    <div class="product-details  w-full mx-auto p-6 text-center">
                        <h1 class="product-name">{{$product->title}}</h1>
                        <div class="product-preview">
                            <!-- <img src="/product/{{$product->image}}" alt=""> -->
                        </div>
                        <div>
                            <!-- <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div> -->
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
                        <p class=" mx-auto text-left"><strong>{!!nl2br(e($product->description))!!}</strong></p>
                        <div class="product-options">

                        </div>

                        <div class="add-to-cart">
                            <ul class="product-btns d-inline-flex">
                                <li>
                                    <form action="{{ url('/addtocart') }}" method="GET" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="product" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="add-to-cart-btn" type="submit">
                                            <i class="fa fa-shopping-cart"></i> add to cart
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ url('/addtowish') }}" method="GET" style="display:inline;">
                                        <input type="hidden" name="product" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-to-cart-btn">
                                            <i class="fa fa-heart"></i> add to wishlist
                                        </button>
                                    </form>
                                </li>
                            </ul>

                        </div>





                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="{{url('/categorypage' , $product->category)}}">{{$product->category}}</a></li>
                        </ul>

                        <!-- <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul> -->

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

    <script>
        $(document).ready(function() {
            $('.your-carousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });


        document.querySelectorAll('.zoom-image').forEach(function(image) {
            const zoomView = document.querySelector('.zoom-view');

            image.addEventListener('mousemove', function(e) {
                const rect = image.getBoundingClientRect();
                const x = e.clientX - rect.left; // X position within the image
                const y = e.clientY - rect.top; // Y position within the image
                const zoomFactor = 4; // Adjust zoom factor as needed

                // Display the zoom view
                zoomView.style.display = 'block';

                // Set the background image and size for the zoom view
                zoomView.style.backgroundImage = `url(${image.src})`;
                zoomView.style.backgroundSize = `${image.width * zoomFactor}px ${image.height * zoomFactor}px`;

                // Calculate the background position
                const bgPosX = Math.max(Math.min(x * zoomFactor - zoomView.clientWidth / 2, image.width * zoomFactor - zoomView.clientWidth), 0);
                const bgPosY = Math.max(Math.min(y * zoomFactor - zoomView.clientHeight / 2, image.height * zoomFactor - zoomView.clientHeight), 0);


                // Adjust to center the zoomed portion in the zoom-view
                zoomView.style.backgroundPosition = `-${bgPosX}px -${bgPosY}px`;

                // Optionally, you can center the zoomView on the screen
                // zoomView.style.left = `${(window.innerWidth - zoomView.clientWidth) / 2}px`;
                // zoomView.style.top = `${(window.innerHeight - zoomView.clientHeight) / 2}px`;
            });

            image.addEventListener('mouseleave', function() {
                // Hide the zoom view when the mouse leaves the image
                zoomView.style.display = 'none';
            });
        });
    </script>

</body>

</html>