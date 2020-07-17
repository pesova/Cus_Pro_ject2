@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
@stop
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-md-12">
                    <h4 class="mb-1 mt-0">Debtors</h4>
                        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#bs-example-modal-sm">
                            Create a debt reminder
                        </button> --}}
                    
                    {{-- <a href="{{ route('debtor.create') }}" class="btn btn-primary float-right">
                        Create New Debtors &nbsp;<i class="fa fa-plus my-float"></i>
                    </a> --}}
                    <!-- /.modal -->


                    <div class="modal fade" id="bs-example-modal-sm2" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-sm2">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel">Update Debtor Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <select name="" id="exampleInput1" class="form-control">
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                </div>
            </div>
            </div>

            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-1">Basic Data Table</h4>
                            <p class="sub-header">
                                Find Debts
                            </p>
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="form-group col-lg-4 mt-4">
                                        <div class="row">
                                            <label class="form-control-label">Transaction ID</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                </div>
                                                <input type="text" class="form-control" id="password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 mt-4">
                                        <label class="form-control-label">Status</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                            </div>
                                            <input type="text" class="form-control" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 mt-4">
                                        <label class="form-control-label">Date Published</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                            </div>
                                            <input type="date" class="form-control" id="date">
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-primary">Search</button>
                                </div>


                            </div>

                        </div> <!-- end card body-->
                    </div>
                </div>
            </div> --}}

            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="sub-header">
                                Find debtors by store name
                            </p>
                            <div class="container-fluid">
                                @isset($stores)
                                <form action="{{ route('debt.search') }}" method="GET">
                                        <div class="form-group col-lg-4 mt-4">
                                            <label class="form-control-label">Store Name</label>
                                            <div class="input-group input-group-merge">
                                                
                                                <select name="store_id" class="form-control">
                                                    <option value="" selected disabled>None selected</option>
                                                    
                                                    @foreach ($stores as $index => $store )
                                                        <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <button type="search" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                @endisset
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            
            <!-- For store admin -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                            <p class="sub-header">
                                List of all Debtors <br>
                            </p>
                            <div class="table-responsive">
                                <table class="table mb-0" id="basic-datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Description</th>
                                        <th scope="col"> Amount</th>
                                        <th scope="col">Created Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        
                                    @isset($debtors)
                                    @foreach ($debtors as $key => $debtor)
   
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        
                                            <td> 
                                                {{ $debtor->_id }}
                                            </td>
                                            <td>
                                                @if(print($debtor->status == 1))
                                                    <span class="badge badge-danger }}">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $debtor->description }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $debtor->amount }}</span>
                                            </td>
                                            <td>
                                                {{ date_format(new DateTime($debtor->createdAt  ),'Y-m-d') }}
                                            </td>
                                    
                                        {{-- {<td>
                                            {{ date_format(new DateTime($debtor->expected_pay_date  ),'Y-m-d') }}
                                        </td> --}}

                                            <td>
                                                <a class="btn btn-info btn-small py-1 px-2"
                                                    href="{{ route('debtor.show', $debtor->_id) }}">
                                                    View More
                                                </a>
                                              <!--  <div class="btn-group mt-2 mr-1">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        View More<i class="icon"><span data-feather="chevron-down"></span></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        {{-- <a class="dropdown-item" href="{{ route('debtor.show',[$debtor->_id]) }}">View</a> --}}
                                                        <a class="dropdown-item" href="{{ route('debtor.show',[$debtor->_id]) }}">View</a>
                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#bs-example-modal-sm2">
                                                            Update Status
                                                        </a>
                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#bs-example-modal-sm">
                                                            Schedule reminder
                                                        </a>
                                                        {{-- <a class="dropdown-item" href="{{ route('reminder') }}" data-toggle="modal" data-target="#bs-example-modal-sm2">
                                                            Send a reminder
                                                        </a> --}}
                                                        <form id="reminder-form-{{ $debtor->_id }}" action="{{ route('reminder') }}" method="POST"
                                                                style="display:none">
                                                            @csrf
                                                            <input type="hidden" name="transaction_id" value="{{ $debtor->_id }}">
                                                        </form>

                                                        <a class="dropdown-item" href=""
                                                                onclick="
                                                                        if(confirm('Are you sure You want to send a reminder to this user'))
                                                                        {event.preventDefault(); document.getElementById('reminder-form-{{ $debtor->_id }}').submit();}
                                                                        else{
                                                                        event.preventDefault();
                                                                    }"> Send a reminder </a>
                                                    </div>-->
                                                </div>
                                            </td>
                                        <th>
                                    </tr>
                                    
                                    
                                    @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                            {{-- @isset($debtors)
                        {{ $debtors->links() }}
                    @endisset --}}
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- End of store Admin -->

            <!-- For store Assistant -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                           <!-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> -->
                            <p class="sub-header">
                                List of all Debtors <br>
                            </p>
                            <div class="table-responsive">
                                <table class="table mb-0" id="basic-datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Publish Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($debtors)
                                    @foreach ($debtors as $key => $debtor)
                                    {{-- <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>
                                            <span>{{ $debtor->debt_obj->ts_ref_id }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ ($debtor->debt_obj->status == 'unpaid') ? 'danger' : 'success' }}">{{ $debtor->debt_obj->status }}</span>
                                        </td>
                                        <td>
                                            {{ $debtor->debt_obj->message }}
                                        </td>
                                        <td>
                                            {{ date_format(new DateTime($debtor->debt_obj->expected_pay_date  ),'Y-m-d') }}
                                        </td>

                                        <td>
                                            <div class="btn-group mt-2 mr-1">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('debtor.show',[$debtor->debt_obj->_id]) }}">View</a>
                                                    <a class="dropdown-item" href="{{ route('debtor.edit',[$debtor->debt_obj->_id]) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('debtor.edit',[$debtor->debt_obj->_id]) }}" data-toggle="modal" data-target="#bs-example-modal-sm2">
                                                        Update Status
                                                    </a>
                                                    <form action="{{ route('debtor.destroy',[$debtor->debt_obj->_id]) }}" method="post">
                                                        <input type="hidden" name="store_name" value="{{ $debtor->store_name }}">
                                                        <input type="hidden" name="customer_phone_number" value=" {{ $debtor->debt_obj->customer_phone_number }}">
                                                        <input class="dropdown-item" type="submit" value="Delete" />
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> --}}
                                    {{-- @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                            @isset($debtors)
                        {{ $debtors->links() }}
                    @endisset
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col--> --}}
            {{-- </div> --}}
            <!-- End of store Assistant -->

        </div>
    </div>

@endsection


@section("javascript")
    <script src="/backend/assets/build/js/intlTelInput.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // any initialisation options go here
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#basic-datatable').DataTable( {
            paging: false
        } );
        } );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });
        $("#timepicker").datetimepicker({
            format: "HH:mm",
            icons: {
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down"
            }
        });
    </script>
@stop
