@extends('layout.base')

@section('content')
    <div class="account-pages my-5">
        <div class="container-fluid">
            <div class="row-justify-content-center">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-0">
                                <!-- <input class="btn btn-primary right pull-right" value="Back"> -->
                                <div style="padding: 20px;">
                                    <a href="{{ route('complaint.index') }}" class="btn btn-primary float-right"> Back &nbsp;<i class="fa fa-plus my-float"></i> </a>
                                    <h4 class="header-title mt-0 mb-1">Complaint Overview</h4>
                                    <!-- <hr> -->
                                </div>
                                <div class="row py-1">
                                    <div class="col-xl-4 col-sm-6">
                                        <!-- stat 1 -->
                                        <div class="media p-3">
                                            <i data-feather="grid" class="align-self-center icon-dual icon-sm mr-4"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-0">{{ $response->data->complaint->_id }}</h6>
                                                <span class="text-muted font-size-13">Complaint ID</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-6">
                                        <!-- stat 2 -->
                                        <div class="media p-3">
                                            <i data-feather="check-square" class="align-self-center icon-dual icon-sm mr-4"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-0">{{ $response->data->complaint->status }}</h6>
                                                <span class="text-muted">Status</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <!-- stat 3 -->
                                        <div class="media p-3">
                                            <i data-feather="user-check" class="align-self-center icon-dual icon-sm mr-4"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-0">{{ $response->data->complaint->email }}</h6>
                                                <span class="text-muted">Email</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <!-- stat 3 -->
                                        <div class="media p-3">
                                            <i data-feather="clock" class="align-self-center icon-dual icon-lg mr-4"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-0">
                                                    {{ \Carbon\Carbon::parse($response->data->complaint->date)->diffForHumans() }}
                                                </h6>
                                                <span class="text-muted">Date Created</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- details-->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card offset-1">
                            <div class="card-body">
                                <h6 class="mt-0 header-title">Email</h6>

                                <div class="text-muted mt-3">
                                    <p>{{ $response->data->complaint->email }}</p>

                                    <h6 class="mt-0 header-title">Subject</h6>

                                    <p>{{ $response->data->complaint->subject }}</p>

                                    <h6 class="mt-0 header-title">Message</h6>

                                    <p>{{ $response->data->complaint->message }}</p>

                                    <div class="tags">
                                        <h6 class="font-weight-bold">Complaint created by:</h6>
                                        <div class="text-uppercase">
                                            <p class="badge badge-soft-primary mr-2">{{ $response->data->complaint->name }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="mt-4">
                                                <p class="mb-2"><i class="uil-calender text-danger"></i> Created At</p>
                                                <h6 class="font-size-10">
                                                    {{ \Carbon\Carbon::parse($response->data->complaint->date)->diffForHumans() }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    @if ( \Cookie::get('user_role') == "super_admin")
                                        <div style="padding: 20px;">
                                            <a href="{{ route('complaint.edit', $response->data->complaint->_id) }}" class="btn btn-primary float-left"> Edit &nbsp;<i class="fa fa-plus my-float"></i> </a>
                                            <form class="float-right" action="{{ route('complaint.destroy', $response->data->complaint->_id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                    {{-- <div class="assign team mt-4">
                                        <h6 class="font-weight-bold">Assign To</h6>
                                        <a href="javascript: void(0);">
                                            <img src="backend/assets/images/users/avatar-2.jpg" alt="" class="avatar-sm m-1 rounded-circle" />
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
