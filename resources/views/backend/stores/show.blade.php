@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop


@php
$storeData = $response['storeData'];
$transactions = $response['transactions'];
@endphp

@section('content')

<!-- Start Content-->

<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <a href="javascript: void(0);" class="btn btn-warning waves-effect waves-light"> Edit Business Card</a>

            <a href="{{ route('store.edit', $storeData->_id) }}" class="btn btn-success mr-2"><i
                    class="far mr-2 fa-edit"></i>Edit
                Store</a>
            <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"
                class="float-right btn btn-danger"><i class="fas fa-trash-alt mr-2"></i>Delete store</a>
            <form action="{{ route('store.destroy', $storeData->_id) }}" method="POST" id="form">
                @method('DELETE')
                @csrf
            </form>


        </nav>

        <h4 class="mt-2">My Store</h4>
    </div>
</div>

@if(session('data'))
<p class="alert alert-success">{{ session('data') }}</p>
@endif

<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card bg-soft-primary">
            <div>
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">{{ ucfirst($storeData->store_name) }}</h5>

                            <ul class="pl-3 mb-0">
                                <li class="py-1">Assistants: 130</li>
                                <li class="py-1">Customers: 1234</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="/backend/assets/images/profile-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-10">
                                    <i class="uil-atm-card"></i>
                                </span>
                            </div>
                            <h5 class="font-size-14 mb-0">Revenue</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4>1,452 <i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>
                            <div class="d-flex">
                                <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span
                                    class="ml-2 text-truncate">From previous Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-10">
                                    <i class="uil-atm-card"></i>
                                </span>
                            </div>
                            <h5 class="font-size-14 mb-0">Revenue</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4>$ 28,452 <i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>
                            <div class="d-flex">
                                <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span
                                    class="ml-2 text-truncate">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-10">
                                    <i class="uil-atm-card"></i>
                                </span>
                            </div>
                            <h5 class="font-size-14 mb-0">Debt</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4>$ 16.2 <i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>

                            <div class="d-flex">
                                <span class="badge badge-soft-warning font-size-12"> 0% </span> <span
                                    class="ml-2 text-truncate">From previous Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>

{{-- end --}}

<div class="row mb-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body pl-3 pr-3 padup">
                <div class="text-center">

                    Business card should be here
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4 float-sm-left">Transaction Overview</h6>
                <div class="btn-group float-right">
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
                <div class="clearfix"></div>
                <div id="transactionchart"></div>
            </div>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{ ucfirst($storeData->store_name) }} Transaction Overview</h4>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name </th>
                                    <th data-priority="1">Amount</th>
                                    <th data-priority="3">Transaction Type</th>
                                    <th data-priority="1">Status</th>
                                    <th data-priority="3"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>GOOG <span class="co-name">Google Inc.</span>
                                        <br> <span class="font-light"> Phone number</span>
                                    </th>
                                    <td>597.74</td>
                                    <td>Debt</td>
                                    <td>Paid</td>
                                    <td> <a href="javascript: void(0);"
                                            class="btn btn-primary waves-effect waves-light"> View Transaction</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    $(document).ready(function () {
    // start of transaction charts
    var options = {
    series: [{
    name: 'Likes',
    data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
    }],
    chart: {
    height: 350,
    type: 'line',
    },
    stroke: {
    width: 7,
    curve: 'smooth'
    },
    xaxis: {
    type: 'datetime',
    categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000',
    '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001'
    ,'6/11/2001'],
    },
    title: {
    text: '',
    align: 'left',
    style: {
    fontSize: "16px",
    color: '#666'
    }
    },
    fill: {
    type: 'gradient',
    gradient: {
    shade: 'dark',
    gradientToColors: [ '#FDD835'],
    shadeIntensity: 1,
    type: 'horizontal',
    opacityFrom: 1,
    opacityTo: 1,
    stops: [0, 100, 100, 100]
    },
    },
    markers: {
    size: 4,
    colors: ["#FFA41B"],
    strokeColors: "#fff",
    strokeWidth: 2,
    hover: {
    size: 7,
    }
    },
    yaxis: {
    min: -10,
    max: 40,
    title: {
    text: 'Cash Flow',
    },
    }
    };
    
    var chart = new ApexCharts(document.querySelector("#transactionchart"), options);
    chart.render();
    
    
    });
    
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // any initialisation options go here
    });
   
</script>
@stop