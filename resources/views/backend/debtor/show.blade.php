@extends('layout.base')

@section('content')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <a href="" class="btn btn-success mr-2"><i class="far mr-2"></i>mark as paid</a>
            <a href="" class="btn btn-success mr-2"><i class="far mr-2 fa-edit"></i>send reminder</a>
            <a href="" class="btn btn-success mr-2"><i class="far mr-2 fa-edit"></i>schedule remindet</a>
            <a href="/admin/debtor" class="btn btn-primary">Go Back</a>
        </nav>
    </div>
</div>
<div class="account-pages my-5">
    <div class="container-fluid">
        <div class="row-justify-content-center">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-0">
                            <h6 class="card-title border-bottom p-3 mb-0 header-title">Debtor Overview</h6>
                            <div class="row py-1">
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 1 -->
                                    <div class="media p-3">
                                        <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            {{-- <h5 class="mt-0 mb-0">{{$response ?? ''->_id}}</h5> --}}
                                            <span class="text-muted font-size-13">Store Ref Id.: {{ $debts->store_ref_id }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 2 -->
                                    <div class="media p-3">
                                        <i data-feather="check-square" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                               <h4 class="mt-0 mb-0">Debt Type</h4>
                                            <span class="text-muted">{{ $debts->type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media p-3">
                                        <i data-feather="users" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0">Customer Reference ID</h4>
                                            <span class="text-muted">{{ $debts->customer_ref_id }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media p-3">
                                        <i data-feather="clock" class="align-self-center icon-dual icon-lg mr-4"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0">Payment due in</h4>
                                            <span class="text-muted">{{ date_format(new DateTime($debts->expected_pay_date),'Y-m-d') }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-8 col-md-8 col-sm-8 pt-5">
                <div class="card offset-1">
                    <div class="card-body">
                        <h6 class="mt-0 header-title">Description: {{ $debts->description }}</h6>

                        <div class="text-muted mt-3">
                            <p>desc</p>

                            <h6 class="mt-0 header-title">Financial Details</h6>

                            <ul class="pl-4 mb-4">
                            <li>Amount : {{$debts->amount}}</li>
                                <li>Total Amount : ${{ $debts->total_amount }}</li>
                            </ul>


                            <div class="tags">
                                <h6 class="font-weight-bold">Deptor created by:</h6>
                                <div class="text-uppercase">
                                    <a href="#" class="badge badge-soft-primary mr-2">Peso Doe</a>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calender text-danger"></i> Created At</p>
                                        <h6 class="font-size-10">{{ date_format(new DateTime($debts->createdAt),'Y-m-d') }}</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calendar-slash text-danger"></i> Updated At</p>
                                        <h6 class="font-size-10">{{ date_format(new DateTime($debts->updatedAt),'Y-m-d') }}</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-dollar-alt text-danger"></i> Total Amount</p>
                                        <h5 class="font-size-16">${{ $debts->total_amount }}</h5>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-user text-danger"></i>Assistant in Charge</p>
                                        <h5 class="font-size-16">{{ $debts->assistant_inCharge }}</h5>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="assign team mt-4">
                                <h6 class="font-weight-bold">Assign To</h6>
                                <a href="javascript: void(0);">
                                    <img src="backend/assets/images/users/avatar-2.jpg" alt="" class="avatar-sm m-1 rounded-circle">
                                </a>
                            </div> --}}



                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
