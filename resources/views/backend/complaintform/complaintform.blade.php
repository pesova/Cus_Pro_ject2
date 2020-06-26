@extends('layout.base')

    @section('content')

    <!-- Start Content-->
    <div class="container-fluid h-100">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                </nav>
                <h4 class="mb-1 mt-0">Create Complaint</h4>
            </div>
        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3 header-title mt-0">Complaint Form</h4>

                        <form class="form-horizontal">
                            <div class="form-group row mb-3">
                                <label for="fullname" class="col-3 col-form-label">Full Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-3 col-form-label">Email</label>
                                <div class="col-9">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="message" class="col-3 col-form-label">Message</label>
                                <div class="col-9">
                                    <textarea class="form-control" rows="5" id="message" placeholder="Kindly, tell us your problem..."></textarea>
                                </div>
                            </div>

                            <br>
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info">Submit Complaint</button>
                                </div>
                            </div>
                        </form>

                    </div>  <!-- end card-body -->
                </div>
            </div>
            <!-- end col -->
    </div> <!-- container-fluid -->

    @endsection
