
@extends('layout.base')
@section("custom_css")
<<<<<<< HEAD
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
                                                    <p></p>
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
                                                <button name="status" type="button" class="dropdown-item" onclick="foo()" >Change Status</button>
                                                <a name="delete" class="dropdown-item" href="/backend/2f4k7e34o?id=<?php echo ($person['_id']); ?>">Delete</a>>
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
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    </script>
       @endsection


    @section("javascript")
    <script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){

            $.ajax({
                type: 'GET',
                url: '/backend/1123?id=<?php echo ($person['_id']); ?>&&status=<?php echo ($person['status']); ?>&&message=<?php echo ($person['message']); ?>',
                success: function(data) {
                    alert(data);
                    $("p").text(data);

                }
            });
   });
});
</script>


    @stop
=======
	<link href="/backend/assets/css/complaintlog.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
@stop

  @section('content')
    <div class="table-responsive">
      <table class="table complaintlog-table">
        <thead>
          <tr>
              <th>S/N</th>
              <th>Name</th>
              <th>Email</th>
              <th>Message</th>
              <th>Store</th>
              <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Alan Jellybean</td>
            <td>alan@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>abc123</td>
            <td>Closed</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Alvin Eclair</td>
            <td>eclair@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>abc123</td>
            <td>Open</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Elvis Mooney</td>
            <td>mooney@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>xyz456</td>
            <td>Closed</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Jonathan Lollipop</td>
            <td>jonathan@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut.</td>
            <td>xyz456</td>
            <td>Closed</td>
          </tr>
        </tbody>
      </table>
    </div>
  @endsection
>>>>>>> 0211f0e7eef5d789bbcb3abc4046835e16236545
