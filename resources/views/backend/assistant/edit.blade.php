@extends('layout.base')
@section('content')

    <!-- Start Content-->
    <div class="container-fluid h-100">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                </nav>
                <h4 class="mb-1 mt-0"><i data-feather="users" style="font-size: 5px; margin-right: 7px"></i>Edit
                    store assistant</h4>
            </div>
        </div>


        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="mb-3 header-title mt-0">Complaint Form</h4> --}}

                        <form action="{{ route('assistants.update', $response->_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="name" class="col-2 col-sm-3 col-form-label my-label">Name:</label> <br> <br>
                                <div class="col-10 col-sm-7">
                                    <input name="name" type="text" class="form-control" id="fullname"
                                           placeholder="Enter name here" value="{{ $response->name }}">
                                </div>
                            </div>
                            <br>
                            <!-- <div class="form-group row mb-3">
                                <label for="name" class="col-2 col-sm-3 col-form-label my-label">Store Name:</label> <br> <br>
                                <div class="col-10 col-sm-7">
                                    <input name="store_name" type="text" class="form-control" id="fullname" placeholder="Enter store name here">
                                </div>
                            </div> -->
                            {{-- <div class="form-group row mb-3">
                                <label for="role" class="col-2 col-sm-3 col-form-label my-label">Role:</label> <br>
                                <div class="col-10 col-sm-7">
                                    <input type="text" class="form-control" id="fullname" placeholder="Enter role">
                                </div>
                            </div>
                            <br>   --}}
                            <div class="form-group row mb-3">
                                <label for="address" class="col-2 col-sm-3 col-form-label my-label">Email:</label> <br>
                                <div class="col-10 col-sm-7">
                                    <input name="email" type="email" class="form-control" id="fullname"
                                           placeholder="Enter Address" value="{{ $response->email }}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-3">
                                <label for="number" class="col-2 col-sm-3 col-form-label my-label">Phone Number:</label>
                                <br>
                                <div class="col-10 col-sm-7">
                                    <input name="phone_number" type="text" class="form-control" id="fullname"
                                           placeholder="Enter phone number" value=" {{ $response->phone_number }}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="number" class="col-2 col-sm-3 col-form-label my-label">Store:</label> <br>
                                <div class="col-10 col-sm-7">
                                    <select name="store_id" id="store_id" class="form-control">
                                        <option value=""> Select Store</option>
                                        @foreach($stores as $store)
                                            <option value="{{$store->_id}}">{{$store->store_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-2 col-sm-3 col-form-label my-label">Password:</label> <br>
                                <div class="col-10 col-sm-7">
                                    <input name="password" type="password" class="form-control" id="fullname"
                                           placeholder="Enter password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary my-button">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>  <!-- end card-body -->
                </div>
            </div>
            <!-- end col -->
        </div> <!-- container-fluid -->

@endsection
