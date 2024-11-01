<?php
/* 
Plugin Name: WP-Afrigator
Plugin URI: http://compl33t.com/2009/04/13/wp-afrigator/
Version: 1.0.3
Author: Albert Cornelissen (http://compl33t.com)
Description: Makes it easy to add Afrigator.com's tracking code to your Wordpress-powered site.
 
Copyright 2009  Albert Cornelissen  (email : compl33t [a t ] g m ail DOT com)
Licenced under GNU General Public License (GPL) version 3 (http://www.gnu.org/licenses/gpl.html)

Afrigator logo and button images are Copyright 2007-2009 Afrigator Internet (Pty) Ltd (http://afrigator.com/)

	This is a WordPress plugin (http://www.wordpress.org/).

*/
if (!class_exists("WPAfri")) {
	class WPAfri {
		
		var $adminOptionsName = "WPAfriAdminOptions";
		
		function WPAfri() { 
			
		}
		
			

		
		
		function getAdminOptions() {
	  
		      $WPAfriOptionsA = array( 'afri_code' => '', 'afri_usebutton' => 'true', 'afri_button' => 'default');
	  
		      $WPAfriOptions = get_option($this->adminOptionsName);
	  
		      if (!empty($WPAfriOptions)) {
	  
			  foreach ($WPAfriOptions as $key => $option)
	  
			      $WPAfriOptionsA[$key] = $option;
	  
		      }            
	  
		      update_option($this->adminOptionsName, $WPAfriOptionsA);
	  
		      return $WPAfriOptionsA;

		}
		
		
		   
		function init() {
   
                  $this->getAdminOptions();
		  
   
		}
		



		function printAdminPage() {
					$WPAfriOptions = $this->getAdminOptions();
					if (isset($_POST['update_WPAfriAdminOptions'])) {
						if (isset($_POST['af_code'])) {
							$WPAfriOptions['afri_code'] = $_POST['af_code'];
						}
						if (isset($_POST['af_ub'])) {
							$WPAfriOptions['afri_usebutton'] = $_POST['af_ub'];
						}
						if (isset($_POST['af_button'])) {
							$WPAfriOptions['afri_button'] = $_POST['af_button'];
						}
		
						update_option($this->adminOptionsName, $WPAfriOptions);
						?>
						<div class="updated" style="text-align: left;"><p><strong><?php _e("Settings Updated.", "WPAfriAdminOptions");?></strong></p></div>
					<?php
					}
					
					?>
			
			<div class="wrap" style="margin-top: 50px;">
			<div style="width:100%; background: url('<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/bg.gif') top left repeat-x; clear: both;"><a href="http://www.afrigator.com"><img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/logo.gif" alt="Logo"  /></a></div>
			</div>
			<div class="wrap" style="border: 2px solid #5a5a5a; padding: 10px;">
			<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
				<table style="width:100%;">
					<thead><tr><th colspan="2" style="text-align:left;">
					<h2>Wordpress Afrigator Plugin</h2>
					<p>Afrigator is a social media aggregator and directory built especially for African digital citizens who publish and consume content on the Web. <br/>
					   You can use Afrigator to index your blog, podcast, videocast or news site (i.e. any site that publishes an RSS feed) and market it to the rest of Africa and the world.</p>
					<p>Sign up now at <a href="http://www.afrigator.com">http://www.afrigator.com</a>!</p>
					</th></tr>
				</thead>
				
				<tbody>
					<tr><th colspan="2" style="text-align:left;">
						<h3 style="border-bottom: 1px solid #cfcfcf;">Tracking Code</h3>
					</th></tr>
					
					<tr>
						<td>
							<label for="af_code">Code*</label>
							<p><small>To find this, login to Afrigator, go to your <a href="http://afrigator.com/dashboard">dashboard</a> and click on the <em>Tracking Code</em> button.<br/>
								  Here you'll see lots of options with some code you can copy and paste. Look for the recurring number in all the code. That's your Tracking Code! <br/><br/>
								  <img style="border: 3px solid #5a5a5a;" src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/code.jpg" alt="Code Example"  />
								  <br/><em> In this example, <strong>6656</strong> is the tracking code.</em>
							</small></p>
						</td>
						<td style="border-left: 2px solid #cfcfcf; padding-left: 15px;">
							<input type="text" size="10" id="af_code" name="af_code" value="<?php _e(apply_filters('format_to_edit',$WPAfriOptions['afri_code']), 'WPAfri') ?>" />
						</td>
					</tr>
					
					<tr><th colspan="2" style="text-align:left;">
						<h3 style="border-bottom: 1px solid #cfcfcf;">Show a Button?</h3>
					</th></tr>
					
					<tr>
						<td>
							Would you like to show a button to support Afrigator?<br/>
							<small><em>If this is enabled, please add the WP-Afrigator Widget to a sidebar in the <strong>Appearance > Widgets</strong> section.</em></small>
						</td>
						<td style="border-left: 2px solid #cfcfcf; padding-left: 15px;>
	
							<label for="af_uby"><input type="radio" id="af_uby" name="af_ub" value="true" <?php if ($WPAfriOptions['afri_usebutton'] == "true") { _e('checked="checked"', "WPAfri"); }?> /> Yes</label><br/>
							<label for="af_ubn"><input type="radio" id="af_ubn" name="af_ub" value="false" <?php if ($WPAfriOptions['afri_usebutton'] == "false") { _e('checked="checked"', "WPAfri"); }?> /> No</label>
						</td>
					</tr>
					
				</tbody>
			</table>
			<div id="buttonsc" <?php if ($WPAfriOptions['afri_usebutton'] == "false") {?> style="display:none;"<?php } ?>>
			<table style="width: 100%;">
					
					<tr><th colspan="2" style="text-align:left;">
						<h3 style="border-bottom: 1px solid #cfcfcf;">Choose a button!</h3>
					</th></tr>
					
					<tr> 
						<td>
							Choose a button style to use on your site
							
						</td>
						<td>
	
							<label for="afb_default"><input type="radio" id="afb_default" name="af_button" value="default" <?php if ($WPAfriOptions['afri_button'] == "default") { _e('checked="checked"', "WPAfri"); }?> /> <img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/default.gif" alt="Default" /></label><br/><br/>
							<label for="afb_lwht"><input type="radio" id="afb_lwht" name="af_button" value="lwht" <?php if ($WPAfriOptions['afri_button'] == "lwht") { _e('checked="checked"', "WPAfri"); }?> /> <img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/lwht.gif" alt="Large White" /></label><br/><br/>
							<label for="afb_sblk"><input type="radio" id="afb_sblk" name="af_button" value="sblk" <?php if ($WPAfriOptions['afri_button'] == "sblk") { _e('checked="checked"', "WPAfri"); }?> /> <img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/sblk.gif" alt="Small Black" /></label><br/><br/>
							<label for="afb_swht"><input type="radio" id="afb_swht" name="af_button" value="swht" <?php if ($WPAfriOptions['afri_button'] == "swht") { _e('checked="checked"', "WPAfri"); }?> /> <img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-afrigator/images/swht.gif" alt="Small White" /></label><br/><br/>
						</td>
					</tr>
			</table>
			</div>
			<table style="width: 100%; margin-top: 10px;">
					<tr>
						<td class="submit" colspan="2" style="border-top: 2px dotted #cfcfcf; text-align: right;">
							
							<input type="submit" name="update_WPAfriAdminOptions" value="<?php _e('Update Settings', 'WPAfri') ?>" />
						</td>
					</tr>
					
					<tr>
						<td style="border-top: 1px solid #cacaca; font-size: 0.7em; text-align: center;">
							The Afrigator logo and Afrigator buttons are &copy; 2007-2009 Afrigator Internet (Pty) Ltd.
						</td>
					</tr>	
				
				
			</table>
			</form>
			</div>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript">
			$(document).ready(function() {

				$("#af_ubn").click(function () {
				
					$("#buttonsc").slideUp();
				});
				
				$("#af_uby").click(function () {
					
					$("#buttonsc").slideDown();
				}); 


			});// document ready

			</script>
	
	<?php }
	
	
	function afriButton() {
		
		$WPAfriOptions = $this->getAdminOptions();
		$afcode = $WPAfriOptions['afri_code'];
		
		if ($WPAfriOptions['afri_usebutton'] == "false") {
			
			$output = "";
			
		}
		
		else {
		
		

			switch ($WPAfriOptions['afri_button']) {
				
				
				case "default":
					$output = '
						<!-- Afrigator Tracking code from WP-Afrigator -->
						<a href="http://afrigator.com/author/' . $afcode . '" title="Afrigator">
						<img src="http://afrigator.com/track/' . $afcode . '-default.gif" alt="Afrigator" border="0"/>
						</a>
					
					';
					break;
				
				case "lwht":
					$output = '
						<!-- Afrigator Tracking code from WP-Afrigator -->
						<a href="http://afrigator.com/author/' . $afcode . '" title="Afrigator">
						<img src="http://afrigator.com/track/' . $afcode . '-lwht.gif" alt="Afrigator" border="0"/>
						</a>
					
					';
					break;
				
				case "sblk":
					$output = '
						<!-- Afrigator Tracking code from WP-Afrigator -->
						<a href="http://afrigator.com/author/' . $afcode . '" title="Afrigator">
						<img src="http://afrigator.com/track/' . $afcode . '-sblk.gif" alt="Afrigator" border="0"/>
						</a>
					
					';
					break;
				
				case "swht":
					$output = '
						<!-- Afrigator Tracking code from WP-Afrigator -->
						<a href="http://afrigator.com/author/' . $afcode . '" title="Afrigator">
						<img src="http://afrigator.com/track/' . $afcode . '-swht.gif" alt="Afrigator" border="0"/>
						</a>
					
					';
					break;
	
			
		}
		
		}
		
		return $output;
		
		
		
	}
	
	
	function toFoot() {
		
		
		$WPAfriOptions = $this->getAdminOptions();
		$afcode = $WPAfriOptions['afri_code'];
		
		if ($WPAfriOptions['afri_usebutton'] == "false") {
			
			echo '
<!-- Afrigator Tracking code from WP-Afrigator -->
<img src="http://afrigator.com/track/' . $afcode . '-none.gif" alt="Afrigator" />

			';
			
		}
			
			
		
		
		
		
	}
	
	
	function widget_WPAfri($args) {
		
		echo $args['before_widget'];
		echo $args['before_title'];
		echo $args['after_title'];
		echo $this->afriButton();
		echo $args['after_widget'];

		

	}
	
	function widget_WPAfri_control() {
		
		?>
			
			<p>Simply drag the widget to where you would like the Afrigator button to appear.</p>
			
		<?php
		

	}
	

}
}

if (class_exists("WPAfri")) {
	$WPAfri = new WPAfri();
}


if (!function_exists("WPAfri_ap")) {
	function WPAfri_ap() {
		global $WPAfri;
		if (!isset($WPAfri)) {
			return;
		}
		if (function_exists('add_options_page')) {
			
			add_options_page('WP-Afrigator', 'WP-Afrigator', 9, basename(__FILE__), array(&$WPAfri, 'printAdminPage'));
			
		}
			

	}	
}


if (!function_exists("widget_WPAfri_init")) {
	
	function widget_WPAfri_init() {
		global $WPAfri;
		if (!isset($WPAfri)) {
			return;
		}
		
		$opts = $WPAfri->getAdminOptions();
		
		if ($opts['afri_usebutton'] == "true") {

			if (function_exists('register_sidebar_widget')) {
				
				register_sidebar_widget('WP-Afrigator', array(&$WPAfri, 'widget_WPAfri'));
				
			}
			
			if (function_exists('register_widget_control')) {
				
				register_widget_control('WP-Afrigator', array(&$WPAfri, 'widget_WPAfri_control'));
				
			}
		
		}
		

	}	
	
	
	
}


if (isset($WPAfri)) {

	add_action('admin_menu', 'WPAfri_ap');
	add_action('widgets_init', 'widget_WPAfri_init');
	add_action('wp_footer', array(&$WPAfri, 'toFoot'));
	add_action('activate_wp-afrigator/wp-afrigator.php',  array(&$WPAfri, 'init'));
	
}

?>
