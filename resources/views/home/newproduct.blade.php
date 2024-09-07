<div class="section mb-4">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            @foreach($categories as $key => $category)
                            <li class="{{ $key === 0 ? 'active' : '' }}">
                                <a data-toggle="tab" href="#tab{{ $key + 1 }}">{{ $category->category_name }}</a>
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

                        @foreach($categories as $key => $category)
                        <!-- tab -->
                        <div id="tab{{ $key + 1 }}" class="tab-pane {{ $key === 0 ? 'active' : '' }}">
                            <div class="products-slick" data-nav="#slick-nav-{{ $key + 1 }}">
                                @if(isset($products[$key]))
                                @foreach($products[$key] as $product)
                                <!-- product -->
                                <?php $i = "{{$product['product']->id}}"; ?>


                                <div class="product" onclick="window.location.href='{{ url('/productdetails') }}?product={{ $product['product']->id }}'">
                                    @php
                                    $images = json_decode($product['product']->image); // Decode the JSON string into an array
                                    @endphp

                                    <div class="product-img-container product-img">
                                        <img src="/product/{{$images[0]}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$product['product']->category}}</p>
                                        <h3 class="product-name "><a href="{{ url('/productdetails') }}?product={{ $product['product']->id }}"> {{$product['product']->title}}</a></h3>

                                        @if($product['product']->discount_price)
                                        <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product['product']->discount_price}} <del class="product-old-price"><i class="fa fa-rupee"></i>{{$product['product']->price}} </del></h4>
                                        @else
                                        <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product['product']->price}}</h4>
                                        @endif

                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">

                                            <!-- <form action="{{ url('/productdetails') }}" method="get" class="form m-auto inline-flex" id="viewdetailsform{{ $i }}">
                                                @csrf
                                                <input type="hidden" name="product" value="{{$product['product']->id}}">
                                            </form> -->



                                            <button class="quick-view">
                                                <a href="{{ url('/productdetails') }}?product={{ $product['product']->id }}">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="tooltipp">view details</span>
                                                </a>
                                            </button>

                                            <button class="add-to-wishlist">
                                                <a href="{{ url('/addtowish') }}?product={{ $product['product']->id }}&quantity=1">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">add to wishlist</span>
                                                </a>
                                            </button>


                                        </div>
                                    </div>
                                    <!-- <div class="add-to-cart">

                                        <form action="{{ url('/addtocart') }}" method="get" class="form m-auto inline-flex" id="addtocartform{{ $i }}">
                                            @csrf
                                            <input type="hidden" name="product" value="{{$product['product']->id}}">
                                            <input type="hidden" value="1" name="quantity">
                                        </form>

                                        <button class="add-to-cart-btn" onclick="submit('{{ $i }}','cart')"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div> -->

                                    <div class="add-to-cart">
                                        <a href="{{ url('/addtocart') }}?product={{ $product['product']->id }}&quantity=1" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</a>
                                    </div>

                                </div>


                                <!-- /product -->
                                @endforeach
                                @endif
                            </div>
                            <div id="slick-nav-{{ $key + 1 }}" class="products-slick-nav"></div>

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

<!-- 
<script>
    function submit(id, type) {
        if (type == 'view') {
            var formId = 'viewdetailsform' + id;
            document.getElementById(formId).submit();
        } else {
            var formId = 'addtocartform' + id;
            document.getElementById(formId).submit();
        }

    }
</script> -->