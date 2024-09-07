<x-user-layout>

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        @if($categoryname == 'all')
                        <li class='active'>All Categories</li>
                        @else
                        <li><a href="{{url('/categorypage' , 'all')}}">All Categories</a></li>
                        @if(is_array($categoryname))
                        <li class="active">
                            @foreach($categoryname as $category)
                            {{$category}}
                            @endforeach
                        </li>
                        @else
                        <li class="active">{{$categoryname}}</li>
                        @endif
                        @endif

                        @if(is_array($priceRange))
                        <li class="active">
                            @foreach($priceRange as $price)
                            {{$price}}
                            @endforeach
                        </li>
                        @else
                        <li class="active">{{$priceRange}}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->




    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-2">
                    <!-- aside Widget -->

                    <form action="{{ route('search') }}" method="GET">
                        <div class="aside">
                            <h3 class="aside-title">Categories</h3>
                            <div class="checkbox-filter">
                                @foreach($categories as $category)

                                <div class="input-checkbox">
                                    <input type="checkbox" name="category[]" id="{{ $category->category_name }}" value="{{ $category->category_name }}">
                                    <label for="{{ $category->category_name }}">
                                        <span></span>
                                        {{ $category->category_name }}
                                        <small></small>
                                    </label>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Price</h3>
                            <div class="checkbox-filter">
                                @php
                                $startPrice = 15000;
                                $endPrice = 30000;
                                @endphp

                                <div class="input-checkbox">
                                    <input type="checkbox" id="price_0_to_{{ $startPrice }}" name="price_range[]" value="below-{{ $startPrice }}">
                                    <label for="price_0_to_{{ $startPrice }}">
                                        <span></span>
                                        Below <i class="fa fa-rupee"></i>{{ $startPrice }}
                                        <small></small>
                                    </label>
                                </div>

                                @while($startPrice < 75000) <div class="input-checkbox">
                                    <input type="checkbox" id="price_{{ $startPrice }}_to_{{ $endPrice }}" name="price_range[]" value="{{ $startPrice }}-{{ $endPrice }}">
                                    <label for="price_{{ $startPrice }}_to_{{ $endPrice }}">
                                        <span></span>
                                        <i class="fa fa-rupee"></i>{{ $startPrice }} - <i class="fa fa-rupee"></i>{{ $endPrice }}
                                        <small></small>
                                    </label>
                            </div>

                            @php
                            $startPrice = $endPrice;
                            $endPrice += 15000;
                            @endphp
                            @endwhile
                            <div class="input-checkbox">
                                <input type="checkbox" id="price_{{ $startPrice }}_to_more" name="price_range[]" value="above-{{ $startPrice }}">
                                <label for="price_{{ $startPrice }}_to_more">
                                    <span></span>
                                    Above <i class="fa fa-rupee"></i>{{ $startPrice }}
                                    <small></small>
                                </label>
                            </div>
                        </div>
                        <button type="submit">Apply Filters</button>
                    </form>
                </div>
                <!-- /aside Widget -->

            </div>
            <!-- /ASIDE -->


            <!-- Store Products -->
            <div id="store" class="col-md-10">
                <!-- Store Products -->
                <div class="row flex  wrap  py-6" style="row-gap: 3.5rem;">
                    @foreach ($products as $product)

                    <?php $i = "{{$product->id}}"; ?>

                    <div class="col-md-4 col-xs-6  m-6 py-6" style="z-index: 1; height: 500px;">

                        <div class="product" onclick="window.location.href='{{ url('/productdetails') }}?product={{ $product->id }}'">
                            @php
                            $images = json_decode($product->image); // Decode the JSON string into an array
                            @endphp
                            <div class="product-img product-img-container">
                                <img src="/product/{{$images[0]}}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{$product->category}}</p>
                                <h3 class="product-name"><a href="#"> {{$product->title}}</a></h3>

                                @if($product->discount_price)
                                <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product->discount_price}} <del class="product-old-price"><i class="fa fa-rupee"></i>{{$product->price}} </del></h4>
                                @else
                                <h4 class="product-price"><i class="fa fa-rupee"></i>{{$product->price}}</h4>
                                @endif

                                <!-- <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div> -->
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
                                </div>
                            </div>
                            <div class="add-to-cart">

                                <form action="{{ url('/addtocart') }}" method="get" class="form m-auto inline-flex" id="addtocartform{{ $i }}">
                                    @csrf
                                    <input type="hidden" name="product" value="{{$product->id}}">
                                    <input type="hidden" value="1" name="quantity">
                                </form>

                                <button class="add-to-cart-btn" onclick="submit('{{ $i }}','cart')"><i class="fa fa-shopping-cart"></i> add to cart</button>
                            </div>
                        </div>


                    </div>
                    @endforeach
                </div>
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products</span>
                    <ul class="store-pagination">

                        @if ($products->onFirstPage())
                        <li class="disabled"><span>&laquo;</span></li>
                        @else
                        <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @for ($page = 1; $page <= $products->lastPage(); $page++)
                            @if ($page == $products->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                            @else
                            <li><a href="{{ $products->url($page) }}">{{ $page }}</a></li>
                            @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                            <li><a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                            <li class="disabled"><span>&raquo;</span></li>
                            @endif
                    </ul>
                </div>


            </div>
            <!-- /Store -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <!-- /SECTION -->
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
    </script>

</x-user-layout>