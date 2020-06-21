
@extends('layout.base')
@section("custom_css")
	<link href="/backend/assets/css/materialize.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
@stop



    @section('content')

   <div style="font-family: 'Inter', sans-serif; background-color: white; padding: 10px; margin-top: 10px; border-radius: 10px;">
        <table class="highlight">
        <thead>
          <tr>
              <th>User ID</th>
              <th>Message</th>
              <th>Store Reference Code</th>
              <th>Status</th>
              <th style="width: 10%;">Date</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</td>
            <td>ST145M455</td>
            <td>Closed</td>
            <td>2020-06-23 13:34:67</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</td>
            <td>ST145M455</td>
            <td>Closed</td>
            <td>2020-06-23 13:34:67</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</td>
            <td>ST145M455</td>
            <td>Closed</td>
            <td>2020-06-23 13:34:67</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</td>
            <td>ST145M455</td>
            <td>Closed</td>
            <td>2020-06-23 13:34:67</td>
          </tr>
        </tbody>
      </table>
      </div>

       @endsection


    @section("javascript")
    <script type="text/javascript" src="/backend/assets/js/materialize.min.js"></script>


    @stop
