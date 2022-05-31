<!DOCTYPE HTML>
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
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "NewPassword") : ?>
		<link rel="stylesheet" type="text/css" href="style/new-password.css" />
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashboard") : ?>
		<link rel="stylesheet" type="text/css" href="style/dashboard-main.css" />
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashboardProducts") : ?>
		<link rel="stylesheet" type="text/css" href="style/dashboard-products.css" />
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashboardAnalytics") : ?>
		<link rel="stylesheet" type="text/css" href="style/dashboard-analytics.css" />
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.esm.js" integrity="sha512-YM18yiANXJFpbiOZjLzUrK/lNfTiBcwtTLeAntG4B8dJY+NdUDjxfPNGPEMuOdXlT7U/uT+zbIvbQYAEFog+MA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.esm.min.js" integrity="sha512-yPOQ2pPoQ9JtP0/jDKpXiKyWNCJWT5OI+6r1EqZmTg+afKQOBpy08VYboeq+Tt9kl9/FOCueEhH6cmHN3nAdJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.js" integrity="sha512-5m2r+g00HDHnhXQDbRLAfZBwPpPCaK+wPLV6lm8VQ+09ilGdHfXV7IVyKPkLOTfi4vTTUVJnz7ELs7cA87/GMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/helpers.esm.js" integrity="sha512-dSutS1n8KEMUnQMa9YGa6CxAmoUfaZdxL2+s2xBgEq7WHaWdtjna/rzGsjqkT27GxKBDLT0Fr3C/TzzHvBRaAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/helpers.esm.min.js" integrity="sha512-vxCPccgWacJoW2HlxhlKKtczdzvcg0r1UuB9LfNGt6vsDbgLfSFxKlolUS2mqKNXrOK5b93S45309T+V5BhueA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
		<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
		<script src="js/utils.js"></script>
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashboardData") : ?>
		<link rel="stylesheet" type="text/css" href="style/dashboard-data.css" />
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<?php elseif (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashbordSettings") : ?>
		<link rel="stylesheet" type="text/css" href="style/dashboard-settings.css" />
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<?php endif; ?>
</head>

<body>