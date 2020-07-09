@extends('layout.base')

@section("custom_css")

    <style>
        .line-head {
            border-bottom: solid 1px #dddddd;
            margin-top: 0 !important;
            margin-bottom: 15px;
        }

        nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            color: #495057;
            background-color: #FFF;
            border-color: #dee2e6 #dee2e6 #FFF;
        }

        .nav-tabs li a.active {
            border-left: 5px solid #5369f8 !important;
            border-bottom: none !important;
        }
    </style>

@stop

@section('content')

    <div class="account-pages my-5">
        <div class="container-fluid">
            <div class="row-justify-content-center">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }} inline">{{ Session::get('message') }}</p>
                @endif
                <div class="h2"><i data-feather="edit" class="icon-dual"></i> Change Password</div>
                    <div class="col-md-9 " style="margin: 0 auto">
                        <div class="card p-4">
                                <div class="" id="password-change">
                                    <div class="tile user-settings">
                                        <form action="{{ route('setting') }}" method="POST">
                                            {{ csrf_field() }}
                                            <label class="control-label">Current Password</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-lock"></i></span></div>
                                                    <input class="form-control" name="current_password" type="password">
                                                </div>
                                            </div>
                                            <label class="control-label">New Password</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-lock"></i></span></div>
                                                    <input class="form-control" name="new_password" type="password">
                                                </div>
                                            </div>
                                            <label class="control-label">Confirm Password</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-lock"></i></span></div>
                                                    <input class="form-control" name="new_password_confirmation" type="password">
                                                </div>
                                            </div>
                                            <input type="text" value="password_change" name="control" hidden>

                                            <button class="btn btn-primary" type="submit">Update Password</button>
                                        </form>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section("javascript")

@stop
