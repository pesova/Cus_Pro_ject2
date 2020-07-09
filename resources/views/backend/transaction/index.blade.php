@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="backend/assets/css/all_users.css">
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="h4"><i data-feather="file-text" class="icon-dual"></i> Transaction Center</div>
                @if(Session::has('message') || $errors->any())
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                @endif
                {{-- @if(Session::has('message') || $errors->any())
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                @endif --}}
                <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#CustomerModal">
                    New &nbsp;<i class="fa fa-plus my-float"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="sub-header">
                            Find Transaction
                        </p>
                        <div class="container-fluid">
                            <div class="row">

                        <div class="form-group col-lg-4 mt-4">
                            <div class="row">
                            <label class="form-control-label">Transaction Reference Id</label>
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
                            <label class="form-control-label">Customer Reference</label>
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
                            <label class="form-control-label">Transaction Type</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    
                                </div>
                                <select id="phone" class="form-control">
                                    <option></option>
                                    <option>Receivables</option>
                                    <option>Paid</option>
                                    <option>Debt</option>
                                </select>


                            </div>
                        </div>
                        
                            <button type="button" class="btn btn-primary">Search</button>
                            </div>

                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <div class="card-header">
            <div class="h5">All Transactions</div>
        </div>
        
        <div class="card-body p-1 card">
            <div class="table-responsive table-data">
                <table id="basic-datatable" class="table dt-responsive nowrap">

                    <thead>
                        <tr>
                            <th>Ref Id</th>
                            <th>Ref Transaction Type</th>
                            <th>Customer Ref Code</th>
                            <th>Amount</th>
                            {{-- <th>Expected Pay Date</th> --}}
                            <th> more</th>
                        </tr>
                    </thead>

                    <tbody>
                     @foreach ($response as $details)
                        @foreach ($details->transactions as $transactions)
                            <tr>
                            <td>{{$transactions->_id }}</td>
                             <td>{{$transactions->type }}</td>
                            <td>{{$transactions->customer_ref_id }}</td>
                            <td>{{$transactions->total_amount}}</td>
                           
                            {{-- <td>{{ date('d M Y', strtotime($transactions->created_date)) }}</td> --}}
                            <td><a href="{{ route('transaction.show', $transactions->_id) }}" class="btn btn-primary btn-sm">view</i></a>
                            <a href="{{ route('transaction.edit', $transactions->_id) }}" class="btn btn-success btn-sm">edit</i></a>
                            <a href="{{ route('transaction.destroy', $transactions->_id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#CustomerModal1">delete</i></a>
                             
                            </td>
                        </tr>
                        @endforeach
                        
                      @endforeach 
                      
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end card -->
        </div>
    </div>
</div>

<div id="CustomerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="addTransaction" method="POST" action="{{ route('transaction.store') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="amount" class="col-3 col-form-label">Amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="amount" name="amount"
                                placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="interest" class="col-3 col-form-label">Interest</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="interest" name="interest" placeholder="Interest" >
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="total_amount" class="col-3 col-form-label">Total amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Total amount">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="description" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="transaction_name" class="col-3 col-form-label">Transaction Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_name" name="transaction_name" placeholder="Transaction Name">
                        </div>
                    </div>
<<<<<<< HEAD
                    {{-- <div class="form-group row mb-3">
                        <label for="transaction_role" class="col-3 col-form-label">Transaction Role</label>
=======
                     <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Transaction role</label>
>>>>>>> c4ebeb3e3d2915007a253d2f20e38818d631c819
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_role" name="transaction_role" placeholder="Transaction Role">
                        </div>
                    </div> --}}
                    <div class="form-group row mb-3">
<<<<<<< HEAD
                        <label for="store_name" class="col-3 col-form-label">Store Name</label>
=======
                        <label for="inputPassword3" class="col-3 col-form-label">Transaction Type</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputPassword3" name="transaction_type" placeholder="Transaction Type">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Store Name</label>
>>>>>>> c4ebeb3e3d2915007a253d2f20e38818d631c819
                        <div class="col-9">
                            <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Store Name">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="phone" class="col-3 col-form-label">Phone Number</label>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone" name="phone_number"  placeholder="+2348134346556">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create Transaction</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div id="CustomerModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="addTransaction" method="POST" action="{{ route('transaction.store') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h6>Are you sure you want to delete this transaction?</h6>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-end align-items-end">
                    <button class="btn btn-danger">Yes</button>&nbsp;
                    <button class="btn btn-primary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // any initialisation options go here
    });

</script>
@stop
