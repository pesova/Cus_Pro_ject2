@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
<<<<<<< HEAD
        <div class="mb-0 d-flex justify-content-between align-items-center page-title">
            <div class="h6"><i data-feather="file-text" class="icon-dual"></i> Debtors Center</div>
        </div>
        @include('partials.alertMessage')

        <div class="card">
            <div class="card-body">
                <p class="sub-header">
                    Find debtors by store name
                </p>
                <div class="container-fluid">
                    @isset($stores)
                    <form action="{{ route('debtor.index') }}" method="GET">
                        <div class="form-group col-lg-6 mt-4">
                            <label class="form-control-label">Store Name</label>
                            <div class="input-group input-group-merge">

                                <select name="store_id" class="form-control">
                                    <option value="" selected disabled>None selected</option>

                                    @foreach ($stores as $index => $store )
                                    <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                    @endforeach

                                </select>
                                <button type="search" class="mx-2 btn btn-primary">Search</button>
                                <a href="{{ route('debtor.index') }}" class="btn btn-primary">All Debtors</a>
                            </div>
                        </div>
                    </form>
                    @endisset
                </div>
            </div>
        </div>

        <div class="card mt-0">
            <div class="card-header">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='uil uil-file-alt mr-1'></i>Export
                        <i class="icon"><span data-feather="chevron-down"></span></i></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item notify-item">
                            <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                            <span>Excel</span>
                        </a>
                        <a href="#" class="dropdown-item notify-item">
                            <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                            <span>PDF</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-data">
                    <table id="debtorsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction Ref ID</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($debtors)
                            @foreach ($debtors as $index => $debtor )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a class=""
                                        href="{{ route('transaction.show', $debtor->_id.'-'.$debtor->store_ref_id.'-'.$debtor->customer_ref_id) }}">
                                        {{ $debtor->_id }}
                                    </a>
                                </td>
                                <td>
                                    @if($debtor->status == false)
                                    <span class="badge badge-danger">Unpaid</span>
                                    @else
                                    <span class="badge badge-success">Paid</span>
                                    @endif
                                </td>
                                <td>{{ $debtor->description }}</td>
                                <td>{{ $debtor->amount }}</td>

                                <td> {{ \Carbon\Carbon::parse($debtor->createdAt)->diffForhumans() }}</td>
                                <td>
                                    <a class="btn btn-info btn-small py-1 px-2"
                                        href="{{ route('debtor.show', $debtor->_id) }}">
                                        View More
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
=======
        <div class="row page-title">
            <div class="col-md-12">
                <h4 class="mb-1 mt-0">Debtors</h4>
        </div>
    </div>
</div>
@include('partials.alertMessage')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="sub-header">
                        Filter debtors by store name
                    </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container-fluid pull-left">
                                @isset($stores)
                                <form action="{{ route('debt.search') }}" method="GET">
                                    <div class="form-group mt-4">
                                        <div class="input-group input-group-merge">

                                            <select name="store_id" class="form-control">
                                                <option value="" selected disabled>None selected</option>

                                                @foreach ($stores as $index => $store )
                                                <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                                @endforeach

                                            </select>
                                            <button type="search" class="btn btn-primary">Select</button>
                                        </div>
                                    </div>
                                </form>
                                @endisset
                            </div>
                            </div>
                            <div class="col-md-6">
                                <p class="sub-header">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class='uil uil-file-alt mr-1'></i>Export
                                            <i class="icon"><span data-feather="chevron-down"></span></i></button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button id="ExportReporttoExcel" class="dropdown-item notify-item">
                                                <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                                <span>Excel</span>
                                            </button>
                                            <button id="ExportReporttoPdf" class="dropdown-item notify-item">
                                                <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                                <span>PDF</span>
                                            </button>
                                        </div>
                                    </div>
                                </p>
                            </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- For store admin -->
    <div class="row">
        <div class="col-12">
                    {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-data">
                        <table class="table table-striped nowrap table-bordered" id="debtor-datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Store</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Description</th>
                                    <th scope="col"> Amount</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Due</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debtors as $key => $debtor)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>
                                       <a class="" href="{{ route('store.show', $debtor->store_ref_id) }}">
                                        @foreach($stores as $store)
                                            @if($store->_id ==  $debtor->store_ref_id )
                                            {{ $store->store_name }}
                                            @break
                                            @endif
                                        @endforeach
                                        </a>
                                    </td>
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
                                    <td>
                                        @if (\Carbon\Carbon::parse($debtor->expected_pay_date)->isPast())
                                        <span
                                            class="badge badge-soft-danger">{{ \Carbon\Carbon::parse($debtor->expected_pay_date)->diffForhumans() }}</span>
                                        @else
                                        @if (\Carbon\Carbon::parse($debtor->expected_pay_date)->isToday())
                                        <span
                                            class="badge badge-soft-warning">{{ \Carbon\Carbon::parse($debtor->expected_pay_date)->diffForhumans() }}</span>
                                        @endif
                                        <span
                                            class="badge badge-soft-success">{{ \Carbon\Carbon::parse($debtor->expected_pay_date)->diffForhumans() }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-small py-1 px-2"
                                            href="{{ route('transaction.show', $debtor->_id.'-'.$debtor->store_ref_id.'-'.$debtor->customer_ref_id) }}">
                                            View More
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
    <span
        class="badge badge-{{ ($debtor->debt_obj->status == 'unpaid') ? 'danger' : 'success' }}">{{ $debtor->debt_obj->status }}</span>
</td>
<td>
    {{ $debtor->debt_obj->message }}
</td>
<td>
    {{ date_format(new DateTime($debtor->debt_obj->expected_pay_date  ),'Y-m-d') }}
</td>

<td>
    <div class="btn-group mt-2 mr-1">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Actions<i class="icon"><span data-feather="chevron-down"></span></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('debtor.show',[$debtor->debt_obj->_id]) }}">View</a>
            <a class="dropdown-item" href="{{ route('debtor.edit',[$debtor->debt_obj->_id]) }}">Edit</a>
            <a class="dropdown-item" href="{{ route('debtor.edit',[$debtor->debt_obj->_id]) }}" data-toggle="modal"
                data-target="#bs-example-modal-sm2">
                Update Status
            </a>
            <form action="{{ route('debtor.destroy',[$debtor->debt_obj->_id]) }}" method="post">
                <input type="hidden" name="store_name" value="{{ $debtor->store_name }}">
                <input type="hidden" name="customer_phone_number"
                    value=" {{ $debtor->debt_obj->customer_phone_number }}">
                <input class="dropdown-item" type="submit" value="Delete" />
                @method('delete')
                @csrf
            </form>
>>>>>>> 745591df9d1eccfed29b3636e54bc57c65a34674
        </div>
    </div>
</div>

@endsection

@section("javascript")
<<<<<<< HEAD

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    $(document).ready(function () {
        $('#debtorsTable').DataTable({});
    });

</script>
=======
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var export_filename = 'Mycustomerdebts';
        $('#debtor-datatable').DataTable( {
            dom: 'Bftrip',
            buttons:[
                {
                    extend: 'excel',
                    className: 'd-none',
                    title: export_filename,
                }, {
                    extend: 'pdf',
                    className: 'd-none',
                    title: export_filename,
                    extension: '.pdf'
                }
            ]
        } );
        $("#ExportReporttoExcel").on("click", function() {
            $( '.buttons-excel' ).trigger('click');
        });
        $("#ExportReporttoPdf").on("click", function() {
            $( '.buttons-pdf' ).trigger('click');
        });
        } );
</script>

{{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
>>>>>>> 745591df9d1eccfed29b3636e54bc57c65a34674
<script>
    var debtors_intro_shown = localStorage.getItem('debtors_intro_shown');

    if (!debtors_intro_shown) {

        const tour = new Shepherd.Tour({
            defaults: {
                classes: "shepherd-theme-arrows"
            }
        });

        tour.addStep("step", {
            text: "Welcome to debtors Page, here you can track your debtors",
            buttons: [{
                text: "Next",
                action: tour.next
            }]
        });

        tour.start();
        localStorage.setItem('debtors_intro_shown', 1);
    }

</script>
{{-- @else --}}
@stop
