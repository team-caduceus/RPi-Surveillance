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
      <div><img id="mjpeg_dest"></div>
      <input id="video_button" type="button" class="button1" >
      <input id="image_button" type="button" class="button1" >
      <input id="timelapse_button" type="button" class="button1" >
      <input id="md_button" type="button" class="button1" >
      <input id="halt_button" type="button" class="button1" >
	</article>  
	
	<article>	
	<div id="heading">
	  <h2>Settings</h2>
	</div>
	
	<table border="0" width="780">
        
		<tr>
          <td>Timelapse-Interval (0.1...3200):</td>
          <td><input type="text" size=4 id="tl_interval" value="3"> s</td>
        </tr>
        
		<tr>
          <td>Sharpness (-100...100), <span class="default">default 0</span>:</td>
          <td><input type="text" size=4 id="sharpness"><input type="button" class="button2"  value="OK" onclick="send_cmd('sh ' + document.getElementById('sharpness').value)"></td>
        </tr>
        
		<tr>
          <td>Contrast (-100...100), <span class="default">default 0</span>:</td>
          <td><input type="text" size=4 id="contrast"><input type="button" class="button2"  value="OK" onclick="send_cmd('co ' + document.getElementById('contrast').value)"></td>
        </tr>
        
		<tr>
          <td>Brightness (0...100), <span class="default">default 50</span>:</td>
          <td><input type="text" size=4 id="brightness"><input type="button" class="button2"  value="OK" onclick="send_cmd('br ' + document.getElementById('brightness').value)"></td>
        </tr>
        
		<tr>
          <td>Saturation (-100...100), <span class="default">default 0</span>:</td>
          <td><input type="text" size=4 id="saturation"><input type="button" class="button2"  value="OK" onclick="send_cmd('sa ' + document.getElementById('saturation').value)"></td>
        </tr>
        
		<tr>
          <td>ISO (100...800), <span class="default">default 0</span>:</td>
          <td><input type="text" size=4 id="iso"><input type="button" class="button2"  value="OK" onclick="send_cmd('is ' + document.getElementById('iso').value)"></td>
        </tr>
        
		<tr>
        <td>Metering Mode, <span class="default">default 'average'</span>:</td>
        <td>
            <select onclick="send_cmd('mm ' + this.value)">
              <option value="average">Select option...</option>
              <option value="average">Average</option>
              <option value="spot">Spot</option>
              <option value="backlit">Backlit</option>
              <option value="matrix">Matrix</option>
            </select>
        </td>
        
		</tr>
        <tr>
          <td>Video Stabilisation, <span class="default">default: 'off'</span></td>
          <td><input type="button" class="button2"  value="ON" onclick="send_cmd('vs 1')"><input type="button" class="button2"  value="OFF" onclick="send_cmd('vs 0')"></td>
        </tr>
        
		<tr>
        <td>Exposure Compensation (-10...10), <span class="default">default 0</span>:</td>
        <td><input type="text" size=4 id="comp"><input type="button" class="button2"  value="OK" onclick="send_cmd('ec ' + document.getElementById('comp').value)"></td>
        </tr>
        
		<tr>
        <td>Exposure Mode, <span class="default">default 'auto'</span>:</td>
        <td>
            <select onclick="send_cmd('em ' + this.value)">
              <option value="auto">Select option...</option>
              <option value="off">Off</option>
              <option value="auto">Auto</option>
              <option value="night">Night</option>
              <option value="nightpreview">Nightpreview</option>
              <option value="backlight">Backlight</option>
              <option value="spotlight">Spotlight</option>
              <option value="sports">Sports</option>
              <option value="snow">Snow</option>
              <option value="beach">Beach</option>
              <option value="verylong">Verylong</option>
              <option value="fixedfps">Fixedfps</option>
			</select>
        </td>
        </tr>
        
		<tr>
        <td>White Balance, <span class="default">default 'auto'</span>:</td>
        <td>
            <select onclick="send_cmd('wb ' + this.value)">
              <option value="auto">Select option...</option>
              <option value="off">Off</option>
              <option value="auto">Auto</option>
              <option value="sun">Sun</option>
              <option value="cloudy">Cloudy</option>
              <option value="shade">Shade</option>
              <option value="tungsten">Tungsten</option>
              <option value="fluorescent">Fluorescent</option>
              <option value="incandescent">Incandescent</option>
              <option value="flash">Flash</option>
              <option value="horizon">Horizon</option>
            </select>
        </td>
        </tr>
        
		<tr>
        <td>Image Effect, <span class="default">default 'none'</span>:</td>
        <td>
            <select onclick="send_cmd('ie ' + this.value)">
              <option value="none">Select option...</option>
              <option value="none">None</option>
              <option value="negative">Negative</option>
              <option value="solarise">Solarise</option>
              <option value="sketch">Sketch</option>
              <option value="denoise">Denoise</option>
              <option value="emboss">Emboss</option>
              <option value="oilpaint">Oilpaint</option>
              <option value="hatch">Hatch</option>
              <option value="gpen">Gpen</option>
              <option value="pastel">Pastel</option>
              <option value="watercolour">Watercolour</option>
              <option value="film">Film</option>
              <option value="blur">Blur</option>
              <option value="saturation">Saturation</option>
              <option value="colourswap">Colourswap</option>
              <option value="washedout">Washedout</option>
              <option value="posterise">Posterise</option>
              <option value="colourpoint">Colourpoint</option>
              <option value="colourbalance">Colourbalance</option>
              <option value="cartoon">Cartoon</option>
            </select>
        </td>
        </tr>
        
		<tr>
        <td>Colour Effect, <span class="default">default 'disabled'</span>:</td>
        <td>
            <select id="ce_en">
              <option value="0">Disabled</option>
              <option value="1">Enabled</option>
            </select>
            u:v = <input type="text" size=3 id="ce_u">:<input type="text" size=3 id="ce_v">
            <input type="button" class="button2"  value="OK" onclick="set_ce();">
        </td>
        </tr>
        
		<tr>
        <td>Rotation, <span class="default">default 0</span>:</td>
        <td>
            <select onclick="send_cmd('ro ' + this.value)">
              <option value="0">Select option...</option>
              <option value="0">0</option>
              <option value="90">90</option>
              <option value="180">180</option>
              <option value="270">270</option>
            </select>
        </td>
        </tr>
        
		<tr>
        <td>Flip, <span class="default">default 'none'</span>:</td>
        <td>
            <select onclick="send_cmd('fl ' + this.value)">
              <option value="0">Select option...</option>
              <option value="0">None</option>
              <option value="1">Horizonal</option>
              <option value="2">Vertical</option>
              <option value="3">Both</option>
			</select>
        </td>
        </tr>
        
		<tr>
        <td>Sensor Region, <span class="default">default 0/0/65536/65536</span>:</td>
        <td>
			x<input type="text" size=5 id="roi_x"> y<input type="text" size=5 id="roi_y"> w<input type="text" size=5 id="roi_w"> h<input type="text" size=5 id="roi_h"> <input type="button" class="button2"  value="OK" onclick="set_roi();">
        </td>
        </tr>
        
		<tr>
			<td>Shutter speed (0...330000), <span class="default">default 0</span>:</td>
			<td><input type="text" size=4 id="shutter_speed"><input type="button" class="button2"  value="OK" onclick="send_cmd('ss ' + document.getElementById('shutter_speed').value)"></td>
        </tr>
        
		<tr>
			<td>Image quality (0...100), <span class="default">default 85</span>:</td>
			<td><input type="text" size=4 id="quality"><input type="button" class="button2"  value="OK" onclick="send_cmd('qu ' + document.getElementById('quality').value)"></td>
        </tr>
        
		<tr>
			<td>Raw Layer, <span class="default">default: 'off'</span></td>
			<td><input type="button" class="button2"  value="ON" onclick="send_cmd('rl 1')"><input type="button" class="button2"  value="OFF" onclick="send_cmd('rl 0')"></td>
        </tr>
        
		<tr>
			<td>Video bitrate (0...25000000), <span class="default">default 17000000</span>:</td>
			<td><input type="text" size=10 id="bitrate"><input type="button" class="button2"  value="OK" onclick="send_cmd('bi ' + document.getElementById('bitrate').value)"></td>
        </tr>
		</table>
		</article>

</div>

<?php include 'footer.php'; ?>