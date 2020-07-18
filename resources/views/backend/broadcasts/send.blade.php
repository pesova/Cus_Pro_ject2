@extends('layout.base')
@section ('custom_css')
    <link rel="stylesheet" href="/backend/assets/css/compose.css">
@stop
    @section('content')
        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                @if(session('response'))
                <p class="alert alert-danger">{{ session('response') }}</p>
                @endif
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold" style="text-align: center;">Send a Message</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('broadcast.store') }}" method="POST">
                        @csrf
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title"><strong>To</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">

                                            </div>
                                            <input class="form-control" type="text" placeholder="Enter your recipient's number" name="receiver">                                            
                                        </div>                                       
                                        <p><small id="helpPhone" class="form-text text-muted">Enter your number without the starting 0, eg 234813012345</small></p>
                                    </div>
                                </div>
                            </div>
                             <!-- <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="title"><strong>Message Title</strong></label><input class="form-control" type="text" placeholder="Enter your message title here" name="title"></div>
                                </div>
                            </div>  -->
                            <p class="header"> Message Body</p>
                            <textarea name="message" id="body" cols="30" rows="10" placeholder="Enter message here" class="w-100"></textarea>
                            <input type="checkbox" id="temp" name="temp" value="template">
                            <label for="temp"> See templates</label><br>
                            <button type="submit" class="btn-lg btn-primary  button text-center my-5">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('javascript')

    @stop
