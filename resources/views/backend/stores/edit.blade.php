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
                                    <form action="{{ route('store.update', $response->_id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="store name">Store Name</label>
                                            <input type="text" name="store_name" class="form-control" value="{{ $response->store_name }}"  placeholder="XYZ Stores">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputTagline">Tagline</label>
                                            <input type="text" name="tag_line" class="form-control" id="inputTagline" placeholder="Your Perfect Stay One Click away....">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputPhoneNumber">Phone Number</label>
<<<<<<< HEAD
                                            <input type="text" name="phone_number" class="form-control" placeholder="+2348127377463">
=======
                                            <input type="text" name="phone_number" class="form-control" placeholder="+2348173644654">
>>>>>>> fa639b5b7784e8c2e255a2ea8917314d33571271
                                          </div>
                                        <div class="form-group col-md-6" >
                                            <label for="inputEmailAddress"> Email Address (optional) </label>
                                            <input type="email" name="email" class="form-control" placeholder="you@example.com">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress">Address</label>
                                          <input type="text" name="shop_address" class="form-control" value="{{ $response->shop_address }}"  placeholder="123 Abby Avenue">
                                        </div>
<<<<<<< HEAD
                                        <button type="submit" class="btn btn-success" data-toggle="" data-target="">
=======
                                        <button type="submit" class="btn btn-success">
>>>>>>> fa639b5b7784e8c2e255a2ea8917314d33571271
                                            Update Changes
                                        </button>
                                    </form>
                                </div>
                             </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
<<<<<<< HEAD
<<<<<<< HEAD
                
=======
                <div class="modal-body">
                  Do you want to save these changes to your store profile?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success"><a href="{{ route('store.update', $response->_id) }}" class="text-white">Save changes</a></button>
>>>>>>> 44103833ae28ec9ebce2e92dc6e2cb57b0503cbb
                </div>
=======
                
>>>>>>> fa639b5b7784e8c2e255a2ea8917314d33571271
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
