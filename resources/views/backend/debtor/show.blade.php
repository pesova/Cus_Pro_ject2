@extends('layout.base')

@section('custom_css')

@endsection

@section('content')
<div class="account-pages my-2">
    <div class="container-fluid">
        @include('partials.alert.message')
        <div class="row-justify-content-center">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-lg-5">
                            <h5 class="card-title">Debtor Overview - Created
                                {{ \Carbon\Carbon::parse($debtor->createdAt)->diffForhumans() }}</h5>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex">
                                <a href="{{ route('markpaid', $debtor->_id) }}" class="flex-1 btn btn-success mr-2">
                                    Mark as paid &nbsp;<i data-feather="check"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#sendReminderModal" class="btn btn-warning mr-3"> 
                                    Send Debt Reminder &nbsp;<i data-feather="send"></i>
                                </a>
                                <a href="#" class="btn btn-primary mr-3" data-toggle="modal" data-target="#scheduleReminderModal">
                                    Schedule Reminder &nbsp;<i data-feather="message-circle"></i>
                                </a>
                                <a href="/admin/debtor" class="flex-1 btn btn-primary go-back">
                                    Go Back &nbsp;<i data-feather="arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-xl-3 col-sm-6 p-2">
                            <div class="media">
                                <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-2"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-0">{{ $debtor->_id }}</h6>
                                    <span class="text-muted font-size-13">Debt Reference code</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-2">
                            <div class="media">
                                <i data-feather="check-square" class="align-self-center icon-dual icon-sm mr-2"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-0 text-capitalize">{{ $debtor->type }}</h6>
                                    <span class="text-muted">Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-2">
                            <div class="media">
                                <i data-feather="users" class="align-self-center icon-dual icon-sm mr-2"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-0 text-capitalize">
                                        <a
                                            href="{{ route('customer.show', $debtor->store_ref_id.'-'.$debtor->customer_ref_id)}}">
                                            {{ $debtor->customer_ref_id }}
                                        </a>
                                    </h6>
                                    <span class="text-muted">Customer Ref Id</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-2">
                            <div class="media">
                                <i data-feather="clock" class="align-self-center icon-dual icon-lg mr-2"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-0 text-capitalize">
                                        {{ date_format(new DateTime($debtor->createdAt  ),'l F j, Y') }}
                                    </h6>
                                    <span class="text-muted">Payment Due</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="mt-0 ">Description</h6>
                            <textarea name="" readonly id="" cols="auto" rows="3" sty
                                class="form-control w-100 flex-1">{{ $debtor->description }}</textarea>
                        </div>

                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between">
                                <div class="list-group">
                                    <h6 class="">Financial Details</h6>

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Amount</th>
                                                    <td colspan="2">{{ $debtor->amount }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Interest</th>
                                                    <td colspan="2">{{ $debtor->interest }} % / Yr</td>
                                                </tr>
                                                <tr class="font-weight-bolder">
                                                    <th scope="row">Total Amount</th>
                                                    <td colspan="2">
                                                        {{ (($debtor->interest / 100) * $debtor->amount) + $debtor->amount }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for send reminder --}}
            @include('partials.modal.sendReminder')

            {{-- Modal for schedule reminder --}}
            @include('partials.modal.scheduleReminder')

        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('/backend/assets/js/textCounter.js')}}"></script>
@endsection
