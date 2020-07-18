@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="backend/assets/css/all_users.css">
<link rel="stylesheet" href="/backend/assets/css/complaintsLog.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/backend/assets/css/datatablestyle.css">
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        @if(Session::has('message'))
        <br>
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        <script>
            setTimeout(() => {
                document.querySelector('.alert').style.display = 'none'
            }, 3000);

        </script>
        @elseif ( $errors->any() )
        <br class='alert'>
        @foreach ( $errors->all() as $error )
        <p class="alert alert-danger">{{$error}}</p>
        @endforeach
        @endif
    </div>
</div>



<div class="container">
    <div class="content">

        <div class="container-fluid">

            <div class="row page-title">
                <div class="col-md-12">
                    <h4 class="card-header mb-1 mt-0 float-left h5">List of Registered Customers</h4>

                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#CustomerModal">
                        New &nbsp;<i class="fa fa-plus my-float"></i>
                    </a>

                </div>
            </div>

            @if ( isset($response) && count($response) > 0 )
            <div class="card-body p-1 card">
                <div class="table-responsive table-data" style="padding: 10px">
                    <table id="basic-datatable" class="table dt-responsive nowrap table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Tel</th>
                                {{-- <th>Amount Due</th> --}}
                                <th>Store Name</th>
                                <th>Actions</th>
                            </tr>

                        <tbody>
                            @for ($i = 0; $i < count($response); $i++) <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{ ucfirst($response[$i]->name) }}</td>
                                <td>{{ $response[$i]->phone_number }}</td>
                                <td>{{ $response[$i]->store_name }}</td>
                                {{-- <td>
                                                    <span> &#8358; 1 500</span> <br>
                                                    <span class="badge badge-primary">You Paid: 1000</span>
                                                </td>
                                                <td>
                                                    <span class="text-danger">&#8358; 500</span>
                                                </td> --}}
                                <td>
                                    <div class="btn-group mt-2 mr-1">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('customer.edit', $response[$i]->store_id.'-'.$response[$i]->_id) }}">Edit
                                                Customer</a>
                                            <a class="dropdown-item"
                                                href="{{ route('customer.show', $response[$i]->store_id.'-'.$response[$i]->_id) }}">View
                                                Profile</a>
                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('transaction.index') }}">View
                                            Transaction</a>
                                            <a class="dropdown-item" href="{{ route('debtor.create') }}">Send
                                                Reminder</a> --}}
                                            <form id="delete-form-{{ $response[$i]->_id }}" method="POST"
                                                action="{{ route('customer.destroy', $response[$i]->_id) }}"
                                                style="display:none">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                            </form>
                                            <a style="margin-left: 1.5rem;" class="text-danger" href="" onclick="
                                                                        if(confirm('Are you sure You want to delete this user'))
                                                                        {event.preventDefault(); document.getElementById('delete-form-{{ $response[$i]->_id }}').submit();}
                                                                        else{
                                                                        event.preventDefault();
                                                                    }"> Delete </a>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                @endfor

                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="card-body p-1 card">
                <h3 style="font-style: italic; text-align: center;">No registered customers</h3>
            </div>
            @endif
            <!-- end card -->
        </div>
    </div>

</div>

<div id="CustomerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('customer.store') }}" id="submitForm">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="inputphone" class="col-3 col-form-label">Phone Number</label>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number"
                                aria-describedby="helpPhone" name="" required pattern=".{6,16}"
                                title="Phone number must be between 6 to 16 characters">
                            <input type="hidden" name="phone_number" id="phone_number" class="form-control">
                            <small id="helpPhone" class="form-text text-muted">Enter your number without the starting 0,
                                eg 813012345</small>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Customer Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Customer name"
                                name="name" required pattern=".{5,30}"
                                title="Customer name must be at least 5 characters and not more than 30 characters">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Store Name</label>
                        <div class="col-9">
                            <!-- <input type="text" class="form-control" id="inputPassword3" placeholder="Store name"
                                name="store_name"> -->
                            <select name="store_id" class="form-control" required>
                                @if ( isset($stores) && count($stores) )
                                <option disabled selected value="">-- Select store --</option>
                                @foreach ($stores as $store)
                                <option value="{{$store->_id}}">{{$store->store_name}}</option>
                                @endforeach
                                @else
                                <option disabled selected value="">-- You have not registered a store yet --</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row mb-3">
                            <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>
                            <div class="col-9">
                                <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password" name="repassword">
                            </div>
                        </div> -->
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create Customer</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="DebtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Debtor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group row mb-3">
                        <label for="inputphone" class="col-3 col-form-label">Phone Number</label>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="inputPassword5"
                                placeholder="Retype Password">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="CreditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Creditor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group row mb-3">
                        <label for="inputphone" class="col-3 col-form-label">Phone Number</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword3" class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="inputPassword5"
                                placeholder="Retype Password">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section("javascript")

<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    $(document).ready(function () {
        $('#basic-datatable').DataTable({
            "pagingType": "full_numbers"
        });
    });

    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
        // any initialisation options go here
    })

    $("#submitForm").submit((e) => {
        e.preventDefault();
        const dialCode = test.getSelectedCountryData().dialCode;
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
        $("#phone_number").val(dialCode + $("#phone").val());
        $("#submitForm").off('submit').submit();
    });

</script>
{{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
<script>
    var customer_intro_shown = localStorage.getItem('customer_intro_shown');

    if (!customer_intro_shown) {

        const tour = new Shepherd.Tour({
            defaults: {
                classes: "shepherd-theme-arrows"
            }
        });

        tour.addStep("step", {
            text: "Welcome to Customer Page, here you can create your customers",
            buttons: [{
                text: "Next",
                action: tour.next
            }]
        });

        // tour.addStep("step2", {
        //     text: "First thing you do is create a store",
        //     attachTo: { element: ".second", on: "right" },
        //     buttons: [
        //         {
        //             text: "Next",
        //             action: tour.next
        //         }
        //     ],
        //     beforeShowPromise: function() {
        //         document.body.className += ' sidebar-enable';
        //         document.getElementById('sidebar-menu').style.height = 'auto';
        //     },
        // });
        tour.start();
        localStorage.setItem('customer_intro_shown', 1);
    }

</script>
{{-- @else --}}
@stop
