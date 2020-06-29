@extends('layout.base')

@section("custom_css")
	<!-- <link href="/frontend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="/backend/assets/css/materialize.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  
  
@stop



    @section('content')
    
    <style type="text/css">
      @media screen and (max-width: 670px){
        .container{
          max-width: 500px;
          /*margin: 0px;*/
          padding: 0px;
        }
      }
    </style>
            <div class="container" style="padding: 20px; background-color: white; margin-top: 15px; border-radius: 10px;">
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <h5>Log your Complain</h5><br>
              <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <input id="full_name" disabled type="text" class="validate">
                <label for="full_name">User ID</label>
              </div><br>
              <div class="input-field">
                <i class="material-icons prefix">store</i>
                <input id="email" disabled type="email" class="validate">
                <label for="email">Store ID</label>
              </div><br>
              <div class="input-field">
                <i class="material-icons prefix">edit</i>
                <textarea id="textarea1" name="message" class="materialize-textarea"></textarea>
                <label for="textarea1">Message</label>
              </div><br>
              <div style="margin-bottom: 50px;">
                <button style="color: white;" name="btn" class="waves-effect waves-light btn right"><i class="material-icons left">send</i>SUBMIT</button>
              </div></form>
          </div>
          </form>
    </div>
      </div>

       @endsection


    @section("javascript")
    <script type="text/javascript" src="/backend/assets/js/materialize.min.js"></script>


    @stop


    @section('content')

    <!-- Start Content-->
    <div class="container-fluid h-100">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                </nav>
                <h4 class="mb-1 mt-0">Create Complaint</h4>
            </div>
        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="mb-3 header-title mt-0">Complaint Form</h4> --}}

                        <form class="mt-4 mb-3 form-horizontal">
                            <div class="form-group row mb-3">
                                <label for="fullname" class="col-3 col-form-label">Full Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-3 col-form-label">Store</label>
                                <div class="col-9">
                                    <select class="form-control custom-select">
                                        <option>Store 1</option>
                                        <option>Store 2</option>
                                        <option>Store 3</option>
                                        <option>Store 4</option>
                                        <option>Store 5</option>
                                        <option>Store 6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="message" class="col-3 col-form-label">Message</label>
                                <div class="col-9">
                                    <textarea class="form-control" rows="5" id="message" placeholder="Kindly, tell us your problem..."></textarea>
                                </div>
                            </div>

                            <br>
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit Complaint</button>
                                </div>
                            </div>
                        </form>

                    </div>  <!-- end card-body -->
                </div>
            </div>
            <!-- end col -->
    </div> <!-- container-fluid -->

    @endsection

