@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('/backend/assets/css/store_list.css') }}">
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="h4"><i data-feather="file-text" class="icon-dual"></i> Transaction Center</div>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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
                                            <input type="text" class="form-control" id="">
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
                                        <input type="text" class="form-control" id="Cus">
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
                            <th> Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @isset($response)
                        {{-- {{dd($details)}} --}}
                        @foreach ($response->data->transactions as $transactions)
                        {{-- {{dd($transactions)}} --}}
                        <tr>
                            @foreach($transactions->transactions as $index => $transaction)
                            <td>{{ $index + 1 }}</td>
                            <td>{{$transaction->type }}</td>
                            <td>{{$transaction->customer_ref_id }}</td>
                            <td>{{$transaction->total_amount}}</td>
                            <td>
                                <div class="btn-group mt-2 mr-1">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                            href="{{ route('transaction.show', $transaction->_id) }}">View
                                            Transaction</a>
                                        <a class="dropdown-item"
                                            href="{{ route('transaction.edit', $transaction->_id) }}">Edit
                                            Transaction</a>
                                        <a class="dropdown-item"
                                            href="{{ route('transaction.destroy', $transaction->_id) }}">Delete
                                            Transaction</a>
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
    </div>
</div>
</div>

@include('backend.transaction.modal.customerModal')
@include('backend.transaction.modal.deleteTransactionModal')

@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
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
@stop
