<div id="deleteTransactionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deleteTransaction" method="POST" action="">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h6>Are you sure you want to delete this transaction?</h6>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn btn-danger">Yes</button>&nbsp;
                    <button class="btn btn-primary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>