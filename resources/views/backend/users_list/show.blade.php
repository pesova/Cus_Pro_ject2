
    @extends('layout.base')
@section("custom_css")
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
       
@stop
       @section('content')
          <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row page-title">
                        <div class="col-md-12">
                            <nav aria-label="breadcrumb" class="float-right mt-1">
                                <a href="/backend/users" class="btn btn-primary">Go Back</a>
                            </nav>
                            <h4 class="mb-1 mt-0">Profile</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mt-3">
                                        <img src="/backend/assets/images/users/avatar-7.jpg" alt=""
                                            class="avatar-lg rounded-circle" />
                                    <h5 class="mt-2 mb-0">{{$response->first_name. " " . substr($response->last_name,0,1) ."."}}</h5>
                                        <h6 class="text-muted font-weight-normal mt-2 mb-0">
                                                     @if ($response->user_role == "store_admin")
                                                            <span class="badge badge-primary">owner</span> 
                                                        @elseif ($response->user_role == "store_assistant")
                                                            <span class="badge badge-secondray">assistant</span>
                                                        @else
                                                             <span class="badge badge-info">No role</span>
                                                        @endif
                                           {{isset( $response->store_name) ? $response->store_name : "Store name Here"}}
                                        </h6>
                                    </div>
                                    <div class="mt-5 pt-2 border-top">
                                        <h4 class="mb-3 font-size-15">Store Address</h4>
                                        <p class="text-muted mb-4">{{isset( $response->store_address) ? $response->store_address : "Store address Here"}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                                                href="#pills-activity" role="tab" aria-controls="pills-activity"
                                                aria-selected="true">
                                                Basic Information
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                                href="#pills-messages" role="tab" aria-controls="pills-messages"
                                                aria-selected="false">
                                                Transactions
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-projects-tab" data-toggle="pill"
                                                href="#pills-projects" role="tab" aria-controls="pills-projects"
                                                aria-selected="false">
                                                Customers
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                            aria-labelledby="pills-activity-tab">
                                            <h5 class="mt-3">Account Information</h5>
                                             <div class="table-responsive">
                                            <table class="table table-borderless mb-0 text-muted">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                    <td>{{$response->email}}</td>
                                                    </tr>
                                                      <tr>
                                                        <th scope="row">Total Number of Customers</th>
                                                <td>{{"number of customers here"}}</td>
                                                    </tr>
                                                                                                                                                            <tr>
                                                        <th scope="row">Role</th>
                                                        <td>Owner</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone</th>
                                                        <td>{{$response->phone_number}}</td>
                                                    </tr>
                                                                                                        <tr>
                                                        <th scope="row">Store Reference Code</th>
                                                        <td>{{isset( $response->store_ref_code) ? $response->store_ref_code : "Store ref_code Here"}}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        </div>

                                        <!-- messages -->
                    <div class="tab-pane" id="pills-messages" role="tabpanel"
                                            aria-labelledby="pills-messages-tab">
                                            <h5 class="mt-3">Transactions</h5>
                                                   <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                 <thead>
                                    <tr>
                                        <td>Ref Id</td>
                                        <td>Ref Transaction Type</td>
                                        <td>Customer Ref Code</td>
                                        <td>Amount</td>
                                        <td>Expected Pay Date</td>
                                        <td>View more</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Paid</td>
                                        <td>C12ADS</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1D90F</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1D90F</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>
                                                                        <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1D90F</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Debt</td>
                                        <td>C1294E</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>

                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>

                                    <tr>
                                        <td>GI671B</td>
                                        <td>Paid</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/view_transaction"><i data-feather="eye"></i></a></td>
                                    </tr>

                                </tbody>
                                        </table>
                                    </div>
                                </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-projects" role="tabpanel"
                                            aria-labelledby="pills-projects-tab">

                                            <h5 class="mt-3">Customers</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Phone Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>9090</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->

            </div>
        @endsection


    @section("javascript")


                
    @stop