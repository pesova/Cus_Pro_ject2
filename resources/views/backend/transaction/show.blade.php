@extends('layout.base')
@section("custom_css")
<link rel="stylesheet" href="{{ asset('/backend/assets/css/transac.css') }}">
@stop
@section('content')

<div class="account-pages my-2">
    <div class="container-fluid">
        <div class="row-justify-content-center">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between px-4 py-2 border-bottom align-items-center">
                                <div>
                                    <h4 class="card-title">Transaction Overview</h4>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary mr-3" data-toggle="modal"
                                        data-target="#editTransactionModal"> Edit &nbsp;<i data-feather="edit-3"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#exampleModal" href="" class="btn btn-danger">
                                        Delete &nbsp;<i data-feather="delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 1 -->
                                    <div class="media">
                                        <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0">{{ $transaction->_id }}</h5>
                                            <span class="text-muted font-size-13">Ref Id.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 2 -->
                                    <div class="media">
                                        <i data-feather="check-square"
                                            class="align-self-center icon-dual icon-sm mr-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0 text-capitalize">{{ $transaction->type }}</h5>
                                            <span class="text-muted">Ref Transaction Type</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media">
                                        <i data-feather="users" class="align-self-center icon-dual icon-sm mr-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0">{{ $transaction->customer_ref_id }}</h5>
                                            <span class="text-muted">Customer Ref. Code</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <!-- stat 3 -->
                                    <div class="media">
                                        <i data-feather="clock" class="align-self-center icon-dual icon-lg mr-2"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0">{{ \Carbon\Carbon::parse($transaction->expected_pay_date)->diffForhumans() }}</h4>
                                            <span class="text-muted">Payment Due</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 col-md-12 col-sm-12 pt-2">
                <div class="card offset-1">
                    <div class="card-body">

                        <div class="text-muted">
                            <div class="d-flex">
                                <div class="col-md-8">
                                    <h6 class="mt-0 header-title">Description</h6>
                                    <textarea name="" readonly id="" cols="auto" rows="5" sty
                                        class="form-control w-100 flex-1">{{ $transaction->description }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="tags mb-5">
                                        <h6 class="font-weight-bold">Store Name:</h6>
                                        <a href="{{ route('store.show', $transaction->store_ref_id)}}"
                                            class="mr-2 text-uppercase">
                                            {{ $transaction->store_name }}
                                        </a>
                                    </div>

                                    <div class="tags mt-5">
                                        <h6 class="font-weight-bold">Transaction Status:
                                        </h6>
                                        <label class="switch">
                                            <input type="checkbox" id="togBtn"
                                                {{ $transaction->status == true ? 'checked' : '' }}
                                                data-id="{{ $transaction->_id }}"
                                                data-store="{{ $transaction->store_ref_id }}"
                                                data-customer="{{ $transaction->customer_ref_id}}">
                                            <div class="slider round">
                                                <span class="on">Paid</span><span class="off">Pending</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="mt-0 header-title">Financial Details</h6>
                                <ul class="pl-4 mb-4">
                                    <li>Amount : {{ $transaction->amount }}</li>
                                    <li>Interest : {{ $transaction->interest }} % / Yr</li>
                                    <li>Total Amount :
                                        {{ floor($transaction->amount/100+12 * $transaction->interest + $transaction->amount) }}
                                    </li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calender text-danger"></i> Created</p>
                                        <h6 class="font-size-10">
                                            {{ \Carbon\Carbon::parse($transaction->createdAt)->diffForhumans() }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-calendar-slash text-danger"></i> Updated At</p>
                                        <h6 class="font-size-10">
                                            {{ \Carbon\Carbon::parse($transaction->updatedAt)->diffForhumans() }}</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-dollar-alt text-danger"></i> Total Amount</p>
                                        <h5 class="font-size-16">
                                            {{ floor($transaction->amount/100+12 * $transaction->interest + $transaction->amount) }}
                                        </h5>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="mt-4">
                                        <p class="mb-2"><i class="uil-user text-danger"></i>Customer</p>
                                        @foreach ($stores as $store)
                                        @foreach ($store->customers as $customer)
                                        @if ($customer->_id === $transaction->customer_ref_id)
                                        <a href="{{ route('customer.show', $transaction->store_ref_id.'-'.$transaction->customer_ref_id)}}"
                                            class="">
                                            <h5 class="font-size-16">{{ $customer->name }}</h5>
                                        </a>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="editTransactionModal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="editTransactionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTransactionLabel">Update Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="editTransaction" method="POST"
                                action="{{ route('transaction.update', $transaction->_id.'-'.$transaction->store_ref_id.'-'.$transaction->customer_ref_id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-3">
                                    <label for="amount" class="col-3 col-form-label">Amount</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            placeholder="0000.00" value="{{$transaction->amount}}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="interest" class="col-3 col-form-label">Interest</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="interest"
                                            value="{{ old('interest', $transaction->interest) }}" name="interest"
                                            placeholder="0%">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="description" class="col-3 col-form-label">Description</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="description"
                                            value="{{ old('description', $transaction->description) }}"
                                            name="description" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="transaction_type" class="col-3 col-form-label">Transaction Type</label>
                                    <div class="col-9">
                                        <select class="form-control" id="type" name="type">
                                            <option value="paid"
                                                {{ old('type', $transaction->status) == 'paid' ? 'selected' : '' }}>
                                                Paid</option>
                                            <option value="debt"
                                                {{ old('type', $transaction->status) == 'debt' ? 'selected' : '' }}>
                                                Debt</option>
                                            <option value="receivable"
                                                {{ old('type', $transaction->status) == 'receivable' ? 'selected' : '' }}>
                                                Receivable
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="store" class="col-3 col-form-label">Store</label>
                                    <div class="col-9">
                                        <select name="store" class="form-control">
                                            @if ($store->storeId === $transaction->store_ref_id)
                                            <option class="text-uppercase form-control" value="{{ $store->storeId }}">
                                                {{ $store->storeName }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="customer" class="col-3 col-form-label">Customer</label>
                                    <div class="col-9">
                                        <select name="customer" class="form-control">
                                            @foreach ($store->customers as $customer)
                                            @if ($customer->_id === $transaction->customer_ref_id)
                                            <option class="text-uppercase form-control" value="{{ $customer->_id }}">
                                                {{ $customer->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-3 col-form-label"> Status </label>
                                    <div class="col-9">

                                        <select class="form-control" name="status">
                                            <option value="1">Paid</option>
                                            <option value="0" selected>Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-0 justify-content-end row">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-primary btn-block ">
                                            Update Transaction
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST"
                action="{{route('transaction.destroy', $transaction->_id.'-'.$transaction->store_ref_id.'-'.$transaction->customer_ref_id)}}">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <h6>Are you sure you want to delete this transaction</h6>
                </div>
                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class="btn btn-primary mr-3" data-dismiss="modal"><i data-feather="x"></i>
                            Close</button>
                        <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i> Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
