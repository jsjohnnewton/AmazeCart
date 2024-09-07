<!DOCTYPE html>
<html lang="en">

@include('home.head')

<style>
    table {
        table-layout: fixed;
    }

    td {
        white-space: normal !important;
    }

    .btn {
        color: black;
    }

    .table>tbody>tr>td {
        vertical-align: middle;
    }


    input[type="number"],
    input[type="text"] {
        padding: 2px;
        width: 60px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 5px;
        font-size: 2rem;
    }

    /* Styling for the popup */
    #popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
</style>

<body>

    <!-- header -->
    @include('home.header')
    <!-- header -->


    <!-- NAVIGATION -->
    @include('home.dashboard.navigation')
    <!-- /NAVIGATION -->


    <div class="section mb-4">
        <!-- container -->
        <div class="container">
            @if(session()->has('success'))
            <div class=" alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('success')}}
            </div>
            @endif
            @if (!empty($cart_products))

            <!-- row -->
            <div class="row">

                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="text-center pt-1">
                            <h2 class="p-1 panel-title">My Cart</h2>



                        </div>


                        <div class="d-flex f-end">
                            <a href="{{ url('/clearcart') }}" onclick="return confirm('Are you sure you want to clear your cart?')" class="btn btn-danger">Clear Cart</a>
                        </div>


                        <table class="table table-responsive ml-auto mr-auto mt-2 w-auto text-center pb-1">
                            <thead class="pb-1">
                                <tr class="pb-1">
                                    <th class="pb-1 p-0 pl-3">Product Title</th>
                                    <th class="pb-1 p-0 pl-3">Product Description</th>
                                    <th class="pb-1 p-0 pl-3">Product Category</th>
                                    <th class="pb-1 p-0 pl-3">Product Image</th>
                                    <th class="pb-1 p-0 pl-3">Product Price</th>
                                    <th class="pb-1 p-0 pl-3">Product Quantity</th>
                                    <th class="pb-1 p-0 pl-3" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $subtotal = 0; ?>
                                @foreach($cart_products as $cart_product)
                                <tr>
                                    <td class="pb-1 p-0 pl-1">{{$cart_product['product']->title}}</td>
                                    <td class="pb-1 p-0 pl-1 text-break">{{$cart_product['product']->description}}</td>
                                    <td class="pb-1 p-0 pl-1">{{$cart_product['product']->category}}</td>
                                    <td class="pb-1 p-0 pl-1"><img src="/product/{{$cart_product['product']->image}}" alt="" class="pdt_img pt-1"></td>
                                    @if($cart_product['product']->discount_price)
                                    <td class="pb-1 p-0 pl-1"> <i class="fa fa-rupee"></i>{{$cart_product['product']->discount_price}}</td>
                                    <?php $subtotal = $subtotal + $cart_product['quantity'] * $cart_product['product']->discount_price; ?>
                                    @else
                                    <td class="pb-1 p-0 pl-1"> <i class="fa fa-rupee"></i>{{$cart_product['product']->price}}</td>
                                    <?php $subtotal = $subtotal + $cart_product['quantity'] * $cart_product['product']->price; ?>
                                    @endif



                                    <form action="{{ url('/updatecart') }}" method="post" id="updateform">

                                        <td class="pb-1 p-0 pl-1 ">

                                            <input type="number" name="quantity" id="quantity" value="{{$cart_product['quantity']}}" min="1">

                                        </td>

                                        <td class="pb-1 p-0 pl-1">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$cart_product['id']}}">
                                            <button type="submit" class="btn btn-info">Update Quantity</button>

                                        </td>
                                    </form>
                                    <td class="pb-1 p-0 pl-1">
                                        <form action="{{ url('/deletecart') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to Delete this?')">

                                            @csrf
                                            <input type="hidden" name="product" value="{{$cart_product['id']}}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4">Total Price</th>
                                    <td class="pb-1 p-0 pl-1"><i class="fa fa-rupee"> {{$subtotal}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /row -->

            <div class="row">
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="text-center pt-1">
                            <button id="popupButton" class="p-1 panel-title btn btn-info">Proceed to Order</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row popup" id="popup">
                <button type="button" class="close" id="closeButton">x</button>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="text-center pt-1">
                            <h2 class="p-1 panel-title">Proceed to Pay</h2>
                        </div>
                        <form action="" method="get" id="orderform">
                            <div class="d-flex f-center pt-1">

                                @csrf
                                <table class="table table-responsive ml-auto mr-auto mt-2 w-auto text-center pb-1">

                                    <thead class="pb-1">
                                        <tr class="pb-1">
                                            <!-- <th class="pb-1 p-0 pl-3">
                                                Select All
                                                <input type="checkbox" id="selectAllCheckbox">
                                            </th> -->
                                            <th class="pb-1 p-0 pl-3">Product Title</th>
                                            <th class="pb-1 p-0 pl-3">Product Quantity</th>
                                            <th class="pb-1 p-0 pl-3">Product Price</th>
                                        </tr>
                                    </thead>

                                    @foreach($cart_products as $cart_product)
                                    <tr>

                                        <input type="hidden" name="product[]" value="{{$cart_product['id']}}">

                                        <td class="pb-1 p-0 pl-1">{{$cart_product['product']->title}}</td>
                                        <td class="pb-1 p-0 pl-1">{{$cart_product['quantity']}}</td>
                                        @if($cart_product['product']->discount_price)
                                        <td class="pb-1 p-0 pl-1"> <i class="fa fa-rupee"></i>{{$cart_product['product']->discount_price}}</td>

                                        @else
                                        <td class="pb-1 p-0 pl-1"> <i class="fa fa-rupee"></i>{{$cart_product['product']->price}}</td>

                                        @endif

                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2" class="text-right">Total Price</th>
                                        <td class="pb-1 p-0 pl-1"><i class="fa fa-rupee"> </i>{{$subtotal}}</td>
                                        <input type="hidden" name="totalprice" value="{{$subtotal}}">
                                    </tr>
                                    @auth
                                    <!-- <tr>
                                        <td>shipping Address</td>
                                        <td colspan="3">
                                            <input type="text" name="address" value="{{auth()->user()->address}}" style="width: 100%;">
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td>Mobile number</td>
                                        <td colspan="3">
                                            <input type="number" name="phone" value="{{auth()->user()->phone}}" style="width: 100%;" min="0">
                                        </td>
                                    </tr>
                                    @endauth


                                    @foreach($Addresses as $key => $address)

                                    <?php
                                    $s = ($key == 0) ? 'checked' : '';
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="address" value=" {{ $address->door_number }}, {{ $address->street }}, {{ $address->post_office }}(p.o), {{ $address->district }}, {{ $address->state }}, {{ $address->pincode }}" <?php echo $s; ?>>
                                        </td>
                                        <td>
                                            <label>
                                                {{ $address->door_number }}, {{ $address->street }}, {{ $address->post_office }}, {{ $address->district }}, {{ $address->state }}, {{ $address->pincode }}
                                            </label>

                                        </td>
                                    </tr>

                                    @endforeach

                                </table>

                            </div>
                            <div class="d-flex f-center pt-1">

                                @if($Addresses->count() > 0)
                                <!-- Buttons for payment methods -->
                                <button class="btn btn-warning" onclick="placeorder('/pay_cash')">Cash on Delivery</button>
                                <button class="btn btn-warning" onclick="placeorder('/pay_card')">Card Payment</button>
                                @else
                                <a href="{{url('/shippingAddressManage')}}" class="btn btn-danger">Add Shipping Address first</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="row sm:flex sm:justify-center">
                <p>Cart is Empty</p>
            </div>
            @endif
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
        // Get references to the button and popup
        var popupButton = document.getElementById('popupButton');
        var popup = document.getElementById('popup');
        var closeButton = document.getElementById('closeButton');

        // Function to show the popup
        function showPopup() {
            popup.style.display = 'block';
        }

        // Function to hide the popup
        function hidePopup() {
            popup.style.display = 'none';
        }

        // Event listener for the button click
        popupButton.addEventListener('click', showPopup);

        // Event listener for the close button click
        closeButton.addEventListener('click', hidePopup);



        // JavaScript code to handle select all checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const checkboxes = document.querySelectorAll('input[name="product[]"]');

            // Add event listener to select all checkbox
            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Add event listener to checkboxes to uncheck "select all" when any checkbox is unchecked
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    }
                });
            });
        });


        // Function to submit the form with the desired action
        function placeorder(action) {
            const form = document.getElementById('orderform');
            form.action = action; // Change the action attribute
            if (action == '/pay_card') {
                form.method = 'post';
            }
            form.submit(); // Submit the form
        }
    </script>
</body>

</html>