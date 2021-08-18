<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/css/main.css">
  <style type="text/css">
    .container{
      padding-top: 50px;
    }
  </style>
</head>
<body>
 
<div class="container">
  <div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
      <h3 class="text-center">Sign in to proceed</h3>
      <hr>
      <form class="user_form" id="user_registration_form" action="<?php echo base_url()?>login/validation" method="POST">
        <div class="form-group">
          <label for="username">Email/Mobile</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username')?>">
          <span class="text-danger"><?php echo form_error('username');?></span>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password')?>">
          <span class="text-danger"><?php echo form_error('password');?></span>
        </div>
        <div class="form-group">
          <label for="submit"></label>
          <input type="submit" name="submit" id="submit" class="form-control btn btn-info" value="Submit">
        </div>
      </form>

      <span>
        <?php
          if ($this->session->flashdata('message')) {
            echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."<div>";
          }
        ?>
      </span>
      
    <p>If you don't have a account ? <a href="<?php echo base_url()?>register">Register</a></p>
    </div>
  </div>
</div>

</body>
</html>
