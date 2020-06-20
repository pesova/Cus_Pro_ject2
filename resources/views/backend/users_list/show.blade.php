
    @extends('layout.base')
@section("custom_css")
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
         <link rel="stylesheet" href="{{ asset('backend/assets/css/single_user.css')}}">
@stop
       @section('content')
                     <div class="row page-title">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">User Profile</h4>
                        </div>
                    </div>
    <div id="profile">
   
        <div class="img-container">
            <img src="{{ asset('backend/assets/images/avatar2.png')}}" alt="Profile Image">
        </div>
        <h2 id="profile-name">Profile Name</h2>
        <p class="profile-items"><i class="fa fa-user-tag"></i> Role: <span class="value">Shop Owner</span> </p>
        <p class="profile-items"><i class="fa fa-store"></i>Shop Name: <span class="value">Tokyo Fashion</span> </p>
        <p class="profile-items"> <i class="fa fa-phone-alt"></i> Phone Number: <span class="value">00909094004</span>
        </p>
        <p class="profile-items"><i class="fa fa-envelope"></i>Email: <span class="value">tokyo@gmail.com</span> </p>
         <p class="profile-items"><i class="fa fa-globe"></i>Status: <span class="value">Activated</span> </p>
          <p class="profile-items"><i class="fa fa-users"></i>Customers: <span class="value">90</span> </p>
          <div>

          </div>
    </div>
        @endsection


    @section("javascript")


                
    @stop