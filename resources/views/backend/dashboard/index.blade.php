@extends('layout.base')

@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row page-title align-items-center">
            <div class="col-sm-4 col-xl-6">
                <h4 class="mb-1 mt-0">Dashboard</h4>
                {{-- {{ print_r($response) }} --}}
            </div>
            {{-- Not needed all require extra code --}}
            {{-- <div class="col-sm-8 col-xl-6">
                <form class="form-inline float-sm-right mt-3 mt-sm-0">
                    <div class="form-group mb-sm-0 mr-2">
                        <input type="text" class="form-control" id="dash-daterange" style="min-width: 190px;" />
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-file-alt mr-1"></i>Export Report <i class="icon"><span data-feather="chevron-down"></span></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item notify-item">
                                <i data-feather="mail" class="icon-dual icon-xs mr-2"></i>
                                <span>Email</span>
                            </a>
                            <a href="#" class="dropdown-item notify-item">
                                <i data-feather="printer" class="icon-dual icon-xs mr-2"></i>
                                <span>Print</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item notify-item">
                                <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                <span>Re-Generate</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>

        <!-- content -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="media p-3">
                            <div class="media-body">
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Customers</span>
                                <h2 class="mb-0 my-customers"> 
                                    {{-- @if ($response != null)
                                        {{ count($response[1]->data) }}
                                    @else
                                        NaN
                                    @endif --}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="media p-3">
                            <div class="media-body">
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Stores</span>
                                <h2 class="mb-0 my-stores"> 
                                    {{-- @if ($response != null)
                                        {{ count($response[3]->data->stores) }}
                                    @else
                                        NaN
                                    @endif --}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="media p-3">
                            <div class="media-body">
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Assistants</span>
                                <h2 class="mb-0 my-assistants"> 
                                    {{-- @if ($response != null)
                                        {{ count($response[4]->data->assistants) }}
                                    @else
                                        NaN
                                    @endif --}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="media p-3">
                            <div class="media-body">
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Debtors</span>
                                <h2 class="mb-0 my-debtors"> 0
                                    {{-- @if ($response != null)
                                        {{ count($response[2]->data->debts) }}
                                    @else
                                        NaN
                                    @endif --}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- products -->
        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Recent Transactions</h5>

                        <div class="table-responsive mt-4">
                            <table class="table table-hover table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>

                                <tbody class="my-transactions">
                                  
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive-->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body pt-2">
                        <h5 class="mb-4 header-title">Latest Debts</h5>

                        {{-- @if ($response != null)
                            @if (count($response[2]->data->debts) > 0)
                                @if (count($response[2]->data->debts) > 7)
                                    @for ($i = 0; $i < 7; $i++) --}}
                                        {{-- <div class="media mt-1 border-top pt-3">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">{{ $response[2]->data->debts[$i]->pay_date }}</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">{{ $response[2]->data->debts[$i]->pay_date }}</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-edit-alt mr-2"></i>View</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                    {{-- @endfor
                                @else
                                    {{ $i = 0 }}
                                    @foreach ($response[2]->data->debts as $transaction) --}}
                                        {{-- <div class="media mt-1 border-top pt-3">
                                            <div class="media-body">
                                                <h6 class="mt-1 mb-0 font-size-15">Some Title</h6>
                                                <h6 class="text-muted font-weight-normal mt-1 mb-3">{{ $response[2]->data->debts[$i]->pay_date }}</h6>
                                            </div>
                                            <div class="dropdown align-self-center float-right">
                                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-edit-alt mr-2"></i>View</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- {{ $i++ }}
                                    @endforeach
                                @endif
                            @else
                                <h5>No recent debtors</h5>
                            @endif
                        @else
                            <h5>Error while fetching data. <a href="">Refresh Page</a></td>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection

@section("javascript")
{{-- <script src="/backend/assets/js/pages/dashboard.js"></script> --}}

<script>
  document.addEventListener('DOMContentLoaded', getDashboard);

  async function getDashboard() {

    let apiToken = "{{\Illuminate\Support\Facades\Cookie::get('api_token')}}";

    const res = await fetch(`https://dev.api.customerpay.me/dashboard?token=${apiToken}`);
    const dash = await res.json();

    let myCustomers = document.querySelector('.my-customers');
    let myStores = document.querySelector('.my-stores');
    let myAssistants = document.querySelector('.my-assistants');
    let myDebtors = document.querySelector('.my-debtors');
    let myTransactions = document.querySelector('.my-transactions')

    myCustomers.innerText = dash.data.customerCount;
    myStores.innerText = dash.data.storeCount;
    myAssistants.innerText = dash.data.assistantCount;

    if (dash.data.transactions.length == 0) {
      document.querySelector('.table-responsive').innerHTML =
      `
        <div style="display:flex; justify-content:center; border-top: 1px solid #eee; padding-top: 25px">
          <h5 style="text-align:center; margin-top: 5px">Opps, no transactions yet</h5>
        </div>
      ` 
    } else {
      dash.transactions.forEach(item => {
        myTransactions.innerHTML += 
        `
          <tr>
            <td>Input</td>
            <td>Input</td>
            <td>Input</td>
            <td>
                <a href=""><span class="badge badge-soft-warning py-1">View</span></a>
            </td>
          </tr>
        `
      });
    }
    console.log(dash)
  };
</script>

@stop
