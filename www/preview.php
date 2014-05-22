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
 
  <body>

  	<header>
		<div class="container clearfix">
			<h1 id="logo">
				RPI Surveillance
			</h1>
			<nav>
				<a href="index.html">Stream</a>
				<a href="preview.php">Files</a>
			</nav>
		</div>
	</header>
 
	<div id="wrap">
	<article>


	<?php
      if(isset($_GET["delete"])) {
        unlink("media/" . $_GET["delete"]);
      }
      if(isset($_GET["delete_all"])) {
        $files = scandir("media");
        foreach($files as $file) unlink("media/$file");
      }
      else if(isset($_GET["file"])) {
        echo "<div class='heading'><h2>Preview</h2></div>";
        if(substr($_GET["file"], -3) == "jpg") echo "<img src='media/" . $_GET["file"] . "' width='640'>";
        else echo "<video width='732' controls><source src='media/" . $_GET["file"] . "' type='video/mp4'>Your browser does not support the video tag.</video>";
        echo "<p><input type='button' value='Download' onclick='window.open(\"download.php?file=" . $_GET["file"] . "\", \"_blank\");'> ";
        echo "<input type='button' value='Delete' onclick='window.location=\"preview.php?delete=" . $_GET["file"] . "\";'></p>";
      }
    ?>
    <div class="heading">
	<h2>Files</h2>
	</div>
    <?php
      $files = scandir("media");
      if(count($files) == 2) echo "<p>No videos/images saved</p>";
      else {
        foreach($files as $file) {
          if(($file != '.') && ($file != '..')) {
            $fsz = round ((filesize("media/" . $file)) / (1024 * 1024));
            echo "<p><a href='preview.php?file=$file'>$file</a> ($fsz MB)</p>";
          }
        }
        echo "<p><input type='button' value='Delete all' onclick='if(confirm(\"Delete all?\")) {window.location=\"preview.php?delete_all\";}'></p>";
      }
    ?>
	
	</article>
	</div>
  </body>
</html>
