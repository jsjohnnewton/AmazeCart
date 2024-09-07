<!DOCTYPE html>
<html lang="en">

@include('home.head')


<body>
    <!-- Header -->
    @include('home.header')
    <!-- /header -->
    <!-- navigation -->
    @include('home.dashboard.navigation')
    <!-- navigation -->

    <!-- 
    <div class="section" id="mydashboard">
        container
        <div class="container">
            row
            <div class="row sm:flex sm:justify-center">
                <div class="main-panel">
                    <div class="content-wrapper">

                        <div class="text-center pt-1">
                            <h2 class="p-1">My Dashboard</h2>

                            @if(session()->has('message'))
                            <div class=" alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{session()->get('message')}}
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->

    <div class="section" id="myorder">
        <!-- container -->
        <div class="container">

            @if (!empty($order_products))
            <!-- row -->
            <div class="row sm:flex sm:justify-center">
                <div class="main-panel">
                    <div class="content-wrapper">

                        <div class="text-center pt-1">
                            <h2 class="p-1">My Orders</h2>
                        </div>
                        <table class="table table-responsive ml-auto mr-auto mt-2 w-auto text-center pb-1">
                            <thead class="pb-1">
                                <tr class="pb-1">
                                    <th class="pb-1 p-0 pl-3">User Name </th>
                                    <th class="pb-1 p-0 pl-3">Email</th>
                                    <th class="pb-1 p-0 pl-3">Phone</th>
                                    <th class="pb-1 p-0 pl-3">Delivery Address</th>
                                    <th class="pb-1 p-0 pl-3">Product Title</th>
                                    <th class="pb-1 p-0 pl-3">Product Quantity</th>
                                    <th class="pb-1 p-0 pl-3">Product Price</th>
                                    <th class="pb-1 p-0 pl-3">Payment Status</th>
                                    <th class="pb-1 p-0 pl-3">Delivery Status</th>
                                    <th class="pb-1 p-0 pl-3">Product Image</th>
                                    <th class="pb-1 p-0 pl-3">Cancel Order</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($order_products as $order_product)
                                <tr>
                                    <td class="pb-1 p-0 pl-1">{{$order_product['user']}}</td>
                                    <td class="pb-1 p-0 pl-1">{{$order_product['mail']}}</td>
                                    <td class="pb-1 p-0 pl-1 ">{{$order_product['phone']}}</td>
                                    <td class="pb-1 p-0 pl-1 ">{{$order_product['address']}}</td>
                                    <td class="pb-1 p-0 pl-1">{{$order_product['product']->title}}</td>
                                    <td class="pb-1 p-0 pl-1">{{$order_product['quantity']}}</td>
                                    <td class="pb-1 p-0 pl-1">{{$order_product['price']}}</td>



                                    <td class="pb-1 p-0 pl-1">
                                        @if($order_product['payment']=='completed')
                                        <span class="btn btn-success">Payment completed</span>
                                        @else
                                        <span class="btn btn-warning">Payment Pending</span>
                                        @endif
                                    </td>
                                    <td class="pb-1 p-0 pl-1">
                                        @if($order_product['delivery']=='Processing')

                                        <span class="btn btn-info">On Route</span>
                                        @elseif($order_product['delivery']=='cancelled')
                                        <span class="btn btn-warning">Cancelled</span>
                                        @else
                                        <span class="btn btn-success">Product Delivered</span>
                                        @endif
                                    </td>
                                    <td class="pb-1 p-0 pl-1"><img src="/product/{{$order_product['product']->image}}" alt="" class="pdt_img pt-1"></td>

                                    @if($order_product['delivery']=='Processing')
                                    <td class="pb-1 p-0 pl-1">
                                        <form action="{{ url('/cancel') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to cancel this order?')">
                                            @csrf
                                            <input type="hidden" name="product" value="{{$order_product['id']}}">
                                            <button type="submit" class="btn btn-danger" style="background-color: red;">Cancel Order</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="row sm:flex sm:justify-center">
                <p>No Orders Placed</p>
            </div>
            @endif
        </div>
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