<!DOCTYPE html>
<html lang="en">
<head>
  <title>Concepts Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/css/main.css">
  <script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>";
  </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Concepts</a>
    </div>
    <ul class="nav navbar-nav navbar-left">
      <li><a href="<?php echo base_url()?>dashboard"><span class="glyphicon glyphicon-user"></span> Users</a></li>
      <li><a href="<?php echo base_url()?>dashboard/products"><span class="glyphicon glyphicon-gift"></span> &nbsp;Products</a></li>
      <li><a href="<?php echo base_url()?>dashboard/razorpay"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;Razorpay</a></li>
      <li><a href="<?php echo base_url()?>dashboard/nagad"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;Nagad</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" id="total_cart_price">0</span></a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo ucfirst($this->session->userdata['username']);?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>dashboard/signout"><span class="glyphicon glyphicon-log-in"></span>Signout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>