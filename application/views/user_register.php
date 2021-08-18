<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>";
  </script>
  <style type="text/css">
    .container{
      padding-top: 50px;
    }
    #otp_error{
      color: red;
    }
  </style>
</head>
<body>
 
<div class="container">
  <div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
      <h3 class="text-center">User Registration</h3>
      <hr>
      <form class="user_form" id="user_registration_form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required class="form-control form_validation"  value="<?php echo set_value('username')?>">
          <span class="text-danger"><?php echo form_error('username');?></span>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" required class="form-control form_validation"  value="<?php echo set_value('email')?>">
          <span class="text-danger"><?php echo form_error('email');?></span>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number</label>
          <input type="text" name="mobile" id="mobile" required class="form-control form_validation"  value="<?php echo set_value('mobile')?>">
          <span class="text-danger"><?php echo form_error('mobile');?></span>
        </div>
        <div class="form-group">
          <label for="otp"></label>
          <input type="submit" name="submit" id="otp" class="form-control btn btn-info" value="OTP">
        </div>
        <span id="duplicates"></span>
      </form>

      <div class="otp_section">
        <div class="form-group">
          <label for="otp_value">OTP</label>
          <input type="hidden" name="origin" id="otp_origin" class="origin">
          <input type="text" name="otp_value" id="otp_value" class="form-control">
          <span id="otp_error"></span>
        </div>
        <div class="form-group">
          <label for="validate_otp"></label>
          <input type="button" name="submit" id="validate_otp" class="form-control btn btn-info" value="Validate Otp">
        </div>
      </div>

      <div class="password_section">
        <input type="hidden" name="origin" id="password_origin" class="origin">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password')?>">
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo set_value('confirm_password')?>">
        </div>
        <div class="form-group">
          <label for="submit"></label>
          <input type="button" name="submit" id="final_submit" class="form-control btn btn-info" value="Submit">
        </div>
        <span id="final_message"></span>
      </div>
      <p>If you already have a account ? <a href="<?php echo base_url()?>login">Login</a></p>
    </div>
  </div>
</div>

</body>
</html>



<script type="text/javascript">
  $('document').ready(function(){
    $('.otp_section,.password_section').css('display','none');

    $('#otp').on('click',function(event){
      event.preventDefault();
      // $('.form_validation').each(function(){
      //   if(this.value == ''){
      //     // alert('hi');
      //     $(this).siblings('#main_error').remove();
      //     $(this).parent().append('<span id="main_error" class="text-danger">This field is required</span>');
      //   }
      //   else{
      //     $(this).siblings('#main_error').remove();
      //     $(this).parent().append('<span id="main_error" class="text-danger"></span>');
      //   }
      // });
      var data = $('#user_registration_form').serialize();
      $.ajax({
        url: BASE_URL+"register/validation",
        type:"POST",
        data:data,
        dataType:"json",
        cache: false,
        success: function(data){
          // console.log(data);
          // console.log(data.status);
          if (data.status == 'success') {
            $('#user_registration_form').css('display','none');
            $('.otp_section').css('display','block');
            $('.origin').val(data.last_inserted_id);

          }
          else{
            $('#duplicates').html("<div class='alert alert-danger'>"+data.validation_errors+"</div>");
          }
        }
      });
    });

    $('#validate_otp').on('click',function(event){
      event.preventDefault();
      var otp_value = $('#otp_value').val();
      var origin = $('#otp_origin').val();
      if (otp_value.length == 0) {
        $('#otp_error').html("Otp is required");
        return false;
      }
      else{
        // return true;
        $.ajax({
        url: BASE_URL+"register/verify_otp",
        type:"POST",
        data:{'otp':otp_value,'id':origin},
        dataType:"json",
        cache: false,
        success: function(data){
          // console.log(data);
          if (data.status == 'success') {
            $('.otp_section').css('display','none');
            $('.password_section').css('display','block');
          }
          else{
            $('#otp_error').html(data.status);
          }
        }
        });
      }
    });

    $('#final_submit').on('click',function(event){
      event.preventDefault();
      var password = $('#password').val();
      var confirm_password = $('#confirm_password').val();
      var origin = $('#password_origin').val();
      if (password == '' && confirm_password == '') {
        $('#final_message').html("<div class='alert alert-danger'>All fields are required.</div>");
        return false;
      }
      else if (password!=confirm_password) {
        $('#final_message').html("<div class='alert alert-danger'>Password & Confirm Password must match.</div>");
        return false;
      }
      else{
        // return true;
        $.ajax({
        url: BASE_URL+"register/password_adding_to_registering_user",
        type:"POST",
        data:{'password':password,'id':origin},
        dataType:"json",
        cache: false,
        success: function(data){
          // console.log(data);
          if (data.status == 'success') {
            $('#final_message').html("<div class='alert alert-success'>"+data.status+"</div>");
          }
          else{
            $('#final_message').html("<div class='alert alert-danger'>"+data.status+"</div>");
          }
        }
        });
      }
    });
  });
</script>
