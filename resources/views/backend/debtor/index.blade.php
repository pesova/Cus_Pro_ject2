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
        <div class="mb-0 d-flex justify-content-between align-items-center page-title">
            <div class="h6"><i data-feather="file-text" class="icon-dual"></i> Debtors Center</div>
            @if(!is_store_assistant())
                <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTransactionModal">
                    New &nbsp;<i class="fa fa-plus my-float"></i>
                </a>
                @include('partials.modal.addTransaction',['title'=>'Add New Debt','type'=>'debt','buttonText'=>'Add Debt'])
            @endif
        </div>
        @include('partials.alert.message')
        @if(!is_super_admin())
        <div class="card">
            <div class="card-body">
                <p class="sub-header">
                    Find debtors by business name
                </p>
                <div class="container-fluid">
                    @isset($stores)
                    <form action="{{ route('debtor.index') }}" method="GET">
                        <div class="form-group col-lg-6 mt-4">
                            <label class="form-control-label">Business Name</label>
                            <div class="input-group input-group-merge">
                                <select name="store_id" class="form-control">
                                    <option value="" selected disabled>None selected</option>

                                    @foreach ($stores as $adminStore )
                                    <option value="{{ $adminStore->_id }}">{{ $adminStore->store_name }}</option>
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
        @endif
        <div class="card mt-0">
            <div class="card-header">
                <div class="btn-group">
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
            </div>
            <div class="card-body">
                <div class="table-responsive table-data">
                    <table id="debtorsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Debt ID</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Created</th>
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
                                        href="{{ route('debtor.show', $debtor->_id) }}">
                                        {{ $debtor->_id }}
                                    </a>
                                </td>
                                </td>
                                <td>
                                    @if($debtor->status == false)
                                    <span class="badge badge-danger">Unpaid</span>
                                    @else
                                    <span class="badge badge-success">Paid</span>
                                    @endif
                                </td>
                                <td>{{ $debtor->description }}</td>
                                <td>{{ format_money($debtor->total_amount, $debtor->currency) }}</td>
                                <td> {!! app_format_date($debtor->date_recorded) !!}</td>
                                <td>
                                    <a class="btn btn-info btn-small py-1 px-2"
                                        href="{{ route('debtor.show', $debtor->_id) }}">
                                        More
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("javascript")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js">
</script>
<script>
    $(document).ready(function () {
        var export_filename = 'Mycustomerdebts';
        $('#debtorsTable').DataTable({
            dom: 'frtipB',
            buttons: [{
                extend: 'excel',
                className: 'd-none',
                title: export_filename,
            }, {
                extend: 'pdf',
                className: 'd-none',
                title: export_filename,
                extension: '.pdf'
            }]
        });
        $("#ExportReporttoExcel").on("click", function () {
            $('.buttons-excel').trigger('click');
        });
        $("#ExportReporttoPdf").on("click", function () {
            $('.buttons-pdf').trigger('click');
        });

        const token = "{{Cookie::get('api_token')}}"
        const host = "{{ env('API_URL', 'https://dev.api.customerpay.me') }}";

        $('select[name="store"]').on('change', function () {
            var storeID = $(this).val();
            var host = "{{ env('API_URL', 'https://dev.api.customerpay.me') }}";

            if (storeID) {
                $('select[name="customer"]').empty();
                jQuery.ajax({
                    url: host + "/store/" + encodeURI(storeID),
                    type: "GET",
                    dataType: "json",
                    contentType: 'json',
                    headers: {
                        'x-access-token': token
                    },
                    success: function (data) {
                        var new_data = data.data.store.customers;
                        var i;
                        new_data.forEach(customer => {
                            $('select[name="customer"]').append('<option value="' +
                                customer._id + '">' +
                                customer.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="store"]').empty();
            }
        });
    });

</script>

{{-- <script>
    var debtors_intro_shown = localStorage.getItem('debtors_intro_shown');

    if (!debtors_intro_shown) {

        const tour = new Shepherd.Tour({
            defaults: {
                classes: "shepherd-theme-arrows"
            }
        });

        tour.addStep("step", {
            text: "Welcome to debtors Page, here you can record and track your debtors",
            buttons: [{
                text: "Next",
                action: tour.next
            }]
        });

        tour.start();
        localStorage.setItem('debtors_intro_shown', 1);
    }

</script> --}}
{{-- @else --}}
@stop
