<!DOCTYPE html>
<html lang="en">

<head>
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

                    @if($message)

                    <div class=" alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{$message}}
                    </div>
                    @endif
                    <div class="text-center pt-1">



                        <h2 class="p-1">Update Product</h2>
                        <div class="mb-4 ">
                            <form action="{{ url('/updateproduct') }}" method="post" class="form m-auto" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="product" value="{{$data->id}}">
                                <div class="d-flex d-flex">
                                    <label for="title" class='col-form-label w-25 text-right pr-4'>Product Title</label>
                                    <input type="text" name="title" value="{{$data->title}}" placeholder="Write a title" class=" mt-1 w-50" required>
                                </div>

                                <div class="d-flex">
                                    <label for="description" class='col-form-label w-25 text-right pr-4'>Product Description</label>
                                    <input type="text" name="description" value="{{$data->description}}" placeholder="Write a description" class=" mt-1 w-50" required>
                                </div>

                                <div class="d-flex">

                                    <label for="quantity" class='col-form-label w-25 text-right pr-4'>Product Quantity</label>
                                    <input type="number" name="quantity" value="{{$data->quantity}}" min=0 placeholder="Write the quantity" class=" mt-1 w-50" required>
                                </div>

                                <div class="d-flex">
                                    <label for="price" class='col-form-label w-25 text-right pr-4'>Product Price</label>
                                    <input type="number" name="price" value="{{$data->price}}" placeholder="Write the price" class=" mt-1 w-50" required>
                                </div>

                                <div class="d-flex">
                                    <label for="discount" class='col-form-label w-25 text-right pr-4'>Discount Price</label>
                                    <input type="number" name="discount" value="{{$data->discount_price}}" placeholder="Write the discount price" class=" mt-1 w-50">
                                </div>

                                <div class="d-flex">
                                    <label for="category" class='col-form-label w-25 text-right pr-4'>Product Category</label>
                                    <select name="category" class=" mt-1 w-50" required>
                                        <optgroup label="Currect Category">
                                            <option value="{{$data->category}}" selected>{{$data->category}} </option>
                                        </optgroup>
                                        <optgroup label="Change Category">
                                            @foreach($category as $category)
                                            <option value="{{$category->category_name}}">{{$category->category_name}} </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="d-flex">
                                    <label for="image" class='col-form-label w-25 text-right pr-4'>Current Image</label>
                                    <img src="/product/{{$data->image}}" alt="" class="pdt_img pt-1">
                                </div>

                                <div class="d-flex">
                                    <label for="image" class='col-form-label w-25 text-right pr-4'>Change Product Image</label>
                                    <input type="file" name="image" value="{{$data->title}}" class=" mt-1 w-50">

                                </div>

                                <div class="d-flex justify-content-center w-75 mt-3">
                                    <input type="submit" class="btn btn-primary" value="Update product" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>