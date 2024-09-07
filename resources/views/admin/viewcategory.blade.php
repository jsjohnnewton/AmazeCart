<x-admin-layout>



    @if(session()->has('message'))

    <div class=" alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('message')}}
    </div>
    @endif

    @if(session()->has('del-message'))
    <div class=" alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('del-message')}}
    </div>
    @endif


    <div class="row align-center">
        <div class="col-lg-2">
        </div>
        <div class="card-style mb-30 mt-30 col-lg-8">
            <h6 class="mb-25">Add category</h6>
            <form action="{{ url('/add_category') }}" method="post">
                @csrf
                <div class="input-style-3 mb-20 col-lg-10">
                    <input type="text" name="category" id="" placeholder="Write category Name" required>
                </div>
                <div class="buttons-group col-lg-3">
                    <input type="submit" class="btn btn-primary" value="Add category" name="submit">
                </div>
            </form>
            <!-- end input -->
        </div>
    </div>
    <div class="row align-center">
        <!-- End Col -->
        <div class="col-lg-2">
        </div>


        <div class="col-lg-8">
            <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-30">Category</h6>
                    </div>

                </div>
                <!-- End Title -->
                <div class="table-responsive">

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td>{{$data->category_name}}</td>
                                <td>
                                    <form action="{{ url('/delete_category') }}" method="post" id="delete_form" onsubmit="return confirm('Are you sure to Delete this?')">

                                        @csrf
                                        <input type="hidden" name="category" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- End Table -->
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-2">
        </div>

    </div>


</x-admin-layout>