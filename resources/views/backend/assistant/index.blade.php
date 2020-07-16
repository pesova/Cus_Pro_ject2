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
                        <button class="add-customer-button btn btn-primary" data-toggle="modal">
                            <a href="{{ route('assistants.create') }}" class="text-white">
                                Add New Assistant <i class="fa fa-plus add-new-icon"></i>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row page-title">

                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>

                @endif
                @if(Session::has('success'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>

                @endif

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
                                                <input type="text" class="form-control" id="password">
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
                                            <input type="text" class="form-control" id="password">
                                        </div>

                                    </div>

                                    <div class="form-group col-lg-4 mt-4">
                                        <label class="form-control-label">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="tel" id="phone" class="form-control">

                                        </div>
                                    </div class="form-group col-lg-4 mt-4">
                                    <button type="button" class="btn btn-primary">Search</button>
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
                                                <td>{{$assistant->name }}

                                                    @if ($assistant->user_role == "store_admin")
                                                    @endif
                                                    @if($assistant->is_active)
                                                        <span class="badge badge-success">Activated</span>

                                                    @else
                                                        <span class="badge badge-secondary">Not activated</span>

                                                    @endif
                                                </td>
                                                </td>
                                                <td>
                                                    @if(isset($assistant->phone_number))
                                                        {{$assistant->phone_number}} <br>
                                                    @else
                                                        assistant email here<br>
                                                    @endif
                                                    {{-- <span class="badge badge-primary">Store Reference Code:
                                                        @if(isset($assistant->store_ref_code))
                                                       {{$assistant->store_ref_code}} <br>
                                                       @else
                                                        ST145M455 <br>
                                                       @endif
                                                    </span> --}}
                                                </td>
                                                <td>
                                                    @if(isset($assistant->email))
                                                        {{$assistant->email}} <br>
                                                    @else
                                                        assistant email here<br>
                                                    @endif
                                                    {{-- <span class="badge badge-primary">Store Reference Code:
                                                        @if(isset($assistant->store_ref_code))
                                                       {{$assistant->store_ref_code}} <br>
                                                       @else
                                                        ST145M455 <br>
                                                       @endif
                                                    </span> --}}
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
                                                            @isset($assistant->_id)
                                                                <a class="dropdown-item"
                                                                   href="{{ route('assistants.show', $assistant->_id) }}">View
                                                                    Profile</a>
                                                                <a class="dropdown-item"
                                                                   href="{{route('assistants.edit', $assistant->_id) }}">Edit
                                                                    Assistant</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                   onclick="$(this).parent().find('form').submit()">Delete
                                                                    Assistant</a>
                                                                <form action="{{ route('assistants.destroy', $assistant->_id) }}"
                                                                      method="POST" id="form">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                </form>
                                                            @endisset
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
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Assistant</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="mt-4 mb-3 form-horizontal" action="{{ route('assistants.store') }}" method="POST">
                        <div class="form-group row mb-3">
                            <label for="name" class="col-3 col-form-label">Name</label> <br> <br>
                            <div class="col-9">
                                <input type="text" class="form-control" id="fullname" name="name"
                                       placeholder="Enter name here">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-3">
                            <label for="number" class="col-3 col-form-label">Phone Number</label> <br>
                            <div class="col-9">
                                <input type="text" class="form-control" id="fullname" name="phone_number"
                                       placeholder="Enter phone number">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-3 col-form-label">Email</label> <br>
                            <div class="col-9">
                                <input type="text" class="form-control" id="fullname" name="email"
                                       placeholder="Enter email">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-3 col-form-label">Password</label> <br>
                            <div class="col-9">
                                <input type="password" class="form-control" id="fullname" name="password"
                                       placeholder="Enter password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section("javascript")
    <script src="/backend/assets/build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // any initialisation options go here
        });
    </script>
@stop
