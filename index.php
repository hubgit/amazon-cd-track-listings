<?php

// https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html

// display the search form
require __DIR__ . '/form.html.php'; if (!isset($_GET['q'])) exit();

// define AWSACCESSKEYID, AWSSECRETKEY, AWSASSOCIATETAG
require __DIR__ . '/config.php';

$method = 'ItemSearch';
$client = prepareClient($method);

$params = array(
	'AWSAccessKeyId' => AWSACCESSKEYID, 
	'AssociateTag' => AWSASSOCIATETAG, 
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

	$headers = array(
	  new SoapHeader(
	    'http://security.amazonaws.com/doc/2007-01-01/',
	    'AWSAccessKeyId',
	    AWSACCESSKEYID
	  ),
	  new SoapHeader(
	    'http://security.amazonaws.com/doc/2007-01-01/',
	    'Timestamp',
	    $timestamp
	  ),
	  new SoapHeader(
	    'http://security.amazonaws.com/doc/2007-01-01/',
	    'Signature',
	    base64_encode(hash_hmac('sha256', $method . $timestamp, AWSSECRETKEY, true))
	  )
	);

	$client->__setSoapHeaders($headers);
	return $client;
}

function h($text) {
	print htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}