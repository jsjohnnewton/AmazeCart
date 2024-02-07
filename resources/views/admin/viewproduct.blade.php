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
                    <div class="text-center pt-1">
                        <h2 class="p-1">View Product</h2>

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
                                <th class="pb-1 p-0 pl-3">Product Title</th>
                                <th class="pb-1 p-0 pl-3">Product Description</th>
                                <th class="pb-1 p-0 pl-3">Product Quantity</th>
                                <th class="pb-1 p-0 pl-3">Product Price</th>
                                <th class="pb-1 p-0 pl-3">Product Discount Price</th>
                                <th class="pb-1 p-0 pl-3">Product Category</th>
                                <th class="pb-1 p-0 pl-3">Product Image</th>
                                <th class="pb-1 p-0 pl-3" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td class="pb-1 p-0 pl-1">{{$data->title}}</td>
                                <td class="pb-1 p-0 pl-1 text-break">{{$data->description}}</td>
                                <td class="pb-1 p-0 pl-1">{{$data->quantity}}</td>
                                <td class="pb-1 p-0 pl-1">{{$data->price}}</td>
                                <td class="pb-1 p-0 pl-1">{{$data->discount_price}}</td>
                                <td class="pb-1 p-0 pl-1">{{$data->category}}</td>
                                <td class="pb-1 p-0 pl-1"><img src="/product/{{$data->image}}" alt="" class="pdt_img pt-1"></td>
                                <td class="pb-1 p-0 pl-1">
                                    <form action="{{ url('/delete_product') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to Delete this?')">

                                        @csrf
                                        <input type="hidden" name="product" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>

                                <td class="pb-1 p-0 pl-1">
                                    <form action="{{ url('/update_product') }}" method="post">

                                        @csrf
                                        <input type="hidden" name="product" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-info">Edit</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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