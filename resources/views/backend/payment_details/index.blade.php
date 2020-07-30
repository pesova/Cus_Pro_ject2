@extends('backend.payment.layout.app')

@section('content')
<div class="">
    <div class="d-flex">
        <h4>From:</h4>
        <div class="ml-2">
            <h5 class="text-primary">Iro Stores</h5>
            <h5 class="text-grey">+2348136478020</h5>
        </div>
    </div>

    <div class="text-center py-3">
        <h5 class="lead">Mollit exercitation consectetur dolor occaecat sit elit fugiat ullamco duis non magna cupidatat.</h5>
    </div>

    <div class="p-5 text-center shadow-lg rounded">
        <h5 class="py-3 text-uppercase">Payment Reminder</h5>
        <h5 class="py-3 text-danger">$6,700</h5>
        <p class="lead">Occaecat aliqua anim sint anim sunt anim ut ea nulla dolore.</p>
    </div>
    <div class="">
        <a href="{{ route('pay.create') }}" class="my-3 btn btn-lg btn-primary w-100 text-white font-weight-bold">Pay
            Now</a>
        <a href="{{ route('pay') }}"
            class="my-3 btn btn-lg border border-primary w-100 text-primary font-weight-bold">Remind Me Later</a>
    </div>

    <div class="text-center p-3">
        <img src="{{ asset('frontend/assets/images/payment/check-circle.svg')}}" alt="Verified" />
        <p class="text-primary py-2 lead">Verified by myCustomer</p>
        <img src="{{ asset('frontend/assets/images/payment/android-button.svg')}}" alt="Google Play" />
    </div>
</div>

@endsection
