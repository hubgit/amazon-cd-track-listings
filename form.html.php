<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CD Track Listings</title>
	<link rel="stylesheet" href="layout.css">
	<link rel="stylesheet" href="items.css">
</head>

<body>
	<form>
		<input type="text" name="q" value="<? h($_GET['q']); ?>">
		<input type="submit" value="Search">
	</form>