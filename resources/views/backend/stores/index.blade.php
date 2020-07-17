@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop

@if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'store_admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="customer-heading-container">
                    <h4 class="mb-1 mt-0">All Stores</h4>
                    <button class="add-customer-button btn btn-primary" data-toggle="modal">
                        <a href="{{ route('store.create') }}" class="text-white">
                            Add New <i class="fa fa-plus add-new-icon"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        <script>
          setTimeout(() => {
            document.querySelector('.alert').style.display = 'none'
          }, 3000);
        </script>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-lg-12 mt-4">
                                    <div class="row">
                                        <label class="form-control-label">Search Stores</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="search"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer-name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="sub-header">
                            List of all stores
                        </p>
                        <div class="table-responsive">
                            <table class="table mb-0" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Store Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($response as $index => $store )
                                    <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="store-name">{{ $store->store_name }}</td>
                                    <td>{{ $store->shop_address }}</td>
                                    <td>
                                        <div class="btn-group mt-2 mr-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('store.show', $store->_id) }}">View
                                                    Store</a>
                                                <a class="dropdown-item" href="{{ route('store.edit', $store->_id) }}">Edit
                                                    store</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="$(this).parent().find('form').submit()">Delete store</a>
                                                <form action="{{ route('store.destroy', $store->_id) }}" method="POST" id="form">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {});

</script>

<script>

  //for search bar
  let userText = document.querySelector('#customer-name')
  let rows = document.querySelectorAll('.store-name')

  //add input event listener
  userText.addEventListener('keyup', showFilterResults)

  function showFilterResults(e) {
    const users = rows;
    const filterText = e.target.value.toLowerCase();

    users.forEach(function (item) {
      if (item.textContent.toLowerCase().indexOf(filterText) !== -1) {
        item.parentElement.style.display = 'table-row'

      } else {
        item.parentElement.style.display = 'none'

      };
    });
  };
</script>
@stop
@endif

@if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'super_admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <div class="customer-heading-container">
                    <h4 class="mb-1 mt-0">All Stores</h4>

                </div>
            </div>
        </div>
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        <script>
          setTimeout(() => {
            document.querySelector('.alert').style.display = 'none'
          }, 3000);
        </script>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-lg-12 mt-4">
                                    <div class="row">
                                        <label class="form-control-label">Search Stores</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="search"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer-name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="sub-header">
                            List of all stores
                        </p>
                        <div class="table-responsive">
                            <table class="table mb-0" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Store Name</th>
                                        <th scope="col">Store Email</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0
                                    @endphp
                                    @foreach ($response as $index => $stores )
                                    @foreach ($stores as $store)
                                    <tr>
                                        <td>{{ $count += 1 }}</td>
                                        <td class="store-name">{{ $store->store_name }}</td>
                                        <td class="store-email">{{ $store->email }}</td>
                                        <td>{{ $store->shop_address }}</td>
                                        <td>
                                            <div class="btn-group mt-2 mr-1">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('store.show', $store->_id) }}">View
                                                        Store</a>
                                                    <a class="dropdown-item" href="{{ route('store.edit', $store->_id) }}">Edit
                                                        store</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="$(this).parent().find('form').submit()">Delete store</a>
                                                    <form action="{{ route('store.destroy', $store->_id) }}" method="POST" id="form">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                    @endforeach


                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {});

</script>

<script>

  //for search bar
  let userText = document.querySelector('#customer-name')
  let rows = document.querySelectorAll('.store-name')

  //add input event listener
  userText.addEventListener('keyup', showFilterResults)

  function showFilterResults(e) {
    const users = rows;
    const filterText = e.target.value.toLowerCase();

    users.forEach(function (item) {
      if (item.textContent.toLowerCase().indexOf(filterText) !== -1) {
        item.parentElement.style.display = 'table-row'

      } else {
        item.parentElement.style.display = 'none'

      };
    });
  };
</script>
{{-- @if (\Illuminate\Support\Facades\Cookie::get('is_first_time_user') == true) --}}
<script>
    var stores_intro_shown = localStorage.getItem('stores_intro_shown');

    if (!stores_intro_shown) {

        const tour = new Shepherd.Tour({
            defaults: {
                classes: "shepherd-theme-arrows"
            }
        });

        tour.addStep("step", {
            text: "Welcome to Stores Page, here you can create your stores",
            buttons: [
                {
                    text: "Next",
                    action: tour.next
                }
            ]
        });

        // tour.addStep("step2", {
        //     text: "First thing you do is create a store",
        //     attachTo: { element: ".second", on: "right" },
        //     buttons: [
        //         {
        //             text: "Next",
        //             action: tour.next
        //         }
        //     ],
        //     beforeShowPromise: function() {
        //         document.body.className += ' sidebar-enable';
        //         document.getElementById('sidebar-menu').style.height = 'auto';
        //     },
        // });
        tour.start();
        localStorage.setItem('stores_intro_shown', 1);
    }
</script>
{{-- @else --}}
@stop
@endif
