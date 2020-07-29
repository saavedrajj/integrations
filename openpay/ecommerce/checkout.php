<?php require_once("../../includes/openpay.credentials.php"); ?>
<?php 
$json_request = $_POST['json_request'];

echo "JSON ". $json_request;


$script_path = $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Openpay</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <div class="container">
    <p class="text-center">Redirection to Openpay hosted page</p>
    <div class="d-flex justify-content-center">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <?php 
    //require_once("../../includes/openpay.credentials.php");


    //echo $json_request;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.training.myopenpay.co.uk/v1/merchant/orders/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURL_SETOPT($curl, CURLOPT_USERPWD, $username . ":" . $password),
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      /*CURLOPT_POSTFIELDS => $myJson,*/
     
      CURLOPT_POSTFIELDS =>"{\n\t\"customerJourney\": {\n\t\t\"origin\": \"Online\",\n\t\t\"online\": {\n\t\t\t\"callbackUrl\": \"https://www.openpay.co.uk/callback\",\n\t\t\t\"cancelUrl\": \"https://www.openpay.co.uk/cancel\",\n\t\t\t\"failUrl\": \"https://www.openpay.co.uk/fail\",\n\t\t\t\"planCreationType\": \"Pending\",\n\t\t\t\"chargeBackCount\": -1,\n\t\t\t\"customerQuality\": -1,\n\t\t\t\"customerDetails\": {\n\t\t\t\t\n\t\t\t\t\"firstName\": \"John\", \n\t\t\t\t\"otherNames\": \"\",\n\t\t\t\t\"familyName\": \"Doe\",\n\t\t\t\t\"email\": \"openpaybuyer@gmail.com\",\n\t\t\t\t\"dateOfBirth\": \"01 Jan 1980\",\n\t\t\t\t\"gender\": \"M\",\n\t\t\t\t\"phoneNumber\": \"7654654563\",\n\t\t\t\t\n\t\t\t\t\"residentialAddress\": {\n\t\t\t\t\t\"line1\": \"123 Regent Street\",\n\t\t\t\t\t\"line2\": \"\",\n\t\t\t\t\t\"suburb\": \"London\",\n\t\t\t\t\t\"state\": \"Greater London\",\n\t\t\t\t\t\"postCode\": \"W1B 5SA\"\n\t\t\t\t},\n\t\t\t\t\n\t\t\t\t\"deliveryAddress\": {\n\t\t\t\t\t\"line1\": \"2 Eastbourne Terrace\",\n\t\t\t\t\t\"line2\": \"\",\n\t\t\t\t\t\"suburb\": \"London\",\n\t\t\t\t\t\"state\": \"Greater London\",\n\t\t\t\t\t\"postCode\": \"W1D 4EG\"\n\t\t\t\t}\n\t\t\t},\n\t\t\t\"deliveryDate\": \"10 May 2020\"\n\t\t}\n\t},\n\t\"goodsDescription\": \"Goods description\",\n\t\"purchasePrice\": 5000,\n\t\"retailerOrderNo\": \"00000001\",\n\t\"cart\": [\n\t\t{\n\t\t\t\"itemName\": \"Item name\",\n\t\t\t\"itemGroup\": \"Item group\",\n\t\t\t\"itemCode\": \"12345678\",\n\t\t\t\"itemGroupCode\": \"1234567890123\",\n\t\t\t\"itemRetailUnitPrice\": 5000,\n\t\t\t\"itemQty\": \"1\",\n\t\t\t\"itemRetailCharge\": 0\n\t\t}\n\t]\n}",
     
      //CURLOPT_HTTPHEADER => array(
      //  "Content-Type: application/json"
      //),

      CURLOPT_HTTPHEADER => array(
     "Content-Type: application/json"

      ),



    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($response);
    $orderId = $json->orderId;
    $formPostUrl = $json->nextAction->formPost->formPostUrl;
    $TransactionToken = $json->nextAction->formPost->formFields[3]->fieldValue;
    $handover_url = $formPostUrl . "?TransactionToken=" .$TransactionToken;
    ?>
  </div>
  <script>
    setTimeout(function () {
      window.location.href="<?php echo $handover_url?>";
    },4000); 
  </script> 
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>



