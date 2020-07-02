@extends('layout.frontbase')
@section("custom_css")
<link href="/frontend/assets/css/debt_reminder.css" rel="stylesheet" type="text/css" />
@stop



@section('content')

<section id="main" class="faq-top">
    <div class="container">
        <div class="faq-top__content text-center">
            <h1 class="faq-top__title">Debt Reminder</h1>
            <input type="search" name="search-faq" id="search-faq" class="form-control"
                placeholder="Search by Name" aria-placeholder="Search by name">
            <button class="faq-top__btn">Search</button>
        </div>
    </div>
    <!-- background vectors -->
    <div class="faq-bg__left">
        <img src="/frontend/assets/img/faq-bg/orange-cutout.png" alt="orange-cutout"
            class="faq-bg__orange-cutout img-fluid">
        <img src="/frontend/assets/img/faq-bg/yellow-cutout.png" alt="yellow-cutout"
            class="faq-bg__yellow-cutout img-fluid">
    </div>
    <div class="faq-bg__right">
        <img src="/frontend/assets/img/faq-bg/blue-cutout.png" alt="blue-cutout"
            class="faq-bg__blue-cutout img-fluid">
        <img src="/frontend/assets/img/faq-bg/orange-triangle-cutout.png" alt="orange-triangle-cutout"
            class="faq-bg__orange-triangle-cutout img-fluid">
    </div>
</section>

<div class="container">
    <h2 class="due">Pay Now</h2>
    <table class="table table-borderless">
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Day</th>
        <th scope="col">Name</th>
        <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th class="y-bullet" scope="row">1</th>
        <td>Today</td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
        <tr>
        <th class="y-bullet" scope="row">2</th>
        <td>Today</td>
        <td>Jane Doe</td>
        <td>#30,000</td>
        </tr>
        <tr>
        <th class="y-bullet" scope="row">3</th>
        <td>Tomorrow</td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
        <tr>
        <th class="y-bullet" scope="row">4</th>
        <td>Tomorrow</td>
        <td>Jane Doe</td>
        <td>#30,000</td>
        </tr>
    </tbody>
    </table>
</div>

<div class="container">
    <h2 class="late">Late</h2>
    <table class="table table-borderless">
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Day</th>
        <th scope="col">Name</th>
        <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th class="r-bullet" scope="row">1</th>
        <td><strong>2nd June</strong></td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
        <tr>
        <th class="r-bullet" scope="row">2</th>
        <td><strong>24th April</strong></td>
        <td>Jane Doe</td>
        <td>#30,000</td>
        </tr>
        <tr>
        <th class="r-bullet" scope="row">3</th>
        <td><strong>23rd March</strong></td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
    </tbody>
    </table>
</div>


<div class="last container">
    <h2 class="upcoming">Upcoming</h2>
    <table class="table table-borderless">
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Day</th>
        <th scope="col">Name</th>
        <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th class="w-bullet" scope="row">1</th>
        <td><strong>31st Nov</strong></td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
        <tr>
        <th class="w-bullet" scope="row">2</th>
        <td><strong>20th Dec</strong></td>
        <td>Jane Doe</td>
        <td>#30,000</td>
        </tr>
        <tr>
        <th class="w-bullet" scope="row">3</th>
        <td><strong>25th Dec</strong></td>
        <td>John Doe</td>
        <td>#35,000</td>
        </tr>
    </tbody>
    </table>
</div>

@endsection


@section("javascript")


@stop
