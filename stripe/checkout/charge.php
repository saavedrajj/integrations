<?php
require_once("../../includes/stripe-credentials.php");

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
$amountStripe = $_POST['amount'];


$amount = str_replace(array('.', ','), '' ,$_POST['amount']);


  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'gbp',
  ]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stripe - Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<body>
  <?php include "../../includes/navbar.php"; ?>
  <div class="container">
    <h1>Stripe</h1>
    <h2>Checkout</h2>

      <h3>Succesful payment!</h1>
      <p>Your test transaction has been successfully processed. See the Stripe API response and try again.</p>

    <a class="btn btn-secondary btn-lg btn-block" href="index.php" role="button">Test another transaction</a> 
<?php
 
  //echo '<h2>token: ' . $token . '</h2>';
  //echo "charge id: ". $charge->id;

$retrieveCharge = \Stripe\Charge::retrieve($charge->id);
//$retrieveCharge = \Stripe\Charge::retrieve('ch_1ECZYpLuBoxtgzcKXvayTa5y');

//$retrieveCustomer = \Stripe\Customer::retrieve($customer->id);
//echo $retrieveCharge;
//echo "<hr>";
//echo $retrieveCustomer;
?>
<h3>API Response</h3>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col" colspan=2>Charge</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">id</th>
            <td><?php echo($retrieveCharge->id)?></td>
          </tr>
          <tr>
            <th scope="row">amount</th>
            <td><?php echo($amountStripe)?></td>
          </tr> 
          <tr>
            <th scope="row">currency</th>
            <td><?php echo($retrieveCharge->currency)?></td>
          </tr>
          <tr>
            <th scope="row">balance_transaction</th>
            <td><?php echo($retrieveCharge->balance_transaction)?></td>
          </tr>               
          <tr>
            <th scope="row">customer</th>
            <td><?php echo($retrieveCharge->customer)?></td>
          </tr> 
           <tr>
            <th scope="row">receipt_email</th>
            <td><?php echo($retrieveCharge->receipt_email)?></td>
          </tr>                                                    
        </tbody>
      </table>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
</body>
</html>