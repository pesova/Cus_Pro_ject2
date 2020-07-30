@extends('layout.base')

@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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

@php
    $response = $data['stores'];
    $broadcasts = $data['broadcasts'];
@endphp

@section('content')
@include('partials.alert.message')
<div class="container-fluid">

    <div class="row page-title align-items-center">
        <div class="col-sm-4 col-xl-6">
            <h4 class="mb-1 mt-0">Compose</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 float-sm-left">Compose Message</h3>
                    @include('partials.alert.message')

                    <div class="row col-12">
                        <form action="{{ route('broadcast.store') }}" method="post" class="col-12">
                            @csrf
                            <div class="form-group">
                                <label>Store</label>
                                <select class="form-control col-12" name="store" id="store" required>
                                    <option value="" selected disabled>None selected</option>
                                    @foreach ($response as $index => $store )
                                    <option value="{{$store->_id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Send To</label>
                                <select class="form-control col-12" name="send_to" id="send_to" required>
                                    <option value="1"> All Customers</option>
                                    <option value="2" selected> Selected Customers</option>
                                </select>
                            </div>
                            <div class="form-group" id='customersGroup'>
                                <label>Customer(s)</label>
                                <select class="form-control col-12 jstags" multiple name="customer[]" id="customerNumbers">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <select class="form-control col-12" name="message" id="msgselect" required>
                                    <option value="" selected disabled>None selected</option>
                                    <option value="Happy new year!">Happy new year!</option>
                                    <option value="We are now open!">We are now open!</option>
                                    <option value="New stocks just arrived!">New stocks just arrived!</option>
                                    <option value="Happy new Month">Happy new Month</option>
                                    <option value="Thank you for shopping with">Thank you for shopping with US!</option>
                                    <option value="other">Custom Message</option>
                                </select>
                            </div>
                            <div class="form-group" id="txtarea">
                                <label for="exampleFormControlTextarea1">Your Custom Message</label>
                                <textarea class="form-control" name="txtmessage" rows="4"></textarea>
                            </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Send &nbsp;<i class="fa fa-paper-plane my-float"></i>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="card mt-0">
    <div class="card-header">
        <div class="">History: Broadcast Messages</div>
    </div>
    <div class="card-body">
        <div class="table-responsive table-data">
            <table id="broadcastsTable"  class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Ref ID</th>
                        <th>Number</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Time Sent</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @isset($broadcasts)
                    @if (count($broadcasts) > 0)
                        @foreach ($broadcasts as $broadcast)
                            <tr>
                                <td>
                                {{$broadcast->_id}}
                                </td>
                                <td>
                                 
                                    @foreach ($broadcast->numbers as $index=>$numbers)
                                        
                                        @if (count($broadcast->numbers) !=  $index + 1)
                                             {{$numbers .","}}
                                        @else
                                            {{$numbers}}
                                        @endif
                                       
                                    @endforeach
                                    
                                    </td>
                                <td>
                                    {{$broadcast->message}}
                                </td>
                                <td>
                                    <span class="badge badge-{{$broadcast->status == "Sent" ? "success" : "danger"}}">
                                        {{$broadcast->status == "Sent" ? "Sent" : "Not Sent"}}
                                    </span></td>
                                <td>
                                {{\Carbon\Carbon::parse($broadcast->date)->diffForhumans()}}
                                </td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#ResendReminderModal" class="btn btn-primary btn-sm mt-2">
                                        Resend
                                    </a>
                                </td>
                            </tr> 
                        @endforeach
                    @else
                        
                    @endif
                @endisset
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js">
</script>
<script src="https://code.jquery.com/jquery-1.8.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- App js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    jQuery(function($) {
        const token = "{{Cookie::get('api_token')}}"
        const host = "{{ env('API_URL', 'https://dev.api.customerpay.me') }}";

        $('select[name="store"]').on('change', function() {
            var storeID = $(this).val();
            var host = "{{ env('API_URL', 'https://dev.api.customerpay.me') }}";

            if (storeID) {
                $('select[name="customer[]"]').empty();
                jQuery.ajax({
                    url: host + "/store/" + encodeURI(storeID),
                    type: "GET",
                    dataType: "json",
                    contentType: 'json',
                    headers: {
                        'x-access-token': token
                    },
                    success: function(data) {
                        var new_data = data.data.store.customers;
                        var i;
                        new_data.forEach(customer => {
                            $('select[name="customer[]"]').append('<option multiple value="' +
                                customer.phone_number + '">' +
                                customer.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="store"]').empty();
            }
        });

    });

    $(document).ready(function() {
    $('#broadcastsTable').DataTable({
        dom: 'frtipB',
        "ordering": false,
    }
    );
} );

</script>
<script>
    $("#txtarea").hide();
    $("#msgselect").change(function() {
        var val = $("#msgselect").val();
        if (val == "other") {
            $("#txtarea").show();
        } else {
            $("#txtarea").hide();
        }
    });

    $('#send_to').change(function() {
        if ($(this).val() == 2) {
            $('#customersGroup').removeClass('d-none');
            $('#customerNumbers').attr("required", true);
        } else {
            $('#customersGroup').addClass('d-none');
            $('#customerNumbers').attr("required", false);
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(".jstags").select2({
        theme: "classic",
        tags: true,
    });
</script>
@stop