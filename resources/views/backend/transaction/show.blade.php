@extends('layout.base')

@section('content')

<div class="account-pages my-2">
    <div class="container-fluid">
        <div class="row-justify-content-center">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-0">
                            <h6 class="card-title border-bottom p-3 mb-0 header-title">Transaction Overview</h6>
                            
                            <div class="row py-1">
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 1 -->
                                    <div class="media p-3">
                                        <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0"></h5>
                                            <span class="text-muted font-size-13">Ref Id.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 2 -->
                                    <div class="media p-3">
                                        <i data-feather="check-square" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                               <h4 class="mt-0 mb-0"></h4>
                                            <span class="text-muted">Ref Transaction Type</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media p-3">
                                        <i data-feather="users" class="align-self-center icon-dual icon-sm mr-4"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0"></h4>
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


            <div class="col-xl-8 col-md-8 col-sm-8 pt-2">
                <div class="card offset-1">
                    <div class="card-body">
                        <h6 class="mt-0 header-title">Description</h6>

                        <div class="text-muted mt-3">
                            <p></p>

                            <h6 class="mt-0 header-title">Financial Details</h6>


                            <ul class="pl-4 mb-4">
                            <li>Amount : </li>
                                <li>Interest : </li>
                                <li>Total Amount : </li>
                            </ul>


                            <div class="tags">
                                <h6 class="font-weight-bold">Transaction created by:</h6>
                                <div class="text-uppercase">
                                    <a href="#" class="badge badge-soft-primary mr-2">John Doe</a>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calender text-danger"></i> Created At</p>
                                        <h6 class="font-size-10"></h6>
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
                                        <h5 class="font-size-16"></h5>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-user text-danger"></i>John Doe</p>
                                        <h5 class="font-size-16">Rick Perry</h5>
                                    </div>
                                </div>
                            </div>
                            <div>
                               
                            </div>
                            {{-- <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="float-right btn btn-danger mt-2"><i class="fas fa-trash-alt mr-2"></i>Delete transaction</a>
                            <form action="{{ route('transaction.destroy', $response->_id) }}" method="POST" id="form">
                                @method('DELETE')
                                @csrf                                                
                            </form> --}}
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
