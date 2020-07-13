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
                            <a href="/admin/store" class="btn btn-primary">Go Back</a>
                        </nav>
                        <h4 class="mt-2">Edit My Store</h4>
                    </div>
                </div>

                @if(session('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
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
                                    @if (isset($response->_id))
                                        <form action="{{ route('store.update', $response->_id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="store name">Store Name</label>
                                            <input type="text" name="store_name" class="form-control" value="{{old('store_name', $response->store_name)}}"  placeholder="XYZ Stores" required minlength="2" maxlength="25">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputTagline">Tagline</label>
                                            <input type="text" name="tag_line" class="form-control" id="inputTagline" value="{{old('tagline', $response->tagline)}}" placeholder="Your Perfect Stay One Click away...." required>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputPhoneNumber">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" value="{{old('phone_number', $response->phone_number)}}" placeholder="+2348173644654" minlength="6" maxlength="16">
                                          </div>
                                        <div class="form-group col-md-6" >
                                            <label for="inputEmailAddress"> Email Address </label>
                                            <input type="email" name="email" class="form-control" value="{{old('email', $response->email)}}" placeholder="you@example.com">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress">Address</label>
                                          <input type="text" name="shop_address" class="form-control" value="{{old('shop_address', $response->shop_address)}}"  placeholder="123 Abby Avenue" minlength="5" maxlength="50">
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            Update Changes
                                        </button>
                                    </form>
                                    @else
                                        <p>Error retrieving store information please reload</p>
                                    @endif
                                    
                                </div>
                             </div>
                        </div>
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
