@extends('layout.frontbase')
@section("custom_css")
<link href="/frontend/assets/css/transactions-report.css" rel="stylesheet" type="text/css" />
@stop



@section('content')

<section class="container report">
    <div>
        <div class="row">
            <div class="col-md-9 col-lg-9">
            <div class="card 5">
                <div class="card-body">
                    <h5 class="card-title">Transactions Report</h5>
                    <p class="card-text"><span>JohnDoe Enterprises</span></p>
                    <p class="card-textx mb-5">For <span>July 1, 2020 - July 30, 2020</span></p> 

                    <p class='receivables'>Accounts Receivables (1200-1)</p>
                    <!-- <hr class='border-line'> -->
                        <table class="table table-responsive-sm table-responsive-md table-hover">
                            <thead>
                                <tr >
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction/Reference</th>
                                <th scope="col">Client</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>01-01-20</td>
                                <td>JD-0001245</td>
                                <td>Jane Doe</td>
                                <td>#100</td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>01-01-20</td>
                                <td>JD-0001245</td>
                                <td>Jane Doe</td>
                                <td>#100</td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>01-01-20</td>
                                <td>JD-0001245</td>
                                <td>Jane Doe</td>
                                <td>#100</td>
                                <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary">Button</a>
                </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="row">
                    <div class="col-md-6">
                        Filters
                    </div>
                    <div class="col-md-6">
                        Reset all
                    </div>
                </div>
                <form action="">
                    <div class="form-group">
                        <label for="date_range" class="savings-label mt-4">  Date Range</label>
                        <select  class="select2 form-control" id="date_range" required >    
                              <option value="10days">10 - 30 days</option>
                              <option value="31days">31 - 60 days</option>  
                              <option value="61 days">61 - 90 days</option>
                              <option value="91days">91days to 2years</option>
                              <option value="2years">Over 2 years</option>        
                          </select>
                    </div>

                    <div class="form-group">
                        <label for="date_range" class="savings-label mt-3">  Date Range</label>
                        <select  class="select2 form-control" id="date_range" required >    
                              <option value="10days">10 - 30 days</option>
                              <option value="31days">31 - 60 days</option>  
                              <option value="61 days">61 - 90 days</option>
                              <option value="91days">91days to 2years</option>
                              <option value="2years">Over 2 years</option>        
                          </select>
                    </div>

                    <div class="form-group">
                        <label for="date_range" class="savings-label mt-3">  Date Range</label>
                        <select  class="select2 form-control" id="date_range" required >    
                              <option value="10days">10 - 30 days</option>
                              <option value="31days">31 - 60 days</option>  
                              <option value="61 days">61 - 90 days</option>
                              <option value="91days">91days to 2years</option>
                              <option value="2years">Over 2 years</option>        
                          </select>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection


@section("javascript")


@stop
