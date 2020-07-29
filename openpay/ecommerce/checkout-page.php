<?php require_once("../../includes/openpay.credentials.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Openpay</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php include "../../includes/navbar.php"; ?>
  <?php
$json_request = file_get_contents('plan.json');
echo $json_request;



?>

  <div class="container">
  	<h1>Openpay</h1>
  	<h2>Ecommerce Integration</h2>
    <h3>Checkout page</h3>
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
  </ol>
</nav>
    <div class="container">
  <div class="row">
    <div class="col-md">

      <?php
      //$my_array = json_decode($response);
//$my_array->places->place[0]->woe_name;
    ?>
      <p>First name</p>
      <p>Last name</p>
    </div>

    <div class="col-md">
      <p>Your order</p>
    </div>
  </div>
</div>



    <form method="post" id="payment-form" action="checkout.php">
    <input type="hidden" name="json_request">
      <button  id="submit-button" class="btn btn-secondary btn-lg btn-block">Submit Plan</button>



    </form>

<?php
//https://www.codexworld.com/post-receive-json-data-using-php-curl/
?>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>