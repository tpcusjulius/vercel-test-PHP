<?php

	$request_body = file_get_contents('php://input');
	//$request_body = file_get_contents('logs-order/2023-02-58.15:02:58.2132');

	//print_r($request_body);

	$data = json_decode($request_body);

	$code_zip = $data->rate->destination->postal_code;

	//exit();

	file_put_contents("logs-order/".date("Y-m-s.H:m:s").".".rand(1000,9999), $request_body);

	$reg_min_date = date('Y-m-d H:i:s O', strtotime('+3 days'));
	$reg_max_date = date('Y-m-d H:i:s O', strtotime('+7 days'));
	
	if($code_zip=="47906"){
		$output = array('rates' => array(
				array(
					'service_name' => 'Endertech Overnight1',
					'service_code' => 'ETO1',
					'total_price' => 1500,
					'currency' => 'USD',
					'min_delivery_date' => $reg_min_date,
					'max_delivery_date' => $reg_max_date
					)
				)
			);
	} else {
		$output = array('rates' => array(
				array(
					'service_name' => 'Endertech Overnight2',
					'service_code' => 'ETO2',
					'total_price' => 2500,
					'currency' => 'USD',
					'min_delivery_date' => $reg_min_date,
					'max_delivery_date' => $reg_max_date
					)
				)
			);
	}
	

	// encode into a json response
	$json_output = json_encode($output);

	// log it so we can debug the response
	file_put_contents("logs-order/".date("Y-m-s.H:m:s").".".rand(1000,9999).'-output', $json_output);

	// send it back to shopify
	print $json_output;
?>
