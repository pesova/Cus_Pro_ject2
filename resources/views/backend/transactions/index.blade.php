@extends('layout.base')

@section('content')


<div class="account-pages my-5">
    <div class="container">
        <div class="row-justify-content-center">
            <div class="h2"><i data-feather="file-text" class="icon-dual"></i> Transaction Center</div>

            <div class="col-xl-12 col-md-12 col-sm-6 pt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="h5">All Transactions</div>
                    </div>

                    <div class="card-body p-1">
                        <div class="table-responsive table-data">
                            <table id="basic-datatable" class="table dt-responsive nowrap">

                                <thead>
                                    <tr>
                                        <td>Ref Id</td>
                                        <td>Ref Transaction Type</td>
                                        <td>Customer Ref Code</td>
                                        <td>Amount</td>
                                        <td>Expected Pay Date</td>
                                        <td>View more</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Paid</td>
                                        <td>C12ADS</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>


                                    </tr>
                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1D90F</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>


                                    </tr>

                                    <tr>
                                        <td>GI671B</td>
                                        <td>Debt</td>
                                        <td>C1294E</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>

                                    </tr>

                                    <tr>
                                        <td>GI671B</td>
                                        <td>Receivables</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>

                                    </tr>

                                    <tr>
                                        <td>GI671B</td>
                                        <td>Paid</td>
                                        <td>C1290D</td>
                                        <td>$500.00</td>
                                        <td>25th July, 2020</td>
                                        <td><a href="/backend/transactions/view"><i data-feather="eye"></i></a></td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
