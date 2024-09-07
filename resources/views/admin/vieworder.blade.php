<x-admin-layout>

    <style>
        button {
            all: unset;
        }
    </style>


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
        <div class=" alert alert-success">
            {{session()->get('del-message')}}
        </div>
        @endif

    </div>

    <!-- ========== tables-wrapper start ========== -->
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">

                    @if($order_products)
                    <h6 class="mb-10">Order Table</h6>

                    <div class="table-wrapper table-responsive">

                        <label for="delivery-filter">Delivery Status:</label>
                        <select id="delivery-filter">
                            <option value="all">All</option>
                            <option value="processing">Processing</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <!-- <label for="payment-filter">Payment Status:</label>
                        <select id="payment-filter">
                            <option value="all">All</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="cash_on_delivery">Cash on Delivery</option>
                        </select> -->


                        <table class="striped-table table" id="order-table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6>User Name </h6>
                                    </th>
                                    <th>
                                        <h6>Email</h6>
                                    </th>
                                    <th>
                                        <h6>Phone</h6>
                                    </th>
                                    <th>
                                        <h6>Delivery Address</h6>
                                    </th>
                                    <th>
                                        <h6>Product Title</h6>
                                    </th>
                                    <th>
                                        <h6>Product Quantity</h6>
                                    </th>
                                    <th>
                                        <h6>Product Price</h6>
                                    </th>
                                    <th class="payment-status">
                                        <h6>Payment Status</h6>
                                    </th>
                                    <th class="delivery-status">
                                        <h6>Delivery Status</h6>
                                    </th>


                                </tr>

                                <!-- end table row-->
                            </thead>
                            <tbody>
                                <?php $subtotal = 0; ?>
                                @foreach($order_products as $order_product)
                                <tr>
                                    <td class="min-width">{{$order_product['user']}}</td>
                                    <td class="min-width">{{$order_product['mail']}}</td>
                                    <td class="min-width ">{{$order_product['phone']}}</td>
                                    <td class="min-width ">{{$order_product['address']}}</td>

                                    <td class="min-width">
                                        <div class="lead">
                                            <div class="lead-image">
                                                <img src="/product/{{$order_product['product']->image}}" alt="">
                                            </div>
                                            <div class="lead-text">
                                                <p>{{$order_product['product']->title}}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="min-width">{{$order_product['quantity']}}</td>
                                    <td class="min-width">{{$order_product['price']}}</td>



                                    <td class="min-width payment-status">
                                        @if($order_product['payment']=='completed')

                                        <span class="status-btn success-btn text-center">Payment completed</span>
                                        @else
                                        <form action="{{ url('/payment') }}" method="get" id="" onsubmit="return confirm('Confirmation: Payment completed?')">

                                            @csrf
                                            <input type="hidden" name="product" value="{{$order_product['id']}}">
                                            <button type="submit" class="status-btn active-btn text-center">{{$order_product['payment']}}</button>
                                        </form>

                                        @endif
                                    </td>
                                    <td class="min-width delivery-status">
                                        @if($order_product['delivery']=='Processing')
                                        <form action="{{ url('/delivered') }}" method="get" id="" onsubmit="return confirm('Confirmation: Mark as delivered?')">

                                            @csrf
                                            <input type="hidden" name="product" value="{{$order_product['id']}}">
                                            <button type="submit" class="status-btn active-btn">{{$order_product['delivery']}}</button>
                                        </form>

                                        @elseif($order_product['delivery']=='cancelled')
                                        <span class="status-btn close-btn">Cancelled</span>
                                        @else
                                        <span class="status-btn success-btn">Delivered</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- end table row -->
                                @endforeach


                            </tbody>



                        </table>
                        <!-- end table -->
                    </div>
                    @else
                    <p>No orders found</p>
                    @endif
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deliveryFilter = document.getElementById('delivery-filter');
            // const paymentFilter = document.getElementById('payment-filter');

            deliveryFilter.addEventListener('change', filterOrders);
            // paymentFilter.addEventListener('change', filterOrders);

            function filterOrders() {
                const deliveryStatus = deliveryFilter.value.toLowerCase().trim();
                // const paymentStatus = paymentFilter.value.toLowerCase().trim();

                const rows = document.querySelectorAll('#order-table tbody tr');

                rows.forEach(row => {
                    const deliveryCell = row.querySelector('.delivery-status');
                    // const paymentCell = row.querySelector('.payment-status');

                    const deliveryText = deliveryCell.textContent.toLowerCase().trim();
                    // const paymentText = paymentCell.textContent.toLowerCase().trim();

                    let showRow = true;

                    if (deliveryStatus !== 'all' && deliveryText !== deliveryStatus) {
                        showRow = false;
                    }

                    // if (paymentStatus !== 'all') {
                    //     if (paymentStatus === 'cash on delivery') {
                    //         showRow = showRow && paymentText.includes('cash');
                    //     } else if (paymentText !== paymentStatus) {
                    //         showRow = false;
                    //     }
                    // }

                    row.style.display = showRow ? '' : 'none';
                });
            }

        });
    </script>

</x-admin-layout>