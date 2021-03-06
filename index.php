<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" href="../favicon.ico" type="image/x-icon"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Integrations</title>
</head>
<body>
	<?php include "includes/navbar.php"; ?>
	<div class="container">
		<h1>Home</h1>
		<h2>PayPal</h2>
		<ul>
			<li><a href="<?php echo $baseUrl;?>paypal/client/" target="_self">Client Integration</a></li>
			<!--
			<li><a href="<?php echo $baseUrl;?>paypal/server/" target="_self">Server Integration</a></li>	
			-->
		</ul>
		<h2>Braintree</h2>
		<ul>
			<li><a href="<?php echo $baseUrl;?>braintree/drop-in/" target="_self">Drop-in UI</a></li>
			<li><a href="<?php echo $baseUrl;?>braintree/hosted-fields/" target="_self">Hosted fields</a></li>			
		</ul>
		<h2>Stripe</h2>
		<ul>
			<li><a href="<?php echo $baseUrl;?>stripe/checkout/" target="_self">Checkout</a></li>		
		</ul>		

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
	</html>