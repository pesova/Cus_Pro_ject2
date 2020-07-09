@extends('layout.frontbase')
@section("custom_css")
    <link rel="stylesheet" href="/frontend/assets/css/blog.css">
@stop

@section('content')

<div class="header">
    <h2>Welcome to MyCustomer Blog</h2>
</div>

<div class="row">
    <div class="leftcolumn">
    <!-- Blog Post -->
    <div class="card mb-4">
              <img class="card-img-top" src="/frontend/assets/img/bg-img/7.png" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title">Here’s everything myCustomer offers just for you!</h2>
                <p class="card-text">MyCustomer is an on-demand, scalable ledger solution for small and medium sized businesses globally.</p>
                <a href="#" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on July 2, 2020 by
                <a href="#">Team Justice</a>
              </div>
    </div>
    <!-- Blog Post -->
        <div class="card mb-4">
            <img class="card-img-top" src="/frontend/assets/img/bg-img/33.png" alt="Card image cap"> 
              <div class="card-body">
                <h2 class="card-title">More on our products</h2>
                <p class="card-text">We have reached a wide number of small buisness owners in NIgeria and our goal is to reach small buisness owners all over Africa and keep impacting on their lives </p>
                <a href="#" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on July 7, 2020 by
                <a href="#">Team Justice</a>
              </div>
            </div>
         </div>
    <div class="rightcolumn">
        <div class="card">
            <h2 style="text-align:center">About Us</h2>
            <div class="testimonial-img-container">
            <img src="/frontend/assets/images/fulllogo.png" alt="about" class="">
            </div>
            <p>Some text about MyCustomer taking the tech world by storm!</p>
        </div>
        <div class="card">
            <h3>Popular Post</h3>
            <a href="#"><img src="/frontend/assets/img/bg-img/subscribe-2.png" alt="popular post">
            <p width=50%>Getting started</p></a><br>
            <a href="#"><img src="/frontend/assets/img/bg-img/illustration-23.png" alt="popular post">
            <p width=50%>All you need to know about MyCustomer</p></a><br>
            <a href="#"><img src="/frontend/assets/img/bg-img/33.png" alt="popular post">
            <p width=50%>Brining the tech world to the masses</p></a>
        </div>
        <div class="card">
            <h3>Follow Me</h3>
            <p>Follow us on Social Media</p>
            <div class="b-social">
            <i class="fa fa-instagram" style="font-size:24px"></i>
            <i class="fa fa-twitter" style="font-size:24px"></i>
            <i class="fa fa-facebook-square" style="font-size:24px"></i>
            <i class="fa fa-git-square" style="font-size:24px"></i></div>
        </div>
    </div>
</div>

@endsection

@section("javascript")


@stop
