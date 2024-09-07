<x-admin-layout>


    @if(session()->has('message'))
    <div class=" alert alert-success mt-3">
        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> -->
        {{session()->get('message')}}
    </div>
    @endif
    <div class="d-flex justify-content-between w-full">
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-2">Back</a>
    </div>


    <div class="text-center pt-1">

        <div class="card-style mb-30">
            <h6 class="mb-10">Update Product</h6>


            <form action="{{ url('/updateproduct') }}" method="post" class="form m-auto" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="product" value="{{$data->id}}">
                <div class="d-flex  input-style-1 mb-20 col-lg-12">
                    <label for="title" class='col-form-label w-25 text-right pr-4'>Product Title</label>
                    <input type="text" name="title" value="{{$data->title}}" placeholder="Write a title" class=" mt-1 w-50" required>
                </div>

                <div class="d-flex  input-style-1 mb-20 col-lg-12">
                    <label for="description" class='col-form-label w-25 text-right pr-4'>Product Description</label>
                    <input type="text" name="description" value="{{$data->description}}" placeholder="Write a description" class=" mt-1 w-50" required>
                </div>

                <div class="d-flex  input-style-1 mb-20 col-lg-12">

                    <label for="quantity" class='col-form-label w-25 text-right pr-4'>Product Quantity</label>
                    <input type="number" name="quantity" value="{{$data->quantity}}" min=0 placeholder="Write the quantity" class=" mt-1 w-50" required>
                </div>

                <div class="d-flex  input-style-1 mb-20 col-lg-12">
                    <label for="price" class='col-form-label w-25 text-right pr-4'>Product Price</label>
                    <input type="number" name="price" value="{{$data->price}}" placeholder="Write the price" class=" mt-1 w-50" required>
                </div>

                <div class="d-flex  input-style-1 mb-20 col-lg-12">
                    <label for="discount" class='col-form-label w-25 text-right pr-4'>Discount Price</label>
                    <input type="number" name="discount" value="{{$data->discount_price}}" placeholder="Write the discount price" class=" mt-1 w-50">
                </div>

                <div class="d-flex  input-style-1 mb-20 col-lg-12">
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
                @php
                $images = json_decode($data->image); // Decode the JSON string into an array
                @endphp
                *select the image to Remove
                <div class="d-flex input-style-1 mb-20 col-lg-12">
                    <label for="image" class="col-form-label w-25 text-right pr-4">Current Images </label>
                    @if(is_array($images))
                    <div class="m-3 d-flex flex-wrap gap-1">
                        @foreach($images as $index => $image)
                        <div>
                            <img src="/product/{{$image}}" alt="" height="100">
                            <div class="checkbox-style">
                                <input type="checkbox" name="remove_images[]" value="{{ $index }}" class="form-check-input" style="height: 2px;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="d-flex input-style-1 mb-20 col-lg-12">
                    <label for="image" class="col-form-label w-25 text-right pr-4">Change Product Images</label>
                    <input type="file" name="images[]" multiple class="mt-1 w-50">
                </div>



                <div class="d-flex justify-content-center w-75 mt-3">
                    <input type="submit" class="btn btn-primary" value="Update product" name="submit">
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>