@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="backend/assets/css/store_list.css">
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
                            <th>Total Amount</th>
                            {{-- <th>Expected Pay Date</th> --}}
                            <th> Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                   @isset($response)
                     {{-- {{dd($details)}} --}}
                        @foreach ($response->data->transactions as  $transactions)
                        {{-- {{dd($transactions)}} --}}
                            <tr>
                        @foreach ($transactions->transactions as $index => $transaction)
                            <td>{{ $index + 1 }}</td>
                             <td>{{$transaction->type }}</td>
                            <td>{{$transaction->customer_ref_id }}</td>
                            <td>{{$transaction->total_amount}}</td>
                            <td>
                                <div class="btn-group mt-2 mr-1">
                                    <button type="button" class="btn btn-info dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('transaction.show', $transaction->_id) }}">View
                                            Transaction</a>
                                        <a class="dropdown-item" href="{{ route('transaction.edit', $transaction->_id) }}">Edit
                                            Transaction</a>
                                        <a class="dropdown-item" href="{{ route('transaction.destroy', $transaction->_id) }}">Delete Transaction</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                      @endisset
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
                    {{-- <div class="form-group row mb-3">
                        <label for="total_amount" class="col-3 col-form-label">Total amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Total amount">
                        </div>
                    </div> --}}
                    <div class="form-group row mb-3">
                        <label for="description" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                        </div>
                    </div>
                    {{-- <div class="form-group row mb-3">
                        <label for="transaction_name" class="col-3 col-form-label">Transaction Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_name" name="transaction_name" placeholder="Transaction Name">
                        </div>
                    </div> --}}
                     {{-- <div class="form-group row mb-3">
                        <label for="transaction_role" class="col-3 col-form-label">Transaction role</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_role" name="transaction_role" placeholder="Transaction Role">
                        </div>
                    </div> --}}
                    <div class="form-group row mb-3">
                        <label for="transaction_type" class="col-3 col-form-label">Transaction Type</label>
                        <div class="col-9">
                            <select id="transaction_type" name="transaction_type" class="form-control">
                                <option value="Receivables">Receivables</option>
                                <option value="Paid">Paid</option>
                                <option value="Debt">Debt</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="store_name" class="col-3 col-form-label">Store Name</label>
                        <div class="col-9">
                            <select class="form-control" name="store_name" id="store_name" required>
                                <option value="" selected disabled>None selected</option>
                                {{-- @isset($stores) --}}
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->store_id }}">{{ $store->store_name }}</option>
                                    @endforeach
                                {{-- @endisset --}}
                              </select>
                        </div>
                    </div>
                   <div class="form-group row mb-3">
                        <label for="store_name" class="col-3 col-form-label">Customer Name</label>
                        <div class="col-9">
                            <select class="form-control" name="customer_name" id="customer_name" required>
                                <option value="" selected disabled>None selected</option>
                                @isset($customers)
                                    @foreach ($customers as $customers)
                                        <option value="{{ $customers->customer_id }}">{{ $customers->customer_id }}</option>
                                    @endforeach
                                @endisset
                              </select>
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
                <form class="form-horizontal"  id="addTransaction" method="POST" action="">
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
                    <button type="submit"  class="btn btn-danger">Yes</button>&nbsp;
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

    const hash = "{{ $api_token }}";
    $('#store_name').change( element => {
        $.ajax({
            type: "GET",
            url: "{{env('API_URL')}}/customer",
            headers :  {'x-access-token': hash },
            data: {},
            success: function (response) {
                console.log(response.data.data)
            }
        });
    });
</script>
@stop
