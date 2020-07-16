@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('/backend/assets/css/store_list.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<!-- <link rel="stylesheet" href -->
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="h4"><i data-feather="file-text" class="icon-dual"></i> Transaction Center</div>
                @include('partials.alertMessage')
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
                                        <label class="form-control-label">Store</label>
                                        <div class="input-group input-group-merge">
                                            <select class="form-control" name="store_customer">
                                                <option value="" selected disabled>None selected</option>
                                                    @isset($stores)
                                                    @foreach ($stores as $store)
                                                    <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-4 mt-4 d-none">
                                    <label class="form-control-label">Customer</label>
                                    <div class="input-group input-group-merge">
                                       <select class="form-control" name="customer">
                                            <option>--Select Transaction--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-4 mt-4 d-none">
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

                               
                            </div>

                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <div class="card">
        <div class="card-header">
            <div class="h5">All Transactions</div>
        </div>

        <div class="card-body">
            <div class="table-responsive table-data">
            <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Ref Id</th>
                        <th>Ref Transaction Type</th>
                        <th>Customer Ref Code</th>
                        <th>Total Amount</th>
                        <th> Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
             </table>
               
            </div>
        </div>
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
                <form class="form-horizontal" id="addTransaction" method="POST"
                    action="{{ route('transaction.store') }}">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="amount" class="col-3 col-form-label">Amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="interest" class="col-3 col-form-label">Interest</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="interest" name="interest"
                                placeholder="Interest">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="description" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="transaction_name" class="col-3 col-form-label">Transaction Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_name" name="transaction_name"
                                placeholder="Transaction Name">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="transaction_role" class="col-3 col-form-label">Transaction Role</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_role" name="transaction_role"
                                placeholder="transaction_role">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="transaction_type" class="col-3 col-form-label">Transaction Type</label>
                        <div class="col-9">
                            <select id="type" name="type" class="form-control">
                                <option value="Receivables">Receivables</option>
                                <option value="Paid">Paid</option>
                                <option value="Debt">Debt</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="store" class="col-3 col-form-label">Store</label>
                        <div class="col-9">
                            <select class="form-control" name="store" id="store" required>
                                <option value="" selected disabled>None selected</option>
                                @isset($stores)
                                @foreach ($stores as $store)
                                <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="customer" class="col-3 col-form-label">Customer</label>
                        <div class="col-9">
                            <select class="form-control" name="customer" id="customer" required>

                            </select>
                        </div>
                    </div>

                    {{-- <div class="form-group row mb-3">
                        <label class="col-3 col-form-label"> Status </label>
                        <div class="col-9">
                            <select class="form-control" name="status">
                                <option value="paid">Paid</option>
                                <option value="unpaid" selected>Unpaid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div> --}}

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
                <form class="form-horizontal" id="deleteTransaction" method="POST" action="">
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
                    <button type="submit" class="btn btn-danger">Yes</button>&nbsp;
                    <button class="btn btn-primary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script> 
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>

<script>
    jQuery(function ($) {
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // any initialisation options go here
        });

        var token = "{{Cookie::get('api_token')}}"
        $('select[name="store"]').on('change', function () {
            var storeID = $(this).val();
            if (storeID) {
                jQuery.ajax({
                    url: "https://dev.api.customerpay.me/store/" + encodeURI(storeID),
                    type: "GET",
                    dataType: "json",
                    contentType: 'json',
                    headers: {
                        'x-access-token': token
                    },
                    success: function (data) {
                       // console.log(data);
                        var new_data = data.data.store.customers;
                        var i;
                        for (i = 0; i < 1; i++) {
                            $('select[name="customer"]').empty();
                            $('select[name="customer"]').append('<option value="' + data
                                .data.store.customers[i]._id + '">' +
                                data.data.store.customers[i].name + '</option>');
                        }

                    }
                });
            } else {
                $('select[name="store"]').empty();
            }
        });
    });

</script>
<script>
    jQuery(function ($) {
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // any initialisation options go here
        });

        var token = "{{Cookie::get('api_token')}}"
        $('select[name="store_customer"]').on('change', function () {
            //console.log(('select[name="store_customer"]').val())
            var storeID = $(this).val();
            if (storeID) {
                jQuery.ajax({
                    url: "https://dev.api.customerpay.me/transaction/store/" + encodeURI(storeID),
                    type: "GET",
                    dataType: "json",
                    contentType: 'json',
                    headers: {
                        'x-access-token': token
                    },
                    success: function (data1) {
                        
                                var nid = 0;
                                var result;
                                jQuery.each(data1.data, function(key, item){
                                    for( nid = 0; nid < item.length; nid++){
                                        var show_url ="{{ route('transaction.show', 'item[nid]._id')}}";
                                        var edit_url = "{{ route('transaction.edit', 'item[nid]._id')}}"
                                        var delete_url = "{{ route('transaction.destroy', 'item[nid]._id')}}"
                                    //console.log(item[nid]);
                                     result = result +
                        
                        '<tr>' +
                            '<td>' + item[nid]._id + '</td>' +
                            '<td>' + item[nid].type + '</td>' +
                            '<td>' + item[nid].customer_ref_id + '</td>' +
                            '<td>' + item[nid].total_amount + '</td>' +
                            '<td>' + '<div class="btn-group mt-2 mr-1">' + '<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions<i class="icon"><span data-feather="chevron-down"></span></i> </button>'+'<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="'+ show_url +'">View Transaction</a> <a class="dropdown-item" href="'+ edit_url + '">Edit Transaction</a> <a class="dropdown-item" href=" ' + delete_url + '">Delete Transaction</a> </div></td>' + 

                            
                        '</tr>';
                        
                                    }
                                    // console.log(result);
                        $(".table tbody").html(result);
                                })
                    }
                        
                        

                  
                });
            } else {
                $('#example tr').empty();
            }
        });
    });

</script>

@stop
<!-- <div class="btn-group mt-2 mr-1">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Actions<i class="icon"><span data-feather="chevron-down"></span></i>
    </button>


    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item"
            href="">View
            Transaction</a>
        <a class="dropdown-item"
            href="">Edit
            Transaction</a>
        <a class="dropdown-item"
            href="">Delete
            Transaction</a>
</div> -->



<!-- <a class="dropdown-item" href="">Edit Transaction</a> <a class="dropdown-item" href="">Delete Transaction</a> -->