{{-- inherits base markup --}}
@extends('layout.base')

{{-- add in the basic styling : check the contents of these stylesheets later --}}
@section("custom_css")
  <link rel="stylesheet" href="{{asset('backend/assets/css/singleCustomer.css')}}">
@stop


{{-- yield body content --}}

@section('content')
<div class="content">
  @isset($response)
    <div class="container-fluid">
        {{-- start of page title --}}
        <div class="row page-title">
            <div class="col-md-12">
                <h4 class="mb-1 mt-0 float-left">Edit Profile Page</h4>
                <a href="{{ route('customer.index') }}" class="btn btn-primary float-right" >
                    Go Back {{-- &nbsp;<i class="fa fa-plus my-float"></i> --}}
                </a>
            </div>
        </div>
         {{-- end of page title --}}

         {{-- start of content section --}}
         <div class="row contentrow">
             {{--start of person profile--}}
             <div class="col-lg-3 col-md-4 col-sm-5" id="h1IdTop">
                 <div class="card">
                     <div class="card-body text-center text-muted">
                         {{-- <img src="../../backend/assets/images/users/avatar-7.jpg" alt="Customer 1" class="img-fluid rounded-circle"> --}}
                         <h4>{{ ucfirst($response->customer->name) }}</h4>
                          {{-- <h5 class="cust-email">{{ $response->email }}</h5> --}}
                     </div>
                     {{-- <div class="address">
                         <h5>House Address</h5>
                         <p class="customer-address">1975, Boring Lane, San <br>Francisco, California, United<br> States - 94108</p>
                     </div> --}}
                 </div>
             </div>
             {{--end of person profile--}}

             <div class="col-lg-9 col-md-8 col-sm-7">
                {{-- start of card --}}
                @if(Session::has('message'))
                  <br>
                  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                  <script>
                    setTimeout(() => {
                        document.querySelector('.alert').style.display = 'none'
                    }, 3000);
                  </script>
                @elseif ( $errors->any() )
                  <br class='alert'>
                  @foreach ( $errors->all() as $error )
                      <p class="alert alert-danger">{{$error}}</p>
                  @endforeach
                @endif
                
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="post" action="{{ route('customer.update', $response->customer->_id) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Full Name:</label>
                            <div class="col-lg-8">
                              <input style="width:100%" class="form-control" type="text" value="{{old('name', $response->customer->name)}}" name="name" required pattern=".{5,30}" title="Customer name must be at least 5 characters and not more than 30 characters">
                            </div>
                          </div>

                          {{-- <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                            <input class="form-control" type="text" value="{{$response->email}}" name="email" required>
                            </div>
                          </div> --}}

                          <div class="form-group">
                              <label class="col-lg-3 control-label">Tel:</label>
                              <div class="col-lg-8">
                                <input class="form-control" type="phone" value="{{old('phone_number', $response->customer->phone_number)}}" name='phone_number' required pattern=".{8,15}" title="Phone number must be between 8 to 15 characters">
                              </div>
                            </div>
                            {{-- <div class="form-group">
                              <div class="col-md-8">
                                  <select class="form-control" required>
                                      <option selected="">Customer Type</option>
                                      <option>Good Debtor</option>
                                      <option>Bad Debtor</option>
                                      <option>Doesn't Owe</option>                                        
                                    </select>
                                </div>                                
                            </div>   --}}
                            {{-- <div class="form-group">
                              <div class="col-md-8">
                                  <select class="form-control" required>
                                      <option selected="">Status</option>
                                      <option class="text-danger">Has Debt</option>
                                      <option class="text-success">No Debt</option>                                        
                                    </select>
                                </div>                                
                            </div>                                                            --}}
                            
                          {{-- <div class="form-group">
                            <label class="col-md-3 control-label green-border-focus">House Adddress</label>
                            <div class="col-md-8">                                
                              <textarea class="form-control " rows="3">1975, Boring Lane, San
                                  Francisco, California, United
                                  States - 94108</textarea>
                              
                            </div>
                          </div> --}}
                          
                          {{-- <div class="form-group">
                              <label class="col-md-3 control-label">Short Comment</label>
                              <div class="col-md-8">
                                <input class="form-control" type="text" value="this is a very very large junk of rubbush that i am just foing to type">
                              </div>
                          </div> --}}

                          <div class="form-group">
                              <label class="col-md-3 control-label">Store Name</label>
                              <div class="col-md-8">
                                <select name="store_name" class="form-control" disabled required>
                                  @if ( isset($stores) )
                                    @foreach ($stores as $store)
                                      <option @if ( ($store->store_name == $response->storeName) ) 
                                        value="{{$store->_id}}" disabled selected @endif>{{$response->storeName}}
                                      </option>
                                    @endforeach
                                  @else
                                    <option disabled selected value="">-- You have not registered a store yet --</option>
                                  @endif
                                </select>
                              </div>
                          </div>
                          {{-- <div class="form-group">
                              <div class="col-md-8">
                                  <input type="file" id="main-input" class="form-control form-input form-style-base">                                        
                                </div>                                
                            </div> --}}

                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                              <input type="submit" class="btn btn-primary" value="Save Changes">
                              <span></span>
                              <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                          </div>
                        </form>

                        {{--customer basic info end--}}
                    </div>
                </div>
                <!-- end card --> 
        </div>
         {{--End of person profile--}}
         </div>

    
        
        {{--end of column--}}
    </div>
  @endisset
</div>

@endsection
