<?php
require("../../vendor/autoload.php");

$stripe = [
  "secret_key"      => "sk_test_8t7348xCXkjKnIoFKQijS7G0",
  "publishable_key" => "pk_test_AQ4KlxMSdDcegkIlXHVMKtap",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);