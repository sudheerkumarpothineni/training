<div class="container">
  <div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
      <form action="<?php echo base_url()?>dashboard/test_nagad" method="POST">
        <div class="form-group">
          <label>Customer Name</label>
          <input type="text" name="name" id="name" required class="form-control" placeholder="Customer Name">
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="text" name="amount" id="amount" required class="form-control" placeholder="Amount">
        </div>
        <div class="form-group">
          <label>Currency</label>
          <select name="currency" required class="form-control" id="currency">
            <option value="">Please select currency</option>
            <option value="INR">INR</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="AED">AED</option>
          </select>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
          <label></label>
          <input type="submit" name="pay" id="pay" value="Pay Now" class="form-control btn btn-info">
        </div>
      </form>
    </div>
  </div>
</div>