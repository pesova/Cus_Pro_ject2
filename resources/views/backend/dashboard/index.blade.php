@extends('layout.base')

@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

@stop

@if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'store_admin')

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
                                <h2 class="mb-0 my-debtors"> 
                              
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
                    <div class="card-body pt-2">
                      <h5 class="mb-4 header-title">Recent Transactions</h5>       
                      <div style="display:flex; justify-content:center; text-align:center; width:100%" class='mt-2 mb-3 trans-error'>
                        
                      </div>

                        <div class="table-responsive mt-4 trans-table dissapear">

                            <table class="table table-hover table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Store Name</th>
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
                        <div style="display:flex; justify-content:center; text-align:center; width:100%" class='mt-2 mb-3 debts-error'>
                          
                        </div>

                        <div class="debts-table dissapear">

                        </div>
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
        document.addEventListener('DOMContentLoaded', makeRequest);

        async function getDashboard() {

          let apiToken = "{{\Illuminate\Support\Facades\Cookie::get('api_token')}}";

          // const res = await fetch(`https://dev.api.customerpay.me/dashboard?token=${apiToken}`);
          const res = await fetch(`{{env('API_URL')}}/dashboard?token=${apiToken}`);
          const dash = await res.json();

          let myCustomers = document.querySelector('.my-customers');
          let myStores = document.querySelector('.my-stores');
          let myAssistants = document.querySelector('.my-assistants');
          let myDebtors = document.querySelector('.my-debtors');
          let myTransactions = document.querySelector('.my-transactions');
          let debtList = document.querySelector('.debts-table');

          myCustomers.innerText = dash.data.customerCount;
          myStores.innerText = dash.data.storeCount;
          myAssistants.innerText = dash.data.assistantCount;
          myDebtors.innerText = dash.data.recentDebts.length

          if (dash.data.recentTransactions.length == 0) {
          document.querySelector('.trans-error').classList.add('dissapear');
          document.querySelector('.trans-table').classList.remove('dissapear');
          
          document.querySelector('.trans-table').innerHTML =
          `   <span style='width:100%; border-bottom:1px solid #eee; height: 1px'></span>
              <div style="display:flex; justify-content:center;" class='mt-4 mb-3'>
              You haven't made any transactions yet
              </div>
          `
          } else {

          document.querySelector('.trans-error').classList.add('dissapear');
          document.querySelector('.trans-table').classList.remove('dissapear');

          dash.data.recentTransactions.forEach((item, index) => {
              let output =
              `
              <tr>
                  <td>${index}</td>
                  <td>${item.transaction.type}</td>
                  <td>${item.storeName}</td>
                  <td>N${item.transaction.amount}</td>
                  <td>
                      <a href="/admin/transaction/${item.transaction._id}-${item.transaction.store_ref_id}-${item.transaction.customer_ref_id}"><span class="badge badge-soft-warning py-1">View</span></a>
                  </td>
              </tr>
              `
              myTransactions.innerHTML += output
          });
          }
          console.log(dash)

          /*
          "recentDebts": [{
            "user_phone_number": "0903748484",
            "customer_phone_number": "08077272888",
            "name": "",
            "amount": 30000,
            "ts_ref_id": 5f0cf1e8f370e342104cca42,
            "message": "Payment for sold shoes",
            "status": "unpaid",
            "expected_pay_date": "Mon Jul 13 2020 14:11:36 GMT+0100 (West Africa Standard Time)" }]
          }] 
          */

          if (dash.data.recentDebts.length == 0) {
            document.querySelector('.debts-error').classList.add('dissapear');
            document.querySelector('.debts-table').classList.remove('dissapear');

            debtList.innerHTML = `
              <div style="display:flex; justify-content:center; text-align:center; width:100%" class='mt-2 mb-3'>No one is oweing you</div>
            `
          } else {
            document.querySelector('.debts-error').classList.add('dissapear');
            document.querySelector('.debts-table').classList.remove('dissapear');

            dash.data.recentDebts.forEach(debt => {
              let row = 
              `
              <div class="media-body">
                  <h6 class="mt-1 mb-0 font-size-15">${debt.name}</h6>
                  <h6 class="text-muted font-weight-normal mt-1 mb-3">${debt.expected_pay_date.slice(0, 15)}</h6>
              </div>
              <div class="dropdown align-self-center float-right">
                  <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                      <i class="uil uil-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-edit-alt mr-2"></i>View</a>
                  </div>
              </div>
              `
              debtList.innerHTML += row;
            });
          };
        };

        function makeRequest (params) {
          getDashboard().catch(err => {
            document.querySelector('.trans-error').innerText = "Opps! Couldn't get content. Try refreshing"
            document.querySelector('.debts-error').innerText = "Opps! Couldn't get content. Try refreshing"
          })
        }
    </script>

    {{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
        <script>
            var dashboard_intro_shown = localStorage.getItem('dashboard_intro_shown');

            if (!dashboard_intro_shown) {

                const tour = new Shepherd.Tour({
                    defaults: {
                        classes: "shepherd-theme-arrows"
                    }
                });

                tour.addStep("step", {
                    text: "Welcome to mycustomer web app.",
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]
                });

                tour.addStep("step2", {
                    text: "first, update your profile",
                    attachTo: { element: ".second", on: "left" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ],

                    beforeShowPromise: function() {
                        document.body.className += ' sidebar-enable';
                        document.getElementById('sidebar-menu').style.height = 'auto';
                    },
                });
                  tour.addStep("step3", {
                    text: "Then create a store",
                    attachTo: { element: ".third", on: "left" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]});
                   tour.addStep("step4", {
                    text: "create your customer",
                    attachTo: { element: ".fourth", on: "left" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]});
                    tour.addStep("step5", {
                    text: "then create a transaction",
                    attachTo: { element: ".fifth", on: "left" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]});
                     tour.addStep("step6", {
                    text: "create a debt reminder here",
                    attachTo: { element: ".sixth", on: "left" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]});

               tour.addStep("step7", {
                    text: "manage your stores",
                    attachTo: { element: ".seventh", on: "right" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]});
               
                tour.start();
                localStorage.setItem('dashboard_intro_shown', 1);
            }
        </script>
    {{-- @else --}}

@stop
@endif

@if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'super_admin')

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
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Store Admin</span>
                                <h2 class="mb-0 store-admins">
                                    @if ($response != null)
                                        {{ $response[0]->data->storeAdminCount }}
                                    @else
                                        0
                                    @endif
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
                                    @if ($response != null)
                                        {{ $response[0]->data->storesCount }}
                                    @else
                                        0
                                    @endif
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
                                    @if ($response != null)
                                        {{ $response[0]->data->assistantsCount }}
                                    @else
                                        0
                                    @endif
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
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Customers</span>
                                <h2 class="mb-0 my-customers">
                                    @if ($response != null)
                                        {{ $response[0]->data->customerCount }}
                                    @else
                                        0
                                    @endif
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
                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Users</span>
                                <h2 class="mb-0 my-users">
                                    @if ($response != null)
                                        {{ $response[0]->data->usersCount }}
                                    @else
                                        0
                                    @endif
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

            const res = await fetch(`https://dev.api.customerpay.me/dashboard/all?token=${apiToken}`);
            const dash = await res.json();

            // let storeAdmin = document.querySelector('.store-admins');
            // let myStores = document.querySelector('.my-stores');
            // let myAssistants = document.querySelector('.my-assistants');
            // let myUsers = document.querySelector('.my-users');
            // let myCustomers = document.querySelector('.my-customers');

            // storeAdmin.innerText = dash.data.storeAdminCount;
            // myStores.innerText = dash.data.storeCount;
            // myAssistants.innerText = dash.data.assistantsCount;
            // myUsers.innerText = dash.data.usersCount;
            // myCustomers.innerText = dash.data.customerCount;

            if (true) {
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

    {{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
     <!--    <script>
            var dashboard_intro_shown = localStorage.getItem('dashboard_intro_shown');

            if (!dashboard_intro_shown) {

                const tour = new Shepherd.Tour({
                    defaults: {
                        classes: "shepherd-theme-arrows"
                    }
                });

                tour.addStep("step", {
                    text: "Welcome to mycustomer web app.",
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ]
                });

                tour.addStep("step2", {
                    text: "First thing you do is create a store",
                    attachTo: { element: ".second", on: "right" },
                    buttons: [
                        {
                            text: "Next",
                            action: tour.next
                        }
                    ],
                    beforeShowPromise: function() {
                        document.body.className += ' sidebar-enable';
                        document.getElementById('sidebar-menu').style.height = 'auto';
                    },
                });
                tour.start();
                localStorage.setItem('dashboard_intro_shown', 1);
            }
        </script> -->
    {{-- @else --}}

@stop
@endif
