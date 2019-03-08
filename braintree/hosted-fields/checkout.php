<?php require_once("../../includes/braintree-credentials.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];
$cardholderName = $_POST["cardholder-name"];

$result = $gateway->transaction()->sale([
	'amount' => $amount,
	'paymentMethodNonce' => $nonce,
	'customer' => [
		'firstName' => 'John',
		'lastName' => 'Doe',
		'company' => 'Acme Ltd',
		'phone' => '012345678',
		'fax' => '087654321',
		'website' => 'http://www.johndoe.com',
		'email' => 'john@doe.com'
	],
	'creditCard' => [
		'cardholderName' => $cardholderName
	],
	'options' => [
		'submitForSettlement' => true
	]
]);

if ($result->success || !is_null($result->transaction)) {
	$transaction = $result->transaction;
	header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
} else {
	$errorString = "";

	foreach($result->errors->deepAll() as $error) {
		$errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	}

	$_SESSION["errors"] = $errorString;
	header("Location: " . $baseUrl . "index.php");
}
?>