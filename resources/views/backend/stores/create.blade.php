@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop
    @section('content')
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <a href="{{ route('store.index') }}" class="btn btn-primary">Go Back</a>
                        </nav>
                        <h4 class="mt-2">Create A Store</h4>
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
                     <div class="col-lg-12">
                         <div class="card">
                            <div class="card-body">
                                    <form action="{{ route('store.store') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="store name">Store Name*</label>
                                            <input type="text" name="store_name" class="form-control" value="{{ old('store_name') }}"  placeholder="XYZ Stores" required minlength="3" maxlength="16">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputTagline">Tagline*</label>
                                            <input type="text" name="tagline" class="form-control" id="inputTagline" value="{{ old('tagline') }}"  required minlength="4" maxlength="50">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputPhoneNumber">Phone Number*</label>
                                            <input type="tel" name="phone_number" id="phone" value="{{ old('phone_number') }}" class="form-control" placeholder="+2348127737643" required minlength="6" maxlength="16">
                                          </div>
                                        <div class="form-group col-md-6" >
                                            <label for="inputEmailAddress"> Email Address (Optional)</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress">Address*</label>
                                          <input type="text" name="shop_address" class="form-control" value="{{ old('store_address') }}"  required minlength="5" maxlength="50">
                                        </div>
                                        <button type="submit" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModal">
                                           Create Store
                                        </button>
                                      </form>
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
   window.intlTelInput(input, {
       // any initialisation options go here
   });
   </script>
@stop
