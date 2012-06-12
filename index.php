<?

if (isset($_GET['q']) && $_GET['q']) {
	require __DIR__ . '/config.php'; // define AWS_ACCESS_KEY_ID, AWS_SECRET_KEY, AWS_ASSOCIATE_TAG
	require __DIR__ . '/Amazon.php';

	$api = new AmazonECS;
	$response = $api->search($_GET['q'], 'Music', 'Small,Tracks,Images');
}

require __DIR__ . '/templates/index.html.php';

// escape output for HTML
function h($text) {
	print htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}