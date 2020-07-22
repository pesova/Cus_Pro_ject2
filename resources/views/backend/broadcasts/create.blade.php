@extends('layout.base')

@section("custom_css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <style>
        .select2-container--classic .select2-selection--multiple .select2-selection__choice {
            background-color: #5369f8;
            border: 1px solid #5369f8;
        }
        .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">

        <div class="row page-title align-items-center">
            <div class="col-sm-4 col-xl-6">
                <h4 class="mb-1 mt-0">Compose</h4>
            </div>
        </div>

        @if(session('error'))
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-danger"> {{ session('error') }} </p>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-success"> {{ session('success') }} </p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4 float-sm-left">Compose Message</h3>

                        <a href="{{ route('broadcast.index') }}" class="btn btn-primary float-right">
                            Go Back
                        </a>

                        <div class="row col-12">
                            <form action="{{ route('broadcast.store') }}" method="POST" class="col-12">
                                @csrf

                                <div class="form-group">
                                    <label>Choose customers to receive broadcast</label>
                                    <select class="form-control col-12 jstags" multiple>
                                        <option name="0909123949941">Ade 1 - 0909123949941</option>
                                        <option name="0909123949942">Ade 2 - 0909123949942</option>
                                        <option name="0909123949943">Ade 3 - 0909123949943</option>
                                        <option name="0909123949944">Ade 4 - 0909123949944</option>
                                        <option name="0909123949945">Ade 5 - 0909123949945</option>
                                        <option name="0909123949946">Ade 6 - 0909123949946</option>
                                        <option name="0909123949947">Ade 7 - 0909123949947</option>
                                        <option name="0909123949948">Ade 8 - 0909123949948</option>
                                        <option name="0909123949949">Ade 9 - 0909123949949</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="15" class="form-control col-12" ></textarea>
                                </div>
                            </form>
                        </div>

                        <a href="{{ route('broadcast.create') }}" class="btn btn-primary">
                            Send &nbsp;<i class="fa fa-paper-plane my-float"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("javascript")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(".jstags").select2({
            theme: "classic",
            tags: true,
        });
    </script>
@stop
