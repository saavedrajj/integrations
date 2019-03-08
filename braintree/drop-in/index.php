<?php require_once("../../includes/braintree-credentials.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Braintree - Drop-In UI</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
 <script src="https://js.braintreegateway.com/web/dropin/1.16.0/js/dropin.min.js"></script>
</head>
<style>

body {
  background-color: #fff;
}

.panel {
  width: 80%;
  margin: 2em auto;
}

.bootstrap-basic {
  background: white;
}

.panel-body {
  width: 90%;
  margin: 2em auto;
}

.helper-text {
  color: #8A6D3B;
  font-size: 12px;
  margin-top: 5px;
  height: 12px;
  display: block;
}

/* Braintree Hosted Fields styling classes*/
.braintree-hosted-fields-focused { 
  border: 1px solid #0275d8;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
}

.braintree-hosted-fields-focused.focused-invalid {
  border: 1px solid #ebcccc;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(100,100,0,.6);
}

@media (max-width: 670px) {
  .btn {
    white-space: normal;
  }
}
</style>
<body>
  <?php include "../../includes/navbar.php"; ?>
  <div class="container">
    <h1>Braintree</h1>
    <h2>Drop-In UI</h2>
    <?php //include "../includes/credit-cards.html"; ?>
    <form method="post" id="payment-form" action="checkout.php">

      <div class="form-group">
        <label for="amount">Amount</label>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">£</span>
          </div>
          <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" aria-label="0.00" aria-describedby="basic-addon1">
        </div>
      </div>

      <div id="dropin-container"></div>
      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <button  id="submit-button" class="btn btn-secondary btn-lg btn-block">Submit payment</button>
    </form>
  </div>
  <script>
    var form = document.querySelector('#payment-form');
    var client_token = "<?php echo($gateway->ClientToken()->generate()); ?>";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#dropin-container'
    /*,
    paypal: {
      flow: 'checkout',
      amount: '10.00',
      currency: 'GBP'
    }*/

  }, function (createErr, instance) {
    if (createErr) {
      console.log('Create Error', createErr);
      return;
    }
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      instance.requestPaymentMethod(function (err, payload) {
        if (err) {
          console.log('Request Payment Method Error', err);
          return;
        }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
    });
  });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>