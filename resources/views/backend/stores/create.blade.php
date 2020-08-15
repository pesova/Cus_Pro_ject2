@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop
    @section('content')
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <a href="{{ route('store.index') }}" class="btn btn-primary">Go Back</a>
                        </nav>
                        <h4 class="mt-2">Create A Business</h4>
                    </div>
                </div>

                @include('partials.alert.message')

            </div>
        </div>

@endsection

@section("javascript")
   <script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function (success) {
            // Get your api-key at https://ipdata.co/
            fetch("https://ipinfo.io?token={{env('GEOLOCATION_API_KEY')}}")
                .then(function (response) {
                    if (!response.ok) return success("");
                    return response.json();
                })
                .then(function (ipdata) {
                    success(ipdata.country);
                }).catch(function () {
                success("NG");
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
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
