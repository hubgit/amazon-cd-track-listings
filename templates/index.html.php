<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CD Track Listings</title>
	<link rel="stylesheet" href="layout.css">
</head>

<body>
	<form>
		<input type="text" name="q" value="<? h($_GET['q']); ?>">
		<input type="submit" value="Search">
	</form>

<? if (isset($response)): ?>
<? if ($response->Items->Item): ?>
	<? require __DIR__ . '/items.html.php'; ?>
<? else: ?>
	<div class="error">No items found</div>
<? endif; ?>
<? endif; ?>


<pre><code><? //print_r($response); ?></code></pre>

</body>
</html>