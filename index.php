<?php

// https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html

// display the search form
require __DIR__ . '/form.html.php'; if (!isset($_GET['q'])) exit();

// define AWS_ACCESS_KEY_ID, AWS_SECRET_KEY, AWS_ASSOCIATE_TAG
require __DIR__ . '/config.php';

$method = 'ItemSearch';
$client = prepareClient($method);

$params = array(
	'AWSAccessKeyId' => AWS_ACCESS_KEY_ID, 
	'AssociateTag' => AWS_ASSOCIATE_TAG, 
	'Request' => array(
		'SearchIndex' => 'Music',
		'Keywords' => $_GET['q'],
		'ResponseGroup' => 'Small,Tracks,Images',
	)
);

$response = $client->$method($params);

require __DIR__ . '/items.html.php';

// https://github.com/Exeu/Amazon-ECS-PHP-Library/blob/master/lib/AmazonECS.class.php
function prepareClient($method) {
	$client = new SOAPClient('http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl');

	date_default_timezone_set('Etc/UTC');
	$timestamp = date('c');

	$signature = base64_encode(hash_hmac('sha256', $method . $timestamp, AWS_SECRET_KEY, true));

	$headers = array(
	  new SoapHeader('http://security.amazonaws.com/doc/2007-01-01/', 'AWSAccessKeyId', AWS_ACCESS_KEY_ID),
	  new SoapHeader('http://security.amazonaws.com/doc/2007-01-01/', 'Timestamp', $timestamp),
	  new SoapHeader('http://security.amazonaws.com/doc/2007-01-01/', 'Signature', $signature)
	);

	$client->__setSoapHeaders($headers);
	return $client;
}

function h($text) {
	print htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}