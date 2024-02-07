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
                    
                    <div class="text-center pt-1">
                        <h2 class="p-1">Add category</h2>
                        <form action="{{ url('/add_category') }}" method="post">

                            @csrf
                            <input type="text" name="category" id="" placeholder="Write category Name">
                            <input type="submit" class="btn btn-primary" value="Add category" name="submit">
                        </form>
                    </div>
                    <table class="table table-bordered ml-auto mr-auto mt-2 w-50 text-center">
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
                </div>

            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>