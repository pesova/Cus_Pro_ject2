<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-soft-primary">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Welcome Back !</h5>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="/backend/assets/images/profile-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="/backend/assets/images/users/avatar-1.jpg" alt=""
                                 class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Cookie::get('name') }}</h5>
                        <p class="text-muted mb-0 text-truncate">Store Admin</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ count($customers) }}</h5>
                                    <p class="text-muted mb-0">Customers</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ count($stores) }}</h5>
                                    <p class="text-muted mb-0">Store(s)</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary waves-effect waves-light btn-sm">View Profile
                                    <i class="uil-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Monthly Earnings</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-muted">This month</p>
                        <h3>$34,252</h3>
                        <p class="text-muted"><span class="text-success mr-2"> 12% <i
                                        class="mdi mdi-arrow-up"></i>
                                </span> From
                            previous month</p>

                        <div class="mt-4">
                            <a href="#" class="btn btn-primary waves-effect waves-light btn-sm">
                                View More <i class="uil-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Debt</p>
                                <h4 class="mb-0">$1,235</h4>
                            </div>

                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                    <span class="avatar-title">
                                        <i class="uil-atm-card font-size-14"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Revenue</p>
                                <h4 class="mb-0">$35, 723</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="uil-atm-card font-size-14"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Receivables</p>
                                <h4 class="mb-0">$16.2</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="uil-atm-card font-size-14"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4 float-sm-left">Transaction Overview</h6>
                <div class="clearfix"></div>
                <div id="transactionchart"></div>
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
                <div style="display:flex; justify-content:center; text-align:center; width:100%"
                     class='mt-2 mb-3 trans-error'>

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
                <div style="display:flex; justify-content:center; text-align:center; width:100%"
                     class='mt-2 mb-3 debts-error'>
                </div>

                <div class="debts-table dissapear">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@section("javascript")
    {{-- <script src="/backend/assets/js/pages/dashboard.js"></script> --}}
    <script>
        $(document).ready(function () {
            // start of transaction charts
            var options = {
                series: [{
                    name: 'Likes',
                    data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    width: 7,
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000',
                        '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001', '4/11/2001', '5/11/2001'
                        , '6/11/2001'],
                },
                title: {
                    text: '',
                    align: 'left',
                    style: {
                        fontSize: "16px",
                        color: '#666'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        gradientToColors: ['#FDD835'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    },
                },
                markers: {
                    size: 4,
                    colors: ["#FFA41B"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7,
                    }
                },
                yaxis: {
                    min: -10,
                    max: 40,
                    title: {
                        text: 'Cash Flow',
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#transactionchart"), options);
            chart.render();


        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', makeRequest);

        async function getDashboard() {

            let apiToken = "{{\Illuminate\Support\Facades\Cookie::get('api_token')}}";

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

            let recentTransactions = dash.data.recentTransactions.slice(0, 9)

            if (recentTransactions.length == 0) {
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

                recentTransactions.forEach((item, index) => {
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

            let recentDebts = dash.data.recentDebts.slice(0, 9)

            if (recentDebts.length == 0) {
                document.querySelector('.debts-error').classList.add('dissapear');
                document.querySelector('.debts-table').classList.remove('dissapear');

                debtList.innerHTML = `
              <div style="display:flex; justify-content:center; text-align:center; width:100%" class='mt-2 mb-3'>No one is owing you</div>
            `
            } else {
                document.querySelector('.debts-error').classList.add('dissapear');
                document.querySelector('.debts-table').classList.remove('dissapear');

                recentDebts.forEach(debt => {

                    let status;

                    if (debt.debt.status == false) {
                        status = `<span class="badge badge-danger py-1">Unpaid</span>`
                    } else {
                        status = `<span class="badge badge-success py-1">Paid</span>`
                    }

                    let row =
                        `
              <div class="pt-2 pb-2" style="display: flex; justify-content:space-between; border-top: 1px solid #eee">

                <div class="media-body">
                  <h6 class="mt-1 mb-1 font-size-15">${debt.customerName}</h6>
                  ${status}
                </div>

                <div class="media-body" style="display: flex">
                  <p style="margin: 0; align-self: flex-end"><b> N${debt.debt.amount} </b></p>
                </div>

                <div class="dropdown float-right" style="align-self: flex-end">
                  <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                      <i class="uil uil-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a href="/admin/debtor/${debt.debt._id}" class="dropdown-item"><i class="uil uil-edit-alt mr-2"></i>View</a>
                  </div>
                </div>

              </div>
              `
                    debtList.innerHTML += row;
                });
            }
            ;
        };

        function makeRequest() {
            getDashboard().catch(err => {
                document.querySelector('.trans-error').innerText = "Opps! Couldn't get content. Try refreshing"
                document.querySelector('.debts-error').innerText = "Opps! Couldn't get content. Try refreshing"
            })
        }
    </script>

    {{-- @if ( Cookie::get('is_first_time_user') == true) --}}
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
                attachTo: {element: ".second", on: "left"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ],

                beforeShowPromise: function () {
                    document.body.className += ' sidebar-enable';
                    document.getElementById('sidebar-menu').style.height = 'auto';
                },
            });
            tour.addStep("step3", {
                text: "Then create a store",
                attachTo: {element: ".third", on: "left"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ]
            });
            tour.addStep("step4", {
                text: "create your customer",
                attachTo: {element: ".fourth", on: "left"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ]
            });
            tour.addStep("step5", {
                text: "then create a transaction",
                attachTo: {element: ".fifth", on: "left"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ]
            });
            tour.addStep("step6", {
                text: "create a debt reminder here",
                attachTo: {element: ".sixth", on: "left"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ]
            });

            tour.addStep("step7", {
                text: "manage your stores",
                attachTo: {element: ".seventh", on: "right"},
                buttons: [
                    {
                        text: "Next",
                        action: tour.next
                    }
                ]
            });

            tour.start();
            localStorage.setItem('dashboard_intro_shown', 1);
        }
    </script>
    {{-- @endif --}}

@endsection