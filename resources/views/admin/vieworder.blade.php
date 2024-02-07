<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            table-layout: fixed;
        }

        td {
            white-space: normal !important;
        }
    </style>

    <!-- Required meta tags -->
    @include('admin.css')

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">


                    <ul class="navbar-nav w-50  m-auto">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search  g-1" method="get" action="{{url('searchorder')}}">
                                @csrf
                                <input type="text" name="search" class="form-control" placeholder="Search orders">
                                <input type="submit" value="search" class="btn btn-secondary">
                            </form>
                        </li>
                    </ul>


                    <div class="text-center pt-1">
                        <h2 class="p-1">Manage Order</h2>

                        @if(session()->has('del-message'))
                        <div class=" alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{session()->get('del-message')}}
                        </div>
                        @endif

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
                            </tr>
                        </thead>
                        <tbody>


                            <?php $subtotal = 0; ?>
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
                                    @if($order_product['payment']!='completed')
                                    <form action="{{ url('/payment') }}" method="get" id="" onsubmit="return confirm('Confirmation: Payment completed?')">

                                        @csrf
                                        <input type="hidden" name="product" value="{{$order_product['id']}}">
                                        <button type="submit" class="btn btn-primary">{{$order_product['payment']}}</button>
                                    </form>

                                    @else
                                    <span class="btn btn-success">Payment completed</span>
                                    @endif
                                </td>
                                <td class="pb-1 p-0 pl-1">
                                    @if($order_product['delivery']=='Processing')
                                    <form action="{{ url('/delivered') }}" method="get" id="" onsubmit="return confirm('Confirmation: Mark as delivered?')">

                                        @csrf
                                        <input type="hidden" name="product" value="{{$order_product['id']}}">
                                        <button type="submit" class="btn btn-primary">{{$order_product['delivery']}}</button>
                                    </form>

                                    @else
                                    <span class="btn btn-success">Product Delivered</span>
                                    @endif
                                </td>
                                <td class="pb-1 p-0 pl-1"><img src="/product/{{$order_product['product']->image}}" alt="" class="pdt_img pt-1"></td>
                                <td class="pb-1 p-0 pl-1">

                                </td>
                                <!-- 
                                <td class="pb-1 p-0 pl-1">
                                    <form action="{{ url('/deleteorder') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to Delete this?')">

                                        @csrf
                                        <input type="hidden" name="product" value="{{$order_product['id']}}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td> -->
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <th colspan="4">Total Price</th>
                                <td class="pb-1 p-0 pl-1"><i class="fa fa-rupee"> {{}}</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>