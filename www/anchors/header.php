<!doctype HTML>
<html>

<head>
	<meta content="X-UA-Compatible" http-equiv="chrome=1;ie=edge" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Alexis Sarra">
	<meta name="description" content="DAMN PANEL">
	<!--
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
-->
	<title>DAMN PANEL</title>



	<?php if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "index") : ?>
		<link rel="stylesheet" type="text/css" href="style/indexx.css" />
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "ConfigureNewAccess") : ?>
		<link rel="stylesheet" type="text/css" href="style/configure-new-access.css" />
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "EndProcessusPage") : ?>
		<link rel="stylesheet" type="text/css" href="style/processus-end-page.css" />
	<?php endif; ?>
</head>

<body>