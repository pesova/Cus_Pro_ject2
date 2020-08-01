
<div id="addStoreModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addStoreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStoreModalLabel">Add New Store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="submitForm" action="{{ route('store.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="store name">Store Name*</label>
                                <input type="text" name="store_name" class="form-control" value="{{ old('store_name') }}"
                                    placeholder="XYZ Stores" required minlength="3" maxlength="16">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputTagline">Tagline*</label>
                                <input type="text" name="tagline" class="form-control" id="inputTagline"
                                    value="{{ old('tagline') }}" required minlength="4" maxlength="50">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPhoneNumber">Phone Number*</label>
                                <input type="tel" style="padding-left: 2px !important;" name="" id="phone" value="{{ old('phone_number') }}" class="form-control"
                                    placeholder="8127737643" required minlength="6" maxlength="16">
                                <input type="hidden" name="phone_number" id="phone_number" class="form-control">
                                <small id="helpPhone" class="form-text text-muted">
                                    Enter your number without the starting 0, eg 813012345
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmailAddress"> Email Address*</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address*</label>
                            <input type="text" name="shop_address" class="form-control" value="{{ old('shop_address') }}"
                                required minlength="5" maxlength="50">
                        </div>
                        <button type="submit" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#exampleModal">
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
        separateDialCode: true,
        // any initialisation options go here
    });

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
