
@extends('layout.base')
@section("custom_css")
	<link href="/backend/assets/css/complaintlog.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
@stop

  @section('content')
    <div class="table-responsive">
      <table class="table complaintlog-table">
        <thead>
          <tr>
              <th>S/N</th>
              <th>Name</th>
              <th>Email Address</th>
              <th>Message</th>
              <th>Status</th>
              <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Alan Jellybean</td>
            <td>alan@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>Closed</td>
            <td>2020-06-23 13:34:47</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Alvin Eclair</td>
            <td>eclair@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>Closed</td>
            <td>2020-05-23 23:17:23</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Elvis Mooney</td>
            <td>mooney@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>Closed</td>
            <td>2020-05-16 13:45:57</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Jonathan Lollipop</td>
            <td>jonathan@gmail.com</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut.</td>
            <td>Closed</td>
            <td>2020-05-23 12:54:32</td>
          </tr>
        </tbody>
      </table>
    </div>
  @endsection
