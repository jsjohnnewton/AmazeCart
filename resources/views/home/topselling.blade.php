<div class="section mb-4">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top Selling Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            @foreach($topSellingProducts as $categoryName => $products)
                            <li class="{{ $loop->first ? 'active' : '' }}">
                                <a data-toggle="tab" href="#{{ $categoryName }}">{{ $categoryName }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        @foreach($topSellingProducts as $categoryName => $products)
                        <!-- tab -->
                        <div id="{{ $categoryName }}" class="tab-pane {{ $loop->first ? 'active' : '' }}">
                            <div class="products-slick" data-nav="#slick-nav-{{ $categoryName }}">
                                @foreach($products as $product)
                                <!-- product -->
                                <div class="product" onclick="window.location.href='{{ url('/productdetails') }}?product={{ $product->id }}'">
                                    @php
                                    $images = json_decode($product->image); // Decode the JSON string into an array
                                    @endphp
                                    <div class="product-img product-img-container">
                                        <img src="/product/{{ $images[0] }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category }}</p>
                                        <h3 class="product-name"><a href="{{ url('/productdetails') }}?product={{ $product->id }}">{{ $product->title }}</a></h3>
                                        @if($product->discount_price)
                                        <h4 class="product-price"><i class="fa fa-rupee"></i>{{ $product->discount_price }} <del class="product-old-price"><i class="fa fa-rupee"></i>{{ $product->price }}</del></h4>
                                        @else
                                        <h4 class="product-price"><i class="fa fa-rupee"></i>{{ $product->price }}</h4>
                                        @endif
                                        <!-- Additional product details -->
                                        <div class="product-rating">
                                            <!-- Add product rating here if available -->
                                        </div>
                                        <div class="product-btns">



                                            <button class="quick-view">
                                                <a href="{{ url('/productdetails') }}?product={{ $product->id }}">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="tooltipp">view details</span>
                                                </a>
                                            </button>

                                            <button class="add-to-wishlist">
                                                <a href="{{ url('/addtowish') }}?product={{ $product->id }}&quantity=1">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">add to wishlist</span>
                                                </a>
                                            </button>

                                            <!-- <a href="{{ url('/productdetails') }}?product={{ $product->id }}" class="quick-view"><span class="tooltipp">view details</span></a> -->

                                        </div>
                                    </div>

                                    <div class="add-to-cart">
                                        <button>
                                            <a href="{{ url('/addtocart') }}?product={{ $product->id }}&quantity=1" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</a>
                                        </button>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endforeach
                            </div>
                            <div id="slick-nav-{{ $categoryName }}" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


<script>
    function submit(id, type) {
        if (type == 'view') {
            var formId = 'viewdetailsform1' + id;
            document.getElementById(formId).submit();
        } else {
            var formId = 'addtocartform1' + id;
            document.getElementById(formId).submit();
        }

    }
</script>