@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="/backend/assets/build/css/all_users.css">
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

                        <button class="add-customer-button btn btn-primary" onclick="showModal()">

                            Add New Assistant <i class="fa fa-plus add-new-icon"></i>

                        </button>{{--
                        <button class="add-customer-button btn btn-primary" data-toggle="modal"
                                data-target="#AssistantModal">

                            Add New Assistant <i class="fa fa-plus add-new-icon"></i>

                        </button>--}}
                    </div>
                </div>
            </div>

            @include('partials.alertMessage')

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

                                    <div class="form-group col-lg-4 mt-4">
                                        <div class="row">
                                            <label class="form-control-label">Email</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                </div>
                                                <input type="text" class="form-control" id="assistant-email"
                                                       placeholder="search email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 mt-4">
                                        <label class="form-control-label">Name</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                            </div>
                                            <input type="text" class="form-control" id="assistant-name"
                                                   placeholder="search name">
                                        </div>

                                    </div>

                                    <div class="form-group col-lg-4 mt-4">
                                        <label class="form-control-label">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="tel" id="assistant-phone" class="form-control"
                                                   placeholder="search phone number">

                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                            <p class="sub-header">
                                List of all assistants
                            </p>
                            <div class="table-responsive">


                                <table class="table mb-0" id="basic-datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($assistants as $assistant)
                                        <tr>
                                            <td class="assistant-name">{{$assistant->name }}

                                                @if ($assistant->user_role == "store_admin")
                                                @endif
                                                @if($assistant->is_active)
                                                    <span class="badge badge-success">Activated</span>

                                                @else
                                                    <span class="badge badge-secondary">Not activated</span>

                                                @endif
                                            </td>
                                            <td class="assistant-phone">
                                                {{$assistant->phone_number}}
                                            </td>
                                            <td class="assistant-email">
                                                {{$assistant->email}}

                                            </td>
                                            <td>
                                                <div class="btn-group mt-2 mr-1">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        Actions<i class="icon"><span
                                                                    data-feather="chevron-down"></span></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                           href="{{ route('assistants.show', $assistant->_id) }}">View
                                                            Profile</a>
                                                        <a class="dropdown-item"
                                                           href="{{route('assistants.edit', $assistant->_id) }}">Edit
                                                            Assistant</a>
                                                        <a class="dropdown-item" href="#"
                                                           data-toggle="modal"
                                                           data-target="#DeleteModal{{$assistant->_id}}">
                                                            Delete Assistant</a>

                                                    </div>
                                                    <div id="DeleteModal{{$assistant->_id}}"
                                                         class="modal fade bd-example-modal-sm"
                                                         tabindex="-2"
                                                         role="dialog" aria-labelledby="DeleteModal{{$assistant->_id}}"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="Title{{$assistant->_id}}">
                                                                        Delete Assistant </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you want to delete {{$assistant->name}}?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('assistants.destroy', $assistant->_id) }}"
                                                                          method="POST" id="form">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-primary btn-danger">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">No, I changed my mind
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

        </div>
        <div id="AssistantModal" class="modal fade" tabindex="-4" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add New Assistant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action=" {{ route('assistants.store') }}" method="POST"
                              class="mt-4 mb-3 form-horizontal my-form" id="submitForm">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="name" class="col-2 col-sm-3 col-form-label my-label">Name:</label> <br>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <input name="name" type="text" class="form-control" id="name"
                                           placeholder="Enter name here" value="{{old('name')}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-2 col-sm-3 col-form-label my-label">Email:</label>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <input name="email" type="email" class="form-control" id="email"
                                           placeholder="Enter Address" value="{{old('email')}}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-3">
                                <label for="number" class="col-2 col-sm-3 col-form-label my-label">Phone
                                    Number:</label>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <input type="tel" id="phone" name=""
                                           class="form-control" value="{{old('phone_number')}}" required>
                                    <input type="hidden" name="phone_number" id="phone_number"
                                           class="form-control">

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="number" class="col-2 col-sm-3 col-form-label my-label">Store:</label>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <select name="store_id" id="store_id" class="form-control">
                                        <option value=""> Select Store</option>
                                        @foreach($stores as $store)
                                            <option value="{{$store->_id}}">{{$store->store_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-2 col-sm-3 col-form-label my-label">Password:</label>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <input name="password" type="password" class="form-control" id="fullname"
                                           placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-2 col-sm-3 col-form-label my-label"></label>
                                <div class="col-10 col-sm-7">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-button btn-block">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section("javascript")

    <script src="/backend/assets/build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector("#phone");
        var test = window.intlTelInput(input, {
            separateDialCode: true,
            // any initialisation options go here
        });
        //  $("#phone").css('paddingLeft', '96%'); // fix issue with too long number field when modal is opened

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

        function showModal() {
            $('#phone').css('paddingLeft', "unset");
            $("#AssistantModal").modal('show');
        }

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
            buttons: [
                {
                    text: "Next",
                    action: tour.next
                }
            ]
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
