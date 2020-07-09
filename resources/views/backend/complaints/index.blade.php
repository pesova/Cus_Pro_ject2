
@extends('layout.base')
@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="/backend/assets/css/complaintsLog.css">
@stop
    
@section('content')
    <div class="container">
        <div class="content">
            <div class="row page-title">
                <div class="col-md-12">
                    <div class="h4"><i data-feather="book" class="icon-dual"></i>Complaint Log</div>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row page-title">
                    <div class="col-md-12">
                        <h4 class="card-header mb-1 mt-0 float-left h5">All Complaints</h4>
                        <a href="{{ route('complaint.create') }}" class="btn btn-primary float-right">
                            Add Complaint &nbsp;<i class="fa fa-plus my-float"></i>
                        </a>
                    </div>
                </div>
                
                
                <div class="card-body p-1 card">
                    <div class="table-responsive table-data">
                        <table id="basic-datatable" class="table dt-responsive nowrap">
        
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach($responses->data->complaints as $index => $response)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="/backend/assets/images/users/avatar-1.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td><a href="{{ route('complaint.show', $response->_id) }}">{{ $response->name}}</a></td>
                                    <td>{{ $response->email}}</td>
                                    <td>{{ $response->status}}</td>
                                    <td class="message">{{ $response->message}}</td>
                                    <td>
                                        <form action="{{ route('complaint.destroy', $response->_id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card -->
                </div>
            </div>
        </div>
    </div>
@endsection


@section("javascript")

@stop
