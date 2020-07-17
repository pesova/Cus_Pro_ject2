@extends('layout.base')
@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/backend/assets/css/broadcasts.css">
{{-- <link rel="stylesheet" href="backend/assets/css/all_users.css"> --}}

@stop
@section('content')
<div class="container">

    <div class="container-content">

        <div class='heading-container'>
                @if(session('response'))
                <p class="alert alert-success">{{ session('response') }}</p>
                @endif

            <h2>
                <i class="far fa-envelope"></i>
                Broadcast Message
            </h2>

            <div class="bg">
                <div class="heading-content">
                    <div class="heading-container-text">
                        <div class="text">
                            <h2 style="color: #ffffff">Marketing</h2>
                            <p>Show your customers how much you care</p>
                        </div>
                    </div>

                    <div class="message-card">
                        <div class="message-card-text">
                            <h3>Happy New Year!</h3>
                            <p class="text2">Celebrate the new year with your customers</p>
                            <p class="text2">Send them a message</p>
                        </div>

                        <div class="message-card-link">

                         
                            <p><a href="{{ route('broadcast.create') }}"> Send a Happy New Year wish</a></p>
                            <i class="fas fa-arrow-right" ></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <form action="">

                <div class="search">
                    <input class="mainLoginInput" type="search" placeholder="&#61442; Search Customer mail"
                        style="font-family: Arial, 'Font Awesome 5 Free'">
                </div>

                <div>
                    <h4>Frequently Contacted</h4>
                </div>
                
            
                <div class="contacts">
                    <div class="table-responsive">
                        <table class="table mb-0" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th scope="col" class="indexing">ID</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Tel</th>
                                    {{-- <th scope="col">Debt</th>
                                                            <th scope="col">Balance</th> --}}
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if ( isset($data) && count($data) > 0 )
                            @for ($i = 0; $i < count($data); $i++)          
                                <tr>
                                    <td scope="row" class="indexing">{{$i + 1}}</td>
                                    <td><img src="/backend/assets/images/users/avatar-1.jpg"
                                            class="avatar-sm rounded-circle" alt="Shreyu" /></td>
                                    <td>{{isset($data[$i]->name) ? ucfirst($data[$i]->name) : 'Not available'}} <br>
                                        <span class="badge badge-success">Has debt</span>
                                    </td>
                                    <td>{{isset($data[$i]->phone_number) ? $data[$i]->phone_number : 'Not available'}}<br>
                                    </td>
                                    {{-- <td>
                                                                <span> &#8358; 6 000</span> <br>
                                                                <span class="badge badge-primary">Paid: 3 500</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-success">&#8358; 2 500</span>
                                                            </td> --}}
                                    <td>
                                        <div class="btn-group mt-2 mr-1">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions<i class="icon"><span data-feather="chevron-down"></span></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('customer.edit', 2) }}">Edit Customer</a>
                                                <a class="dropdown-item" href="{{ route('customer.show', 2) }}">View
                                                    Profile</a>
                                                <a class="dropdown-item" href="{{ route('transaction.show', 2) }}">View
                                                    Transaction</a>
                                                <a class="dropdown-item" href="{{ route('debtor.create') }}">Send
                                                    Reminder</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endfor

                             </tbody>
                        </table>
                    </div>
                </div>

                @endif

                <div class="button-container">
                    <a href="{{ route('broadcast.create') }}" class="buttons">
                        <i class="fas fa-paper-plane"></i>
                        Send a Message
                    </a><br>
                    <button type='button' class="buttons inverted"> Send Bulk Mail</button>
                </div>
            </form>

        </div>

    </div>

</div>

@endsection


@section("javascript")



@stop
