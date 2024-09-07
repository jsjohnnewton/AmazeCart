<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row sm:flex sm:justify-center">

            @foreach($cards as $card)
            <!-- shop -->

            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="product\{{$card['image']}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3> {{$card['category']}}<br>Collection</h3>
                        <a href="{{url('/categorypage' , $card['category'])}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
            @endforeach
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>