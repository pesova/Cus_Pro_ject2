<div id="editStoreModal-" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editStoreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStoreModalLabel">Add New Store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="submitForm" action="{{ route('store.update', $store->_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="store name">Store Name*</label>
                                <input type="text" name="store_name" class="form-control" value="{{ old('store_name', $store->store_name) }}" placeholder="XYZ Stores" required minlength="2" maxlength="16">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputTagline">Tagline*</label>
                                <input type="text" name="tagline" class="form-control" id="inputTagline" value="{{ old('tagline', $store->tagline) }}" required minlength="4" maxlength="50">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPhoneNumber">Phone Number*</label>
                                <input type="tel" class="form-control" id="phone" placeholder="8127737643" aria-describedby="helpPhone" name="" value="{{ old('phone_number', $store->phone_number) }}" required pattern=".{6,16}" title="Phone number must be between 6 to 16 characters">
                                <input type="hidden" name="phone_number" id="phone_number" class="form-control">
                                {{-- <small id="helpPhone" class="form-text text-muted">
                                    Enter your number without the starting 0, eg 813012345
                                </small> --}}
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmailAddress"> Email Address*</label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ old('email', $store->email) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address*</label>
                            <input type="text" name="shop_address" class="form-control"
                                value="{{ old('shop_address', $store->shop_address) }}" required minlength="5" maxlength="50">
                        </div>
                        <button type="submit" class="btn btn-success text-white">
                            Create Store
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
    });

    if ($("#phone").val().trim() != '')
        test.setNumber("+" + ($("#phone").val()));

    $("#phone").keyup(() => {
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
    });
    $("#submitForm").submit((e) => {
        e.preventDefault();
        const dialCode = test.getSelectedCountryData().dialCode;
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
        $("#phone_number").val(dialCode + $("#phone").val());
        $("#submitForm").off('submit').submit();
    });
</script>

@stop
