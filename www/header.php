<?php
error_reporting(0);
include("config.php");
?>
	<html>
	<head>
		<title>RPi Cam Control</title>
		<link rel="stylesheet" href="caduceus.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="script.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="classie.js"></script>
	
	<script>
		function init() {
			window.addEventListener('scroll', function(e){
				var distanceY = window.pageYOffset || document.documentElement.scrollTop,
					shrinkOn = 25,
					header = document.querySelector("header");
				if (distanceY > shrinkOn) {
					classie.add(header,"smaller");
				} else {
					if (classie.has(header,"smaller")) {
						classie.remove(header,"smaller");
					}
				}
			});
		}
		window.onload = init();
	</script>
	
	</head>
	<body onload="setTimeout('init();', 100);">