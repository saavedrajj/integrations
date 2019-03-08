<?php require_once("../../includes/braintree-credentials.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Braintree - Hosted Fields</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
  <script src="https://js.braintreegateway.com/web/dropin/1.16.0/js/dropin.min.js"></script>
  <style>
  .separator { height:15px; }
  .errorMessage {color:red;}
</style>
</head>
<body>
  <?php include "../../includes/navbar.php"; ?>
  <div class="container">
    <h1>Braintree</h1>
    <h2>Hosted Fields</h2>
    <form action="checkout.php" id="my-sample-form" method="post">
      <div class="form-group">
        <label for="amount">Amount</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">£</span>
          </div>
          <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" aria-label="0.00" aria-describedby="basic-addon1">
        </div>
      </div>
      <label for="card-number">Cardholder name</label>
      <input type="text" class="form-control" id="cardholder-name" name="cardholder-name" value="John Doe">
      <label for="card-number">Card Number</label>
      <div id="card-number" class="form-control" size="16"></div>
      <label for="cvv">CVV</label>
      <div id="cvv" class="form-control" size="4"></div>
      <label for="expiration-date">Expiration Date</label>
      <div id="expiration-date" class="form-control"></div>
      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <div class="separator"></div>
      <div id="errorMessage" class="errorMessage"></div>    
      <input class="btn btn-secondary btn-lg btn-block" type="submit" value="Submit payment" disabled />
    </form>
  </div>
  <script src="https://js.braintreegateway.com/web/3.42.0/js/client.min.js"></script>
  <script src="https://js.braintreegateway.com/web/3.42.0/js/hosted-fields.min.js"></script>
  <script>
    var form = document.querySelector('#my-sample-form');
    var submit = document.querySelector('input[type="submit"]');
    var client_token = "<?php echo($gateway->ClientToken()->generate()); ?>";
    braintree.client.create({
      authorization: client_token
    }, function (clientErr, clientInstance) {
      if (clientErr) {
        console.error(clientErr);
        return;
      }
      braintree.hostedFields.create({
        client: clientInstance,
        styles: {
          'input': {
            'font-size': '14px'
          },
          'input.invalid': {
            'color': 'red'
          },
          'input.valid': {
            'color': 'green'
          }
        },
        fields: {
          number: {
            selector: '#card-number',
            placeholder: '4111 1111 1111 1111',
          },      
          cvv: {
            selector: '#cvv',
            placeholder: '123'
          },
          expirationDate: {
            selector: '#expiration-date',
            placeholder: '10/2019'
          }
        }
      }, function (hostedFieldsErr, hostedFieldsInstance) {
        if (hostedFieldsErr) {
          console.error(hostedFieldsErr);
            //document.querySelector('#errorMessage').value = hostedFieldsErr;
            return;
          }
          submit.removeAttribute('disabled');
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
              if (tokenizeErr) {
                //console.error(tokenizeErr);    
                var errorMessage;
                switch (tokenizeErr.code) {
                  case 'HOSTED_FIELDS_FIELDS_EMPTY':
                  errorMessage = "All fields are empty! Please fill out the form.";
                  break;
                  case 'HOSTED_FIELDS_FIELDS_INVALID':
                  errorMessage = "Some fields are invalid: " + tokenizeErr.details.invalidFieldKeys + ".";
                  break;
                  case 'HOSTED_FIELDS_FAILED_TOKENIZATION':
                  errorMessage = "Tokenization failed server side. Is the card valid?";
                  break;
                  case 'HOSTED_FIELDS_TOKENIZATION_FAIL_ON_DUPLICATE':
                  errorMessage = "This payment method already exists in your vault.";
                  break;
                  case 'HOSTED_FIELDS_TOKENIZATION_CVV_VERIFICATION_FAILED':
                  errorMessage = "CVV did not pass verification.";       
                  break;
                  case 'HOSTED_FIELDS_TOKENIZATION_NETWORK_ERROR':
                  errorMessage = "Network error occurred when tokenizing.";          
                  break;
                  errorMessage = "Something bad happened! " + tokenizeErr;            
                }
                document.querySelector('#errorMessage').innerHTML = "<div class='alert alert-danger' role='alert'>" + errorMessage + "</div>";
                return;
              }
              document.querySelector('#errorMessage').innerHTML = "";
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          }, false);
        });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>