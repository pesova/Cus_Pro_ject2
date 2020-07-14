<div id="CustomerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addTransaction" method="POST"
                    action="{{ route('transaction.store') }}">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="amount" class="col-3 col-form-label">Amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="interest" class="col-3 col-form-label">Interest</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="interest" name="interest"
                                placeholder="Interest">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="description" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="transaction_name" class="col-3 col-form-label">Transaction Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_name" name="transaction_name"
                                placeholder="Transaction Name">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="transaction_role" class="col-3 col-form-label">Transaction Role</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="transaction_role" name="transaction_role"
                                placeholder="transaction_role">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="transaction_type" class="col-3 col-form-label">Transaction Type</label>
                        <div class="col-9">
                            <select id="type" name="type" class="form-control">
                                <option value="Receivables">Receivables</option>
                                <option value="Paid">Paid</option>
                                <option value="Debt">Debt</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="store" class="col-3 col-form-label">Store</label>
                        <div class="col-9">
                            <select class="form-control" name="store" id="store" required>
                                <option value="" selected disabled>None selected</option>
                                @isset($stores)
                                @foreach ($stores as $store)
                                <option value="{{ $store->_id }}">{{ $store->store_name }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="customer" class="col-3 col-form-label">Customer</label>
                        <div class="col-9">
                            <select class="form-control" name="customer" id="customer" required>

                            </select>
                        </div>
                    </div>

                    {{-- <div class="form-group row mb-3">
                        <label class="col-3 col-form-label"> Status </label>
                        <div class="col-9">
                            <select class="form-control" name="status">
                                <option value="paid">Paid</option>
                                <option value="unpaid" selected>Unpaid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-block ">Create Transaction</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
