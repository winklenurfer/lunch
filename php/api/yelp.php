<?php

// Enter the path that the oauth library is in relation to the php file
require_once ('../lib/OAth.php');

if (isset($_GET["term"])) {
	$term = $_GET["term"];
} else {
	echo "Error: Please enter a valid search term.";
	exit();
}

if (isset($_GET["location"])) {
	$location = $_GET["location"];
} else {
	$location = 'Financial%20District';
}

// For example, request business with id 'the-waterboy-sacramento'
// $unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento";

// For examaple, search for 'tacos' in 'sf'
$unsigned_url = "http://api.yelp.com/v2/search?term=$term&location=$location";


// Set your keys here
$consumer_key = "z35EISg1oDSFBo0uO_bl0Q";
$consumer_secret = "siE72wafwWpPnhSlhCo-6OC7Qt0";
$token = "uEpoeQ_KMzFJwCfCypqeVpN2Wnpz9YCU";
$token_secret = "NrfoiLkd2Tazh-vnyH-wAyXTt0w";

// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);

// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);

// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);

// Get the signed URL
$signed_url = $oauthrequest->to_url();

// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

// Handle Yelp response data
$response = json_decode($data);
echo $data;
// Print it for debugging
// print_r($response);

?>