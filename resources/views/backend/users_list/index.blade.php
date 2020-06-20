
@extends('layout.base')
@section("custom_css")
<link href="{{ asset('/backend/assets/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />

        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/all_users.css')}}"> --}}
@stop
        @section('content')
                <div class="content">
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <h4 class="mb-1 mt-0">All Users</h4>
                            </div>
                        </div>

                                                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                                            <p class="sub-header">
                                           Find Users
                                                </p>
                                            <div class="container-fluid">
                                                <div class="row">

                                            <div class="form-group col-lg-4 mt-4">
                                                <div class="row">
                                                <label class="form-control-label">Reference Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="password" >
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4 mt-4">
                                                <label class="form-control-label">Business Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="password" >
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4 mt-4">
                                                <label class="form-control-label">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="tel" id="phone" class="form-control">


                                                </div>
                                            </div>
                                            
                                                <button type="button" class="btn btn-primary">Search</button>
                                                </div>


                                            </div>
                                            
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                                            <p class="sub-header">
                                            List of all registered users
                                                </p>
                                            <div class="table-responsive">
                                                 <table class="table mb-0" id="basic-datatable">
                                                <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                     <th scope="col">Location</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>John Doe <br> <span>SO123aM123</span> <span class="badge badge-primary">Store Owner</span> <span class="badge badge-secondary">assistant</span> <span class="badge badge-success">Activated</span> </td>
                                                    <td>Store Location Address would be here <br> <span class="badge badge-primary">Store Reference Code: ST145M455</span> </td>
                                                    <td><div class="btn-group mt-2 mr-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/backend/view_user">View Profile</a>
                                                <a class="dropdown-item" href="#">Active</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        
                    </div>
                </div>
        
        @endsection


    @section("javascript")
<script src="{{ asset('/backend/assets/build/js/intlTelInput.js') }}"></script>
<script>
var input = document.querySelector("#phone");
window.intlTelInput(input, {
    // any initialisation options go here
});
</script>
    @stop