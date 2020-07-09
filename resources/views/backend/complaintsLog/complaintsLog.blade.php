
@extends('layout.base')
@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="/backend/assets/css/complaintsLog.css">
@stop
    
@section('content')
    <div class="container">
        <div class="content">
            <div class="row page-title">
                <div class="col-md-12">
                    <div class="h4"><i data-feather="book" class="icon-dual"></i>Complaint Log</div>
                </div>
            </div>
            <div class="container-fluid">

                <div class="card-header">
                    <div class="h5">All Complaints</div>
                </div>
                
                <div class="card-body p-1 card">
                    <div class="table-responsive table-data">
                        <table id="basic-datatable" class="table dt-responsive nowrap">
        
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Full Name</th>
                                    <th>Telephone</th>
                                    <th>Store</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="/backend/assets/images/users/avatar-1.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>John Doe</td>
                                    <td>+234 90 000 000 00</td>
                                    <td>1</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td><img src="/backend/assets/images/users/avatar-2.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>Mary Doe</td>
                                    <td>+44 0000 123456</td>
                                    <td>2</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td><img src="/backend/assets/images/users/avatar-3.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>Helen Cena</td>
                                    <td>+44 0560 921456</td>
                                    <td>3</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td><img src="/backend/assets/images/users/avatar-4.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>Tai Ming</td>
                                    <td>+44 0500 123476</td>
                                    <td>4</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td><img src="/backend/assets/images/users/avatar-5.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>Chike Ogbunna</td>
                                    <td>+234 90 123 534 00</td>
                                    <td>5</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><img src="/backend/assets/images/users/avatar-6.jpg"
                                        class="avatar-sm rounded-circle" alt="Shreyu" />
                                    </td>
                                    <td>Mary Oyakhilome</td>
                                    <td>+234 34 921 000 54</td>
                                    <td>6</td>
                                    <td class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus neque provident pariatur aut doloremque? Illo ipsam perspiciatis sint ducimus cupiditate tenetur debitis, vero modi architecto amet eveniet alias eaque. Atque!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card -->
                </div>
            </div>
        </div>
    </div>
@endsection


@section("javascript")

@stop
