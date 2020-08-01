<div class="modal fade" id="ResendReminderModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('reminder') }}" method="POST">
                    @csrf
                    <input type="hidden" name="transaction_id" value="{{old('transaction_id', $transaction->_id)}}">
                    <input type="hidden" name="store_id" value="{{old('transaction_id', $transaction->store_ref_id)}}">
                    <input type="hidden" name="customer_id"
                        value="{{old('transaction_id', $transaction->customer_ref_id)}}">

                    <div class="form-group">
                        <label>Message</label>

                        <textarea name="message" id="R_debtMessage" rows="4" class="form-control" placeholder="Message"
                            maxlength="140"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Resend Reminder</button>
                </form>
            </div>
        </div>
    </div>
</div>
