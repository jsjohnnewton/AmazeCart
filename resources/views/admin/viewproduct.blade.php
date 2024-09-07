<x-admin-layout>

    <div class="text-center pt-1">
        <h2 class="p-1">View Product</h2>

        @if(session()->has('del-message'))
        <div class=" alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> -->
            {{session()->get('del-message')}}
        </div>
        @endif

    </div>

    <!-- ========== tables-wrapper start ========== -->
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-10">Product Table</h6>

                    <div class="table-wrapper table-responsive">
                        <table class="striped-table table">
                            <thead>
                                <tr>
                                    <th class="lead-info">
                                        <h6>Title</h6>
                                    </th>
                                    <th class="">
                                        <h6>Description</h6>
                                    </th>
                                    <th class="">
                                        <h6>Quantity</h6>
                                    </th>
                                    <th class="">
                                        <h6>Price</h6>
                                    </th>
                                    <th class="">
                                        <h6>Discount</h6>
                                    </th>
                                    <th class="">
                                        <h6>Category</h6>
                                    </th>
                                    <th colspan="2">
                                        <h6>Action</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                @foreach($data as $product)
                                @php
                                $product->image = json_decode($product->image);
                                @endphp
                                <tr>
                                    <td class="min-width">
                                        <div class="lead">
                                            <div class="lead-image">
                                                <img src="/product/{{$product->image[0]}}" alt="" />
                                            </div>
                                            <div class="lead-text">
                                                <p>{{$product->title}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="min-width">
                                        <p>{{$product->description}}</p>
                                    </td>
                                    <td class="min-width">
                                        <p>{{$product->quantity}}</p>
                                    </td>
                                    <td class="min-width">
                                        <p>{{$product->price}}</p>
                                    </td>
                                    <td class="min-width">
                                        <p>{{$product->discount_price}}</p>
                                    </td>
                                    <td class="min-width">
                                        <p>{{$product->category}}</p>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <form action="{{ url('/update_product') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="product" value="{{$product->id}}">
                                                <button type="submit" class="text-primary"><i class="mdi mdi-pencil"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <form action="{{ url('/delete_product') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to Delete this?')">
                                                @csrf
                                                <input type="hidden" name="product" value="{{$product->id}}">
                                                <button type="submit" class="text-danger"><i class="lni lni-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                <!-- end table row -->
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <!-- Pagination -->
                                        <div class="pagination">
                                            {{ $data->links() }}
                                        </div>
                                    </td>
                                </tr>

                            </tbody>



                        </table>
                        <!-- end table -->
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    </div>

</x-admin-layout>