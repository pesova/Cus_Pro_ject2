@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
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
            @foreach ($stores as $store_index)
            @php
            $store = $store_index[0];
            @endphp
            <div class="col-xl-3 col-sm-6" style="margin-bottom: 20px;">
                <div id="idd" class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                @php
                                $names = explode(" ", strtoupper($store->store_name));
                                $ch = "";
                                foreach ($names as $name) {
                                $ch .= $name[0];
                                }
                                echo $ch;
                                @endphp
                            </span>
                        </div>
                        <h5 class="font-size-15"><a href="{{ route('store.show', $store->_id) }}"
                                class="text-dark search-name">{{$store->store_name }}</a>
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
                                <a href="#" data-toggle="modal" data-target="#editStore-{{ $store->_id }}"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <i data-feather="edit"></i>
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
            @include('backend.stores.modals.editStore')

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
</div>
@endsection

@section("javascript")

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
@stop
