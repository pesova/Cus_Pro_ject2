@extends('layout.base')

@section('content')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">

            <a href="" class="btn btn-success mr-2"><i class="far mr-2"></i>mark as paid</a>
            <a href="" data-toggle="modal" data-target="#bs-example-modal-sm2" class="btn btn-success mr-2"><i class="far mr-2 fa-edit"></i>send reminder</a>
            <a href="" data-toggle="modal" data-target="#bs-example-modal-sm" class="btn btn-success mr-2"><i class="far mr-2 fa-edit"></i>schedule remindet</a>
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
                            <h6 class="card-title border-bottom p-3 mb-0 header-title">Deptor Overview</h6>
                            <div class="row py-1">
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 1 -->
                                    <div class="media p-3">
                                        <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            {{-- <h5 class="mt-0 mb-0">{{$response ?? ''->_id}}</h5> --}}
                                            <span class="text-muted font-size-13">Ref Id.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 2 -->
                                    <div class="media p-3">
                                        <i data-feather="check-square" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                               <h4 class="mt-0 mb-0">Dept</h4>
                                            <span class="text-muted">Ref Deptor Type</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media p-3">
                                        <i data-feather="users" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0">DEPT002</h4>
                                            <span class="text-muted">Customer Ref. Code</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media p-3">
                                        <i data-feather="clock" class="align-self-center icon-dual icon-lg mr-4"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0">21-02-2020</h4>
                                            <span class="text-muted">Payment due in</span>
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
                        <h6 class="mt-0 header-title">Description</h6>

                        <div class="text-muted mt-3">
                            <p>desc</p>

                            <h6 class="mt-0 header-title">Financial Details</h6>


                            <ul class="pl-4 mb-4">
                            <li>Amount : </li>
                                <li>Total Amount : 3000</li>
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
                                        <h6 class="font-size-10">20/11/2020</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calendar-slash text-danger"></i> Updated At</p>
                                        <h6 class="font-size-10">20/12/2020</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-dollar-alt text-danger"></i> Total Amount</p>
                                        <h5 class="font-size-16">$3000</h5>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-user text-danger"></i>Name</p>
                                        <h5 class="font-size-16">Peso doe</h5>
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


            <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mySmallModalLabel">New Debt Reminder</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('schedule-reminder') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transaction_id" value="{{-- $debtor->_id --}}">
                                {{-- <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInput1"
                                            aria-describedby="transactionid" placeholder="Transaction ID">
                                </div> --}}
                                <div class="form-group">
                                    {{-- <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div> --}}
                                    <div class="datepicker date input-group">
                                        {{-- <label for="reservationDate">Date</label> --}}
                                        <input type="text" placeholder="Choose a date" class="form-control" id="reservationDate" name="scheduleDate" autocomplete="off">
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                            {{-- <textarea class="form-control"
                                                        id="exampleInput2" placeholder="Message"></textarea> --}}
                                    <label>Time</label>
                                    <div class="input-group time" id="timepicker">
                                        <input class="form-control" id="timepicker" placeholder="HH:MM AM/PM" name="time"/><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock"></i></span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="form-control" id="exampleInput2" placeholder="Message"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Create Reminder</button>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="bs-example-modal-sm2" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('reminder') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transaction_id" value="{{-- $debtor->_id --}}">
                               
                                <div class="form-group">
                                            {{-- <textarea class="form-control"
                                                        id="exampleInput2" placeholder="Message"></textarea> --}}
                                    <label>Message</label>
                                    <textarea name="message" class="form-control" id="exampleInput2" placeholder="Message"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Create Reminder</button>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

        </div>
    </div>
</div>

@endsection
