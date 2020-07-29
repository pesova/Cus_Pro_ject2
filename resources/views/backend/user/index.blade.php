@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="backend/assets/css/all_users.css">
@stop
@section('content')
    <div class="content">

        <div class="container-fluid">
            <div class="row page-title">
                <a href="#" class="float" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus my-float"></i>
                </a>
                <div class="col-md-12">
                    <h4 class="mb-1 mt-0">All Users</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="header-title mt-0 mb-1">Basic Data Table</h4> --}}
                            @include('partials.alert.message')
                            <p class="sub-header">
                                Find Users
                            </p>
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="form-group col-lg-12 mt-4">
                                        <div class="row">
                                            <label class="form-control-label">Search Users</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="search"></i>
                                                </span>
                                                </div>
                                                <input type="text" class="form-control" id="user-name">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

            <div class="row">
                @foreach ($users as $user)
                    <div class="col-xl-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                 @php
                                     $names = explode(" ", strtoupper($user->local->first_name));
                                     $ch = "";
                                     foreach ($names as $name) {
                                     $ch .= $name[0];

                                     }
                                     echo $ch;
                                 @endphp
                            </span>
                                </div>
                                <h5 class="font-size-15 text-dark search-name">{{$user->local->first_name }}
                                </h5>
                                <p class="text-muted">{{$user->local->phone_number?? ''}}
                                    | {{$user->local->email ?? ''}}</p>

                                <div>
                                    @if ($user->local->user_role == "store_admin")
                                        <span class="badge badge-primary">owner</span>
                                    @elseif ($user->local->user_role == "store_assistant")
                                        <span class="badge badge-secondray">assistant</span>
                                    @else
                                        <span class="badge badge-info">No role</span>
                                    @endif
                                    @if($user->local->is_active)
                                        <span class="badge badge-success">Activated</span>

                                    @else
                                        <span class="badge badge-secondary">Not activated</span>

                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="contact-links d-flex font-size-20">
                                    <div class="flex-fill">
                                        <a href="{{route('users.show',$user->_id)}}" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="View User"><i
                                                    data-feather="eye"></i></a>
                                    </div>

                                    {{--<div class="flex-fill">
                                        <a href="#" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="Edit"><i
                                                    data-feather="edit"></i></a>
                                    </div>--}}

                                    @if($user->local->is_active)
                                        <div class="flex-fill">
                                            <a class="" href="#" data-toggle="modal"
                                               data-target="#deactivateModal-{{$user->_id}}"><i
                                                        data-feather="user-x"></i></a>

                                            @include('partials.modal.user.deactivateUser')

                                        </div>

                                    @else

                                        <div class="flex-fill">
                                            <a class="" href="#" data-toggle="modal"
                                               data-target="#activateModal-{{$user->_id}}"><i
                                                        data-feather="user-check"></i></a>

                                            @include('partials.modal.user.activateUser')

                                        </div>

                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-12 align-items-center">
                    {{$users->links()}}
                </div>
            </div>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Create New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group row mb-3">
                                    <label for="inputphone" class="col-3 col-form-label">Phone
                                        Number</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="inputphone"
                                               placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputPassword3"
                                           class="col-3 col-form-label">Password</label>
                                    <div class="col-9">
                                        <input type="password" class="form-control" id="inputPassword3"
                                               placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputPassword5" class="col-3 col-form-label">Re
                                        Password</label>
                                    <div class="col-9">
                                        <input type="password" class="form-control" id="inputPassword5"
                                               placeholder="Retype Password">
                                    </div>
                                </div>
                                <div class="form-group mb-0 justify-content-end row">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-primary btn-block ">Create
                                            User
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
@endsection


@section("javascript")
    <script>
        let userName = $('#user-name');

        //add input event listener
        userName.on('keyup', (e) => {
            const users = $('.search-name');
            const filterText = e.target.value.toLowerCase();

            users.each(function (i, item) {
                console.log($(this).html());
                if ($(this).html().toLowerCase().indexOf(filterText) !== -1) {
                    $(this).parent().parent().parent().css('display', 'block');

                } else {
                    $(this).parent().parent().parent().css('display', 'none');
                }

            });
        });

    </script>
@endsection
