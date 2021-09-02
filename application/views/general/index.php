<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online ordering application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/css/main.css">
</head>
<body>
<div class="container">
  <h2 style="text-align: center;">Amrutham Store</h2>  
  <hr>
  <a href="<?php echo base_url();?>login">
    <h5 style="float: right;">My account<hr></h5>
  </a>  
</div>
<div class="container" id="main_banner">
  <h1>Welcome to Amrutham Store</h1>
</div>
<div class="container hide">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?php echo base_url();?>application/uploads/books.jpg" alt="Los Angeles" style="width:100%;height:500px">
      </div>

      <div class="item">
        <img src="<?php echo base_url();?>application/uploads/fossil.jpg" alt="Chicago" style="width:50%;height:500px">
      </div>
    
      <div class="item">
        <img src="<?php echo base_url();?>application/uploads/pants.jpg" alt="New york" style="width:50%;height:500px">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<div class="items_section container">
  <h2>Food Items</h2>
  <div class="row">
    <?php
        foreach ($food_items as $key => $value) { ?>
          <div class="col-sm-3">
            <div class="items_content">
              <div class="poduct_image">
                <img src="<?php echo base_url().display_path.'/food_items/'.$value['image']?>" height="200" width="200">
              </div>
              <div class="product_info">
                <p class="text-center"><?php echo $value['name']?></p>
                <p class="text-center">INR <?php echo $value['price']?></p>
              </div>
              <div class="add_to_cart">
                <button type="button" class="btn btn-info">Add to cart</button>
              </div>
            </div>
          </div>
       <?php }
    ?>
  </div>
</div>


<div class="items_section container">
  <h2>Products</h2>
  <div class="row">
    <?php
        foreach ($products as $key => $value) { ?>
          <div class="col-sm-3">
            <div class="items_content">
              <div class="poduct_image">
                <img src="<?php echo base_url().display_path.'/'.$value['product_image']?>" height="200" width="200">
              </div>
              <div class="product_info">
                <p class="text-center"><?php echo $value['product_name']?></p>
                <p class="text-center">INR <?php echo $value['price']?></p>
              </div>
              <div class="add_to_cart">
                <button type="button" class="btn btn-info">Add to cart</button>
              </div>
            </div>
          </div>
       <?php }
    ?>
  </div>
</div>

<footer class="footer" id="index_footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="copyright"><?php echo date("Y")?> &copy; amruthamstore All rights reserverd.</div>
      </div>
    </div>
  </div>
</footer>
</body>
</html>