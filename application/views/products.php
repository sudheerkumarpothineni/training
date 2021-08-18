<div class="container-fluid">
  <div class="add_heading_section">
   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#products_modal">Add Product</button>
  </div>
  <h3>Products</h3>
  <div class="hr_heading">
    <hr>
  </div>
  <div class="add_cart text-right">
      <button type="button" class="btn btn-info">Add to cart</button>
  </div>
  <br>
  <div class="row">
    <?php
        foreach ($products as $key => $value) { ?>
          <div class="col-sm-2">
            <div class="poduct_image">
              <img src="<?php echo base_url().display_path.'/'.$value['product_image']?>" height="200" width="200">
            </div>
            <div class="product_info">
              <p class="text-center"><?php echo $value['product_name']?></p>
              <p class="text-center">INR <?php echo $value['price']?></p>
              <!-- <p style="float:right;"><?php echo $value['price']?></p> -->
            </div>
          </div>
       <?php }
    ?>
  </div>
</div>



<!-- Modal -->
<div id="products_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
        <?php
            if ($this->session->flashdata('message')) { ?>
              <script>
                $(window).on('load',function(){
                   $('#products_modal').modal('show');
                });
             </script>
             <?php echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
            }
        ?>
      </div>
      <div class="modal-body">
        <div>
        <form class="user_form" id="product_adding_form" action="<?php echo base_url()?>dashboard/add_product" method="POST" enctype="multipart/form-data">
        <div class="form-group col-sm-6">
          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo set_value('product_name')?>" required>
          <span class="text-danger"><?php echo form_error('product_name');?></span>
        </div>
        <div class="form-group col-sm-6">
          <label for="price">Price</label>
          <input type="text" name="price" id="price" class="form-control" value="<?php echo set_value('price')?>" required>
          <span class="text-danger"><?php echo form_error('price');?></span>
        </div>
        <div class="form-group col-sm-6">
          <label for="quantity">Quantity</label>
          <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo set_value('quantity')?>" required min="1" max="10">
          <span class="text-danger"><?php echo form_error('quantity');?></span>
        </div>
        <div class="form-group col-sm-6">
          <label for="product_image">Product Image</label>
          <input type="file" name="product_image" id="product_image" class="form-control"  value="<?php echo set_value('product_image')?>" required>
          <span class="text-danger"><?php echo form_error('product_image');?></span>
        </div>
        <div class="form-group col-sm-6">
          <label for="submit"></label>
          <input type="submit" name="submit" id="submit" class="form-control btn btn-info" value="Submit">
        </div>
      </form>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>