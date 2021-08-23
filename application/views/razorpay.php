<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="container">
  <div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
      <form>
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
          <input type="button" name="pay" id="pay" value="Pay Now" class="form-control btn btn-info" onclick="pay_now()">
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function pay_now(){
    // alert('hi');
    var name = $('#name').val();
    var amount = $('#amount').val();
    var currency = $('#currency').val();
    var description = $('#description').val();

      var options = {
        "key": "rzp_test_V2EDVLQhavXNs1",
        "amount": amount*100,
        "currency": currency,
        "name": name,
        "description": description,
        "image": "https://img.freepik.com/free-psd/logo-mockup_35913-2089.jpg?size=626&ext=jpg",
        "handler": function (response){
            // console.log(response);
            $.ajax({
              type:'POST',
              url:BASE_URL+'dashboard/razorpay_payment_process',
              data:{'name':name,'amount':amount,'currency':currency,'description':description,'payment_id':response.razorpay_payment_id},
              dataType:'json',
              success:function(data){
                  // console.log(data);
                  if (data.status == 1) {
                    // alert('Payment Success');
                    window.location.href=BASE_URL+'dashboard/razorpay_payment_success';
                  }
                  else{
                    // alert('Error while doing payment');
                    window.location.href=BASE_URL+'dashboard/razorpay_payment_failure'
                  }
              }
            });
        }

    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
  }
</script>