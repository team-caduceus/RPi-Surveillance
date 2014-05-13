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
  

	<header>
		<div class="container clearfix">
			<h1 id="logo">
				TEAM CADUCEUS <span class="se">- RPI Surveillance</span>
			</h1>
			<nav>
				<a href="index.php">Home</a>
				<a href="#"><strike>About</strike></a>
				<a href="#"><strike>Tutorial</strike></a>
				<a href="files.php">Files</a>
			</nav>
		</div>
	</header><!-- /header -->