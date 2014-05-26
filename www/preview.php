<!DOCTYPE html>
  <html>
  <head>
  <title>RPi Surveillance</title>
  		<link rel="stylesheet" href="caduceus.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  
  <script src="script.js"></script>
  </head>
  <body onload="setTimeout('init();', 100);">

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
        echo "<h2>Preview</h2>";
        if(substr($_GET["file"], -3) == "jpg") echo "<img src='media/" . $_GET["file"] . "' width='780'>";
        else echo "<video width='780' controls><source src='media/" . $_GET["file"] . "' type='video/mp4'>Your browser does not support the video tag.</video>";
        echo "<p><input type='button' value='Download' onclick='window.open(\"download.php?file=" . $_GET["file"] . "\", \"_blank\");'> ";
        echo "<input type='button' value='Delete' onclick='window.location=\"preview.php?delete=" . $_GET["file"] . "\";'></p>";
        echo "</article><article>";
	  }
    ?>
    <h2>Files</h2>
    <?php
      $files = scandir("media");
      if(count($files) == 2) echo "<p>No videos/images saved</p>";
      else {
        foreach($files as $file) {
          if(($file != '.') && ($file != '..')) {
            $fsz = round ((filesize("media/" . $file)) / (1024 * 1024));
            echo "<div class='file'><a href='preview.php?file=$file'>$file</a> <span style='float: right;'>($fsz MB)</span></div>";
          }
        }
        echo "<p><input type='button' value='Delete all' onclick='if(confirm(\"Delete all?\")) {window.location=\"preview.php?delete_all\";}'></p>";
      }
    ?>
	 </article>
	 </div>
	  
  </body>
</html>
