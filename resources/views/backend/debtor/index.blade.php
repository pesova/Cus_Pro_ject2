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
        </div>
    </div>
</div>

@endsection

@section("javascript")

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    $(document).ready(function () {
        $('#debtorsTable').DataTable({});
    });

</script>
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
