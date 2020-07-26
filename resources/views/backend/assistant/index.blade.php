@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="/backend/assets/build/css/all_users.css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="css/app.min.css" rel="stylesheet" type="text/css" />
<link href="/backend/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/backend/assets/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/backend/assets/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/backend/assets/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
<div class="content">
    {{-- <a href="#" class="float" data-toggle="modal"
                                            data-target="#myModal">
    <i class="fa fa-plus my-float" ></i>
    </a> --}}
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="customer-heading-container">

                    <button class="add-customer-button btn btn-primary" data-toggle="modal"
                        data-target="#addAssistantModal">
                        Add New Assistant <i class="fa fa-plus add-new-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        @include('partials.alert.message')

        <div class="row page-title">

            <div class="col-md-12">
                <h4 class="mb-1 mt-0">Assistants</h4>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                        <p class="sub-header">
                            Find Assistant
                        </p>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-lg-12 mt-4">
                                    <div class="row">
                                        <label class="form-control-label">Search Assistants</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="search"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="assistant-name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
<div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <table id="basic-datatable" class="table dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>NAME</th>
                                                <th>INFO</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($assistants as $a => $assistant)
                                            <tr>
                                                <td>{{ $a + 1 }}</td>
                                                <td>{{$assistant->name }}</td>
                                                <td><p class="text-muted">{{$assistant->phone_number}} | {{$assistant->email}}</p></td>
                                                <td>
                                                @if ($assistant->user_role == "store_admin")
                                                @endif
                                                @if($assistant->is_active)
                                                <span class="badge badge-success">Activated</span>

                                                @else
                                                <span class="badge badge-secondary">Not activated</span>

                                                @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group mt-2 mr-1">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('assistants.show', $assistant->_id) }}">View Assistant</a>
                                                        <a class="dropdown-item"
                                                            href="{{route('assistants.edit', $assistant->_id) }}">Edit
                                                            Assistant</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#deleteModal-{{$assistant->_id}}">Delete Assistant</a>

                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
</div>
        <div class="row">
            @foreach ($assistants as $assistant)
            <div class="col-xl-3 col-sm-6">
                <div id="idd" class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                @php
                                $names = explode(" ", strtoupper($assistant->name));
                                $ch = "";
                                foreach ($names as $name) {
                                $ch .= $name[0];

                                }
                                echo $ch;
                                @endphp
                            </span>
                        </div>
                        <h5 class="font-size-15"><a href="#" class="text-dark">{{$assistant->name }}</a></h5>
                        <p class="text-muted">{{$assistant->phone_number}} | {{$assistant->email ?? ''}}</p>

                        <div>
                            @if ($assistant->user_role == "store_admin")
                            @endif
                            @if($assistant->is_active)
                            <span class="badge badge-success">Activated</span>

                            @else
                            <span class="badge badge-secondary">Not activated</span>

                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-20">
                            <div class="flex-fill">
                                <a href="{{ route('assistants.show', $assistant->_id) }}" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="View User"><i
                                        data-feather="eye"></i></a>
                            </div>

                            <div class="flex-fill">
                                <a href="{{route('assistants.edit', $assistant->_id) }}" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Edit"><i
                                        data-feather="edit"></i></a>
                            </div>


                            <div class="flex-fill">
                                <a class="" href="#" data-toggle="modal"
                                    data-target="#deleteModal-{{$assistant->_id}}"><i data-feather="trash-2"></i></a>

                                @include('partials.modal.assistant.deleteAssistant')
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('partials.modal.assistant.addAssistant')

</div>
@endsection


@section("javascript")
<script src="/backend/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/backend/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/backend/assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="/backend/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="/backend/assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="/backend/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="/backend/assets/libs/datatables/buttons.html5.min.js"></script>
<script src="/backend/assets/libs/datatables/buttons.flash.min.js"></script>
<script src="/backend/assets/libs/datatables/buttons.print.min.js"></script>

<script src="/backend/assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="/backend/assets/libs/datatables/dataTables.select.min.js"></script>

<!-- Datatables init -->
<script src="/backend/assets/js/pages/datatables.init.js"></script>
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
    });

    if ($("#phone").val().trim() != '')
        test.setNumber("+" + ($("#phone").val()));

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

    // function showModal() {
    //     $('#phone').css('paddingLeft', "unset");
    //     $("#AssistantModal").modal('show');
    // }

    let assistantName = $('#assistant-name');
    let assistantEmail = $('#assistant-email');
    let assistantPhone = $('#assistant-phone');

    //add input event listener
    assistantName.on('keyup', (e) => {
        assistantEmail.val('');
        assistantPhone.val('');
        const assistants = $('.assistant-name');
        const filterText = e.target.value.toLowerCase();

        assistants.each(function (i, item) {
            if ($(this).html().toLowerCase().indexOf(filterText) !== -1) {
                $(this).parent().css('display', 'table-row');

            } else {
                $(this).parent().css('display', 'none');
            }

        });
    });
    assistantEmail.on('keyup', (e) => {
        assistantPhone.val('');
        assistantName.val('');
        const assistants = $('.assistant-email');
        const filterText = e.target.value.toLowerCase();

        assistants.each(function (i, item) {
            if ($(this).html().toLowerCase().indexOf(filterText) !== -1) {
                $(this).parent().css('display', 'table-row');

            } else {
                $(this).parent().css('display', 'none');

            }

        });
    });
    assistantPhone.on('keyup', (e) => {
        assistantEmail.val('');
        assistantName.val('');
        const assistants = $('.assistant-phone');
        const filterText = e.target.value.toLowerCase();

        assistants.each(function (i, item) {
            if ($(this).html().toLowerCase().indexOf(filterText) !== -1) {
                $(this).parent().css('display', 'table-row');

            } else {
                $(this).parent().css('display', 'none');

            }

        });
    });

</script>
<script>
    //for search bar
    let userText = document.querySelector('#assistant-name')
    let rows = document.querySelectorAll('#idd')

    //add input event listener
    userText.addEventListener('keyup', showFilterResults)

    function showFilterResults(e) {
        const users = rows;
        const filterText = e.target.value.toLowerCase();

        users.forEach(function (item) {
            if (item.textContent.toLowerCase().indexOf(filterText) !== -1) {
                item.parentElement.style.display = 'table-row'

            } else {
                item.parentElement.style.display = 'none'

            };
        });
    };

</script>
{{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
<script>
    var assistant_intro_shown = localStorage.getItem('assistant_intro_shown');

    if (!assistant_intro_shown) {

        const tour = new Shepherd.Tour({
            defaults: {
                classes: "shepherd-theme-arrows"
            }
        });

        tour.addStep("step", {
            text: "Welcome to Assistants Page, here you can add your assistants to manage your stores",
            buttons: [{
                text: "Next",
                action: tour.next
            }]
        });

        // tour.addStep("step2", {
        //     text: "First thing you do is create a store",
        //     attachTo: { element: ".second", on: "right" },
        //     buttons: [
        //         {
        //             text: "Next",
        //             action: tour.next
        //         }
        //     ],
        //     beforeShowPromise: function() {
        //         document.body.className += ' sidebar-enable';
        //         document.getElementById('sidebar-menu').style.height = 'auto';
        //     },
        // });
        tour.start();
        localStorage.setItem('assistant_intro_shown', 1);
    }

</script>
{{-- @else --}}
@stop
