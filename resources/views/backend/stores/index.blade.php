@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('backend/assets/css/store_list.css') }}">
@stop

@section('content')
<div class="content">
    @include('partials.alert.message')
    <div class="container-fluid">
        <div class="page-title d-flex justify-content-between align-items-center">
            <div>
                <h4 class="">All Stores</h4>
            </div>
            <div>
                <button class=" btn btn-primary btn-sm" data-toggle="modal">
                    <a href="" data-toggle="modal" data-target="#addStoreModal" class="text-white">
                        Add New <i class="fa fa-plus add-new-icon"></i>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid card">
        <div class="row card-body">
            <label class="form-control-label">Search Stores</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="icon-dual icon-xs" data-feather="search"></i>
                    </span>
                </div>
                <input type="search" class="form-control" id="store-name" placeholder="Search" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            @foreach ($stores as $store)
            <div class="col-xl-3 col-sm-6" style="margin-bottom: 20px;">
                <div id="idd" class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                {{ app_get_acronym($store->store_name) }}
                            </span>
                        </div>
                        <h5 class="font-size-15"><a href="{{ route('store.show', $store->_id) }}"
                                class="text-dark search-name">{{ $store->store_name  }}</a>
                        </h5>
                        <p class="text-muted">{{ $store->email ?? ''}}</p>
                        <p class="text-muted">{{ $store->shop_address ?? ''}}</p>

                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-20">
                            <div class="flex-fill">
                                <a href="{{ route('store.show', $store->_id) }}" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="View Store"><i
                                        data-feather="eye"></i></a>
                            </div>

                            <div class="flex-fill">
                                <a href="#" 
                                data-toggle="modal" 
                                class="open_edit_store"
                                data-target="#editStore"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                onclick="open_edit_store(this)"
                                data-store_name="{{$store->store_name}}"
                                data-store_id="{{$store->_id}}"
                                data-store_tagline= "{{$store->tagline}}"
                                data-store_email="{{$store->email}}"
                                data-store_address="{{$store->shop_address}}"
                                data-store_phone="{{substr($store->phone_number,3) }}"
                                data-store_phone_full="{{$store->phone_number}}"
                                title="" 
                                data-original-title="Edit">
                                <i data-feather="edit"
                      
                                ></i>
                                </a>
                            </div>

                            <div class="flex-fill">
                                <a class="" href="#" data-toggle="modal" data-target="#deleteStore-{{$store->_id}}">
                                    <i data-feather="trash-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Store Modal --}}
            {{-- @include('backend.stores.modals.editStore') --}}

            {{-- Delete Store Modal --}}
            @include('backend.stores.modals.deleteStore')

            @endforeach
            {{-- Pagination link --}}
            <div class="ml-auto mx-2">
                {{$stores->links()}}
            </div>
        </div>
    </div>

    {{-- Add Store Modal --}}
    @include('backend.stores.modals.addStore')
    @include('backend.stores.modals.editStore')
</div>


@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    //for search bar
    let storeName = $('#store-name');

    //add input event listener
    storeName.on('keyup', (e) => {
        const users = $('.search-name');
        const filterText = e.target.value.toLowerCase();

        users.each(function (i, item) {
            // console.log($(this).html());
            if ($(this).html().toLowerCase().indexOf(filterText) !== -1) {
                $(this).parent().parent().parent().css('display', 'block');

            } else {
                $(this).parent().parent().parent().css('display', 'none');
            }

        });
    });

</script>

//add store js
<script>
    //phone Number format
    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
        // separateDialCode: true,
        // any initialisation options go here
    });

    $("#phone").keyup(() => {
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
    });

    $("#submitForm").submit((e) => {
        e.preventDefault();
        const dialCode = test.getSelectedCountryData().dialCode;
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
        $("#phone_number").val(dialCode + $("#phone").val());
        $("#submitForm").off('submit').submit();
    });

</script>

//edit store js

<script>
    var edit_input = document.querySelector("#editphone");

    $("#editphone").keyup(() => {
        if ($("#editphone").val().charAt(0) == 0) {
            $("#editphone").val($("#editphone").val().substring(1));
        }
    });

    var edit_test = window.intlTelInput(edit_input, {
                // separateDialCode: true,
                // autoHideDialCode:true,
               


             });

    // $(".open_edit_store").click(function(event){
        function open_edit_store(element){
        
             edit_test.setNumber("+" + (element.dataset.store_phone_full));
            let store_name = element.dataset.store_name;
            let store_tagline = element.dataset.store_tagline;
            let store_email = element.dataset.store_email;
            let store_address = element.dataset.store_address;
            let store_phone = element.dataset.store_phone;
            let store_id = element.dataset.store_id;

            $("#edit_store_name").val(store_name);
            $("#edit_tagline").val(store_tagline);
            //$("#editphone").val(element.dataset.store_phone_full);
            // $("#edit_phone_number").val(store_phone);
            $("#edit_email").val(store_email);
            $("#edit_shop_address").val(store_address);


            let form_url = "{{route('store.update','1')}}";
            let formatted_url = form_url.replace('1',store_id);
            $("#editStore_form").attr('action',formatted_url);

            // console.log(formatted_url);
        }
       
    // })


    $("#editStore_form").submit((e) => {
        e.preventDefault();
        const dialCode = edit_test.getSelectedCountryData().dialCode;
        if ($("#editphone").val().charAt(0) == 0) {
            $("#editphone").val($("#editphone").val().substring(1));
        }
        console.log(dialCode);
        $("#edit_phone_number").val(dialCode + $("#editphone").val());
        $("#editStore_form").off('submit').submit();
    });
</script>
@stop
