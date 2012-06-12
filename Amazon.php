<?php

// https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html

class Amazon {
	function search($keywords, $searchIndex, $responseGroup = 'Small') {
		$request = array(
			'Keywords' => $keywords,
			'SearchIndex' => $searchIndex,
			'ResponseGroup' => $responseGroup,
		);

		return $this->call('ItemSearch', $request);
	}

	function call($method, $request) {
		$client = $this->prepareClient($method);

		$params = array(
			'AWSAccessKeyId' => AWS_ACCESS_KEY_ID,
			'AssociateTag' => AWS_ASSOCIATE_TAG,
			'Request' => $request,
		);

		return $client->$method($params);
	}

	// https://github.com/Exeu/Amazon-ECS-PHP-Library/blob/master/lib/AmazonECS.class.php
	function prepareClient($method) {
		$client = new SOAPClient('http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl');

		date_default_timezone_set('Etc/UTC');
		$timestamp = date('c');

		$signature = base64_encode(hash_hmac('sha256', $method . $timestamp, AWS_SECRET_KEY, true));

		$namespace = 'http://security.amazonaws.com/doc/2007-01-01/';

		$headers = array(
		  new SoapHeader($namespace, 'AWSAccessKeyId', AWS_ACCESS_KEY_ID),
		  new SoapHeader($namespace, 'Timestamp', $timestamp),
		  new SoapHeader($namespace, 'Signature', $signature)
		);

		$client->__setSoapHeaders($headers);
		return $client;
	}
}
