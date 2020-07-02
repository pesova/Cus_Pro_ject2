@extends('layout.frontbase')
@section("custom_css")
<link href="/frontend/assets/css/transactions-report.css" rel="stylesheet" type="text/css" />
@stop



@section('content')

<section class="container report">
    <div>
        <div class="row">
            <div class="col-md-8 col-lg-8">
            <div class="card 5">
                <div class="card-body">
                    <h5 class="card-title">Transactions Report</h5>
                    <p class="card-text"><span>JohnDoe Enterprises</span></p>
                    <p class="card-textx mb-5">For <span>July 1, 2020 - July 30, 2020</span></p> 

                    <p >Accounts Receivables (1200-1)</p>
                    <hr class='border-line'>
                        <table class="table table-responsive-sm table-responsive-md table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary">Button</a>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
            2 of 2
            </div>
        </div>
    </div>
</section>

@endsection


@section("javascript")


@stop
