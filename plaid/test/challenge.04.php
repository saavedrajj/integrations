<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="https://dashboard.plaid.com/favicon.ico" type="image/x-icon"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Juan Saavedra">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Plaid Take Home Test answers</title>
</head>
<body>
	<div class="container">
		<h1>Plaid Take Home Test answers</h1>
		<h2>Challenge 4</h2>
		<p>Write a script that uses Plaid’s <var>/institution/get</var> endpoint to output the total number of institutions that:</p>
		<ul>
			<li>support Plaid's identity product: <span id="total_identity"></span></li>
			<li>has the word "first" in the name: <span id="total_name"></span></li>
		</ul>
		<?php
		/* Credentials */
		$client_id = "5cd9c98f5470830011c6a5e1";
		$secret = "db72240dbcad0f121c96ead140cbc8";

		/* Get total  total number of institutions that support Plaid's identity product */
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://sandbox.plaid.com/institutions/get",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{
				\"client_id\": \"$client_id\",
				\"secret\": \"$secret\",
				\"count\": 500,
				\"offset\": 0,
				\"options\": {\"products\":[\"identity\"]}
			}",			
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$json = json_decode($response, true);
			$total_identity = $json["total"];  
		}
		//=====> $total_identity

		/* Get total number of offset iterations */
		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
			CURLOPT_URL => "https://sandbox.plaid.com/institutions/get",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{
				\"client_id\": \"$client_id\",
				\"secret\": \"$secret\",
				\"count\": 500,
				\"offset\": 0
			}",			
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json"
			),
		));
		$response2 = curl_exec($curl2);
		$err2 = curl_error($curl2);
		curl_close($curl2);
		if ($err2) {
			echo "cURL Error #:" . $err2;
		} else {
			$json2 = json_decode($response2, true);
			$total_names = $json2["total"];  
			$offsetIterations = $total_names / 500;
			/* Calculate number of offset iterations */
			if(is_int($offsetIterations)){} else { $offsetIterations = intval($offsetIterations) + 1; }
		}

		/* Get total total number of institutions that have the word "first" in the name */
		$currentOffset = 0;
		$totalName = 0;
		for($i = 0; $i <= $offsetIterations - 1; $i++) { 
			/* API /institutions/get call */
			$curl3 = curl_init();
			curl_setopt_array($curl3, array(
				CURLOPT_URL => "https://sandbox.plaid.com/institutions/get",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "{
					\"client_id\": \"$client_id\",
					\"secret\": \"$secret\",
					\"count\": 500,
					\"offset\": ". $currentOffset . "
				}",			
				CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json"
				),
			));
			$response3 = curl_exec($curl3);
			$err3 = curl_error($curl3);
			curl_close($curl3);
			if ($err3) {
				echo "cURL Error #:" . $err3;
			} else {
				$json3 = json_decode($response3, true);			
				$counter = count($json3["institutions"]);
				for($j = 0; $j <= $counter - 1; $j++) { 
					$bank_name = $json3["institutions"][$j]["name"];  
					if (strpos($bank_name, "first") !== false) {
						$nameCounter = $totalName + 1;					
						echo $nameCounter . " - " . $bank_name . "<br/>";
						$totalName++;
					}
				}
				$counter3 = 0;
			}
			$currentOffset+=500;
		}
		?>
		<script>
			total_identity.innerHTML += "<code><?php echo $total_identity; ?></code>";
			total_name.innerHTML += "<code><?php echo $totalName; ?></code>";
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</div>
</body>
</html>