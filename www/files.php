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
				<a href="index.html">Home</a>
				<a href="about.html">About</a>
				<a href="tutorial.html">Tutorial</a>
				<a href="files.php">Files</a>
			</nav>
		</div>
	</header><!-- /header -->

  <div id="wrap">
  <article>
  <section>
    <?php
      if(isset($_GET["delete"])) {
        unlink("media/" . $_GET["delete"]);
      }
      if(isset($_GET["delete_all"])) {
        $files = scandir("media");
        foreach($files as $file) unlink("media/$file");
      }
      else if(isset($_GET["file"])) {
        echo "<h2>Files</h2>";
        if(substr($_GET["file"], -3) == "jpg") echo "<img src='media/" . $_GET["file"] . "' width='640'>";
        else echo "<video width='780' controls><source src='media/" . $_GET["file"] . "' type='video/mp4'>Your browser does not support the video tag.</video>";
        echo "<p><input type='button' value='Download' onclick='window.open(\"download.php?file=" . $_GET["file"] . "\", \"_blank\");'> ";
        echo "<input type='button' value='Delete' onclick='window.location=\"files.php?delete=" . $_GET["file"] . "\";'></p>";
      }
    ?>
	<div id="heading">
    <h2>Files</h2>
	</div>
    <?php
      $files = scandir("media");
      if(count($files) == 2) echo "<p>No videos/images saved</p>";
      else {
        foreach($files as $file) {
          if(($file != '.') && ($file != '..')) {
            $fsz = round ((filesize("media/" . $file)) / (780 * 780));
            echo "<p><a href='files.php?file=$file'>$file</a> ($fsz MB)</p>";
          }
        }
        echo "<p><input type='button' value='Delete all' onclick='if(confirm(\"Delete all?\")) {window.location=\"files.php?delete_all\";}'></p>";
      }
    ?>
	</section>
  </article>
  </div>
 
</div>
</body>
</html>