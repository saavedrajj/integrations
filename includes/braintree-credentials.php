<?php
require("../../vendor/autoload.php");
$gateway = new Braintree_Gateway([
  'environment' => 'sandbox',
  'merchantId' => 'bbq62j65z2r92hgj',
  'publicKey' => 'rd72tbf2qq2vqgt5',
  'privateKey' => '92566680d9150f5fd30331c60dc72198'
]);