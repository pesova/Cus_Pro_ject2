@extends('layout.base')

    @section("custom_css")
    <link href="/frontend/assets/css/change-lang.css" rel="stylesheet" type="text/css" />
    @stop

    @section('content')

    <!-- Start Content-->
    <div class="container-fluid h-100">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                </nav>
                <h4 class="mb-1 mt-0">Change Language</h4>
            </div>
        </div>

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <img src="/frontend/assets/images/united-kingdom-flag-icon-256 1.png">
                        <span class="img-text"> English</span>
                        <img id="arrow" src="/frontend/assets/images/Vector-arrow.png">
                    </div>  <!-- end card-body -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <img src="/frontend/assets/images/france-flag-icon-256 1.png" >
                        <span class="img-text"> Francais</span>
                        <img id="arrow" src="/frontend/assets/images/Vector-arrow.png">
                    </div>  <!-- end card-body -->
                </div>
            </div>
            <!-- end col -->
    </div> <!-- container-fluid -->

    @endsection