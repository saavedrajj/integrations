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
	<?php include "../../includes/navbar.php"; ?>
	<div class="container">
		<h1>Stripe</h1>
		<h2>Checkout</h2>
		<form action="<?php echo $baseUrl;?>stripe/checkout/charge.php" method="POST">
			<div class="form-group">
				<label for="amount">Amount</label>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">£</span>
					</div>
					<input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" aria-label="0.00" aria-describedby="basic-addon1">
				</div>
			</div>

		<script>
			document.querySelector('#amount').value = amount;
		</script>
			<script
			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			data-key="pk_test_AQ4KlxMSdDcegkIlXHVMKtap"
			data-name="Juan Saavedra"
			data-description="Example charge"
			data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
			data-locale="auto"
			data-currency="gbp">
		</script>
	</form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
</body>
</html>