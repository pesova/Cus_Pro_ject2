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

                    <div class="col-sm-9">
                        <div class="row text-center">
                            <div class="col-6">
                                <h5 class="font-size-15">{{ $data->customerCount }}</h5>
                                <p class="text-muted mb-0">Customer(s)</p>
                            </div>
                            <div class="col-6">
                                <h5 class="font-size-15">{{ $data->storeCount }}</h5>
                                <p class="text-muted mb-0">Business(es)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
        {{-- end --}}
    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Debt</p>
                                {{-- doug - todo - sort by currency --}}
                                <h4 class="mb-0">{{ format_money($data->debtAmount) }}
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
            {{--<div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Revenue</p>
                                --}}{{-- doug - todo - sort by currency --}}{{--
                                <h4 class="mb-0">{{ format_money($data->revenueAmount) }}
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
                                <h4 class="mb-0">{{ format_money($data->receivablesAmount) }}
                            </div>
                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="uil-atm-card font-size-14"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="clearfix"></div>
                <h6 class="card-title mb-4 float-sm-left">Transaction Overview {{date('Y')}}</h6>
                <div id="transactionchart"></div>
            </div>
        </div>
    </div>
    {{--TODO: uncomment debts chart when API returns the data for it--}}
    {{--<div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4 float-sm-left">Debts Overview {{date('Y')}}</h6>
                <div class="clearfix"></div>
                <div id="debtschart"></div>
            </div>
        </div>
    </div>--}}
</div>

<!-- products -->
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body pt-2">
                <h5 class="mb-4 header-title">Latest Debts</h5>
                <div style="display:flex; justify-content:center; text-align:center; width:100%"
                     class='mt-2 mb-3 debts-error'>
                </div>

                <div class="debts-tablex">
                    <table id="debtorsTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Transaction Ref ID</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data->recentDebts) > 0)
                            @foreach ($data->recentDebts as $index => $debtor )
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a class=""
                                           href="{{ route('debtor.show', $debtor->debt->_id) }}">
                                            {{ $debtor->debt->_id }}
                                        </a>
                                    </td>
                                    </td>
                                    <td>
                                        @if($debtor->debt->status == false)
                                            <span class="badge badge-danger">Unpaid</span>
                                        @else
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>{{ $debtor->debt->description }}</td>
                                    <td>{{ format_money($debtor->debt->total_amount, $debtor->debt->currency) }}</td>
                                    <td> {!! app_format_date($debtor->debt->date_recorded) !!}</td>
                                    <td>
                                        <a class="btn btn-info btn-small py-1 px-2"
                                           href="{{ route('debtor.show', $debtor->debt->_id) }}">
                                            More
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No Recent Debts</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@section("javascript")
    {{-- <script src="/backend/assets/js/pages/dashboard.js"></script> --}}
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js">
    </script>
    <script>
        $(document).ready(function () {
            // start of transaction charts
            var options = {
                series: [{
                    name: 'Transaction',
                    data: {{json_encode($data->chart)}},
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
                    type: 'text',
                    categories: ['JAN', 'FEB', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUG',
                        'SEPT', 'OCT', 'NOV', 'DEC'
                    ],
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
                    //min: -10,
                    // max: 40,
                    title: {
                        text: 'Transaction',
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#transactionchart"), options);
            chart.render();


            var export_filename = 'Mycustomerdebts';
            $('#debtorsTable').DataTable({
                dom: 'frtipB',
                buttons: [{
                    extend: 'excel',
                    className: 'd-none',
                    title: export_filename,
                }, {
                    extend: 'pdf',
                    className: 'd-none',
                    title: export_filename,
                    extension: '.pdf'
                }]
            });
            $("#ExportReporttoExcel").on("click", function () {
                $('.buttons-excel').trigger('click');
            });
            $("#ExportReporttoPdf").on("click", function () {
                $('.buttons-pdf').trigger('click');
            });


        });

    </script>

    {{-- @if ( Cookie::get('is_first_time_user') == true) --}}
    {{-- <script>
        var dashboard_intro_shown = localStorage.getItem('dashboard_intro_shown');

        if (!dashboard_intro_shown) {

            const tour = new Shepherd.Tour({
                defaults: {
                    classes: "shepherd-theme-arrows"
                }
            });

            tour.addStep("step", {
                text: "Welcome to mycustomer web app.",
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });

            tour.addStep("step2", {
                text: "first, create a store",
                attachTo: {
                    element: ".second",
                    on: "left"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }],

                beforeShowPromise: function () {
                    document.body.className += ' sidebar-enable';
                    document.getElementById('sidebar-menu').style.height = 'auto';
                },
            });
            tour.addStep("step3", {
                text: "Then create a customer",
                attachTo: {
                    element: ".third",
                    on: "left"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });
            tour.addStep("step4", {
                text: "create your transaction",
                attachTo: {
                    element: ".fourth",
                    on: "left"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });
            tour.addStep("step5", {
                text: "Send broadcast messages here",
                attachTo: {
                    element: ".fifth",
                    on: "left"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });
            tour.addStep("step6", {
                text: "make your complaints here",
                attachTo: {
                    element: ".sixth",
                    on: "left"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });

            tour.addStep("step7", {
                text: "add your bank details here",
                attachTo: {
                    element: ".seventh",
                    on: "right"
                },
                buttons: [{
                    text: "Next",
                    action: tour.next
                }]
            });

            tour.start();
            localStorage.setItem('dashboard_intro_shown', 1);
        }

    </script> --}}
    {{-- @endif --}}

    <script>
        /*  ==========================================
        SHOW UPLOADED IMAGE
    * ========================================== */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $('#upload').on('change', function () {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = fileName;
        }

    </script>

@endsection