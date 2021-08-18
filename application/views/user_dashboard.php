<!-- DATATABLE -->
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<div class="container-fluid">
  <h3>Users</h3>
  <div class="hr_heading">
    <hr>
  </div>
  <?php
      if ($this->session->flashdata('message')) { ?>
       <?php echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
      }
  ?>
  <div class="table-responsive">          
  <table class="table" id="user_table">
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
       // debug($data);exit;
      $i=1;
      foreach ($data as $key => $value) {
        ?>
        <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $value['username']?></td>
          <td><?php echo $value['email']?></td>
          <td><?php echo $value['mobile']?></td>
          <td>
            <button type="button" class="btn btn-info edit_modal" id="<?php echo $value['origin'];?>" data-toggle="modal" data-target="#user_modal">Edit</button>
            <a href="<?php echo base_url()?>dashboard/user_delete?origin=<?php echo $value['origin'];?>" onclick="return confirm('Are you sure you want to Delete?')"><button type="button" class="btn btn-danger" id="delete">Delete</button></a>
            <?php 
              if ($value['status'] == ACTIVE) {
                $class='btn-success';
                $text='Active';
              }
              else{
                $class='btn btn-danger';
                $text='In-Active';
              }
            ?>
            <button type="button" class="btn <?php echo $class?> active_inactive" id="<?php echo $value['origin'];?>" value="<?php echo $value['status']?>"><?php echo $text?></button>
          </td>
        </tr>
      <?php $i++; }
      ?>
      
    </tbody>
  </table>
  </div>
</div>


<!-- Modal -->
<div id="user_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update</h4>
      </div>
      <div class="modal-body">
        <form class="user_form" id="user_registration_form" action="<?php echo base_url()?>register/validation" method="POST">
          <div class="form-group col-sm-6">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required class="form-control form_validation"  value="<?php echo set_value('username')?>">
            <input type="hidden" name="origin" id="origin">
            <span class="text-danger"><?php echo form_error('username');?></span>
          </div>
          <div class="form-group col-sm-6">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required class="form-control form_validation"  value="<?php echo set_value('email')?>">
            <span class="text-danger"><?php echo form_error('email');?></span>
          </div>
          <div class="form-group col-sm-6">
            <label for="mobile">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" required class="form-control form_validation"  value="<?php echo set_value('mobile')?>">
            <span class="text-danger"><?php echo form_error('mobile');?></span>
          </div>
          <div class="form-group col-sm-6">
            <label for="submit"></label>
            <input type="submit" name="submit" id="submit" class="form-control btn btn-info" value="Update">
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- DATATABLE -->
    <script type="text/JavaScript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/JavaScript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).on('click','.edit_modal',function(){
    var origin = $(this).attr('id');
    // alert(origin);
    $.ajax({
      type:'POST',
      url:BASE_URL+'dashboard/single_user_details',
      data:{'origin':origin},
      dataType:'json',
      success:function(data){
        // alert(data);
        // console.log(data.username);
        $("#origin").val(data.origin);
        $("#username").val(data.username);
        $("#mobile").val(data.mobile);
        $("#email").val(data.email);

      }
    });
  });

  $(document).on('click','.active_inactive',function(){
    var origin = $(this).attr('id');
    var status = $(this).attr('value');
    // alert(origin+' '+status);
    $.ajax({
      type:'POST',
      url:BASE_URL+'dashboard/active_inactive',
      data:{'origin':origin,'status':status},
      dataType:'json',
      success:function(data){
        // alert(data);
        // console.log(data.username);
        if (data == 1) {
           // alert('status changed successfully');
           location.reload();
        }

      }
    });
  });

  $(document).ready(function() {
        $("#user_table").DataTable();
      });
</script>
