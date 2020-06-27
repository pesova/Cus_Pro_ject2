
@extends('layout.base')
@section("custom_css")
	      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/app.min.css" rel="stylesheet" type="text/css" />
@stop



    @section('content')
    <?php
    $filedata = file_get_contents('https://dev.customerpay.me/complaint/all');
    $files = json_decode($filedata, true);
    
    ?>
    <div class="card" style="margin-top: 10px;">
                                    <div class="card-body">
                                        {{-- <h4 class="header-title mt-0 mb-1">Basic Complaint Log Table</h4> --}}
                                            <p class="sub-header">
                                            List of all complaints submitted
                                                </p>
                                            <div class="table-responsive">
                                                <form method="get">
                                                    @csrf
                                                    <!-- @method('DELETE') -->
                                                 <table class="table mb-0" id="basic-datatable">
                                                <thead>
                                                <tr>
                                                           <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                     <th scope="col">Email</th>
                                                     <th scope="col">Message</th>
                                                     <th scope="col">Status</th>
                                                     <th scope="col">Date</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($files['data'] as $person) : ?>
                                                <tr>
                                                    <th scope="row"><?php echo ($person['_id']); ?></th>
                                                    <td><?php echo ($person['customer_first_name']); ?> <?php echo ($person['customer_last_name']); ?></td>
                                                    <td><?php echo ($person['customer_email']); ?></td>
                                                    <td><?php echo ($person['message']); ?></td>
                                                    <td><?php echo ($person['status']); ?></td>
                                                    <td><?php echo ($person['createdAt']); ?></td>
                                                    <td><div class="btn-group mt-2 mr-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a name="status" href="/backend/1123?id=<?php echo ($person['_id']); ?>&&status=<?php echo ($person['status']); ?>&&message=<?php echo ($person['message']); ?>" class="dropdown-item" >Change Status</a>
                                                <a name="delete" class="dropdown-item" href="/backend/2f4k7e34o?id=<?php echo ($person['_id']); ?>">Delete</a>
                                            </div>
                                        </div></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
      <!-- content -->


                <!-- <div class="row"> -->
                            <!-- <div class="col-12"> -->
                                

                   
                <script type="text/javascript">
      // function myFunction() {
      // document.getElementById("demo").innerHTML = "Hello World";
// }
    </script>
       @endsection


    @section("javascript")
    <script type="text/javascript">
     function myFunction() {
      window.alert('Hello World');
}
    </script>


    @stop
