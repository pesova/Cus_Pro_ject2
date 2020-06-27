@extends('layout.base')
@section("custom_css")
	<!-- <link href="/frontend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="/backend/assets/css/materialize.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  
  
@stop



    @section('content')
    <?php
              $msg = '';
              $msgclass = '';
                if(filter_has_var(INPUT_POST, 'submit')){
                  $message = "message";
                  if(!empty($message)){
                      echo 'PASSED';
                  }else{
                    $msg = 'Please Fill in all Fields';
                    $msgclass = 'btn-danger';
                  }
                }
                ?>
    <style type="text/css">
      @media screen and (max-width: 670px){
        .container{
          max-width: 500px;
          /*margin: 0px;*/
          padding: 0px;
        }
      }
    </style>
            <div class="container" style="padding: 20px; background-color: white; margin-top: 15px; border-radius: 10px;">
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <?php if($msg = '' ): ?>
                  <div class="btn <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
              <?php endif; ?>
              @csrf
              <h5>Log your Complain</h5><br>
              <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <input id="full_name" disabled type="text" class="validate">
                <label for="full_name">User ID</label>
              </div><br>
              <div class="input-field">
                <i class="material-icons prefix">store</i>
                <input id="email" disabled type="email" class="validate">
                <label for="email">Store ID</label>
              </div><br>
              <div class="input-field">
                <i class="material-icons prefix">edit</i>
                <textarea id="textarea1" name="message" class="materialize-textarea"></textarea>
                <label for="textarea1">Message</label>
              </div><br>
              <div style="margin-bottom: 50px;">
                <button style="color: white;" name="btn" class="waves-effect waves-light btn right"><i class="material-icons left">send</i>SUBMIT</button>
              </div></form>
          </div>
          </form>
    </div>
      </div>

       @endsection


    @section("javascript")
    <script type="text/javascript" src="/backend/assets/js/materialize.min.js"></script>


    @stop
