<?php
	$id = $_GET['id'];
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dev.customerpay.me/complaint/delete/".$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "DELETE",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: ce69cb6a-5354-0d70-0f31-a8b165de22da"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
?>