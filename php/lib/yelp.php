<?php
require_once ('OAth.php');

class yelpSearch {

	function signUrl($unsigned_url) {
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
		
		return $signed_url;
	}
	
	function search_yelp ($term, $type) {
		$location = 'Financial%20District';
		$limit = '10';
		$unsigned_url = "http://api.yelp.com/v2/search?term=$term&location=$location&limit=$limit";

		$signed_url = $this->signUrl($unsigned_url);
		
		// Send Yelp API Call
		$ch = curl_init($signed_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch); // Yelp response
		curl_close($ch);
		
		if ($type == "array") {
			$response = json_decode($data);
			return $response;
		}
		
		if ($type = "json") {
			return $data;
		}
		
		// Handle Yelp response data
		
		// Print it for debugging
		// print_r($response);
	}
}

?>