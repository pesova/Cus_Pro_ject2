<?php
	$id = $_GET['id'];
	$msg = $_GET['message'];
	$id1 = $_GET['status'];

	if($id1 == "open"){
		
	  $data = array("message" => "$msg","status" => "close");
		$url = 'https://dev.customerpay.me/complaint/update/'.$id;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

		curl_exec($ch);
	}
	else{
		$data = array("message" => "$msg","status" => "open");
		$url = 'https://dev.customerpay.me/complaint/update/'.$id;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

		curl_exec($ch);
	}
?>