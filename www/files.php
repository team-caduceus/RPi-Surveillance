<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
	<?php
	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
	?>
	<?php 
	}else{
	 header("location:index.php");
	}
	?>

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

<?php include 'footer.php'; ?>