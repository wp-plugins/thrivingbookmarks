<?php
/*
Plugin Name: ThrivingBookmarks
Plugin URI: http://ThrivingKings.com/ThrivingBookmarks-social-bookmarks-wp-plugin/
Description: Add attractive social networking bookmarks to your sidebar, providing links directly to your various social networking pages.
Author: Daniel Raftery
Version: 1
Author URI: http://ThrivingKings.com
*/


register_sidebar_widget( 'ThrivingBookmarks', 'widget_ThrivingBookmarks'); 

function widget_ThrivingBookmarks($args) {  
extract($args);  
  
$options = get_option("widget_sideFeature");  
   
echo $before_widget;  
echo $before_title;  
echo $options['title'];  
echo $after_title;  
widget_sideFeature();  
echo $after_widget;  
}    

  
function widget_sideFeature() {  
$options = get_option("widget_sideFeature");  
$displaystyle = $options['style'];  
$rsso = $options['rss'];  
$twitter = $options['twitter'];
$twitterhandle = $options['twitterhandle'];
$facebook = $options['facebook'];
$facebookhandle = $options['facebookhandle'];

	if ($displaystyle == 'Stack') {
		if($rsso == 'On') {
			?>
			<a href="<?php bloginfo('rss2_url') ?>"><img src="/img/rss.png" title="Subscribe to the RSS" /></a>
			<?
		}
		if($twitter == 'On') {
			echo ' <a href="http://twitter.com/'.$twitterhandle.'"><img src="/img/twitter.png" title="Follow on Twitter" /></a> ';
		}
		if($facebook == 'On') {
			echo '<a href="http://facebook.com/'.$facebookhandle.'"><img src="/img/fb.png" title="Become a fan on Facebook" /></a> ';
		}
	}
	elseif ($displaystyle == 'List') {
		echo '<ul>';
		if($rsso == 'On') {
			?>
			<li><a href="<?php bloginfo('rss2_url') ?>"><img src="/img/rss.png" title="Subscribe to the RSS" /></a></li>
			<?
		}
		if($twitter == 'On') {
			echo '<li><a href="http://twitter.com/'.$twitterhandle.'"><img src="/img/twitter.png" title="Follow on Twitter" /></a></li>';
		}
		if($facebook == 'On') {
			echo '<li><a href="http://facebook.com/'.$facebookhandle.'"><img src="/img/fb.png" title="Become a fan on Facebook" /></a></li>';
		}
		echo '</ul>';
	}
}  

function ThrivingBookmarks_control()
{
$options = get_option("widget_sideFeature");

if (!is_array( $options ))	{
	$options = array(
	'title' => 'Connect',
	'style' => 'List',
	'rss' => 'On',
	'twitter' => 'On',
	'facebook' => 'On'
	);
	}

if ($_POST['sideFeature-Submit']) {
	$options['title'] = htmlspecialchars($_POST['sideFeature-WidgetTitle']);
	$options['style'] = htmlspecialchars($_POST['sideFeature-DisplayStyle']);
	$options['rss'] = htmlspecialchars($_POST['sideFeature-RSS']);
	$options['twitter'] = htmlspecialchars($_POST['sideFeature-Twitter']);
	$options['facebook'] = htmlspecialchars($_POST['sideFeature-Facebook']);
	$options['twitterhandle'] = htmlspecialchars($_POST['sideFeature-TwitterHandle']);
	$options['facebookhandle'] = htmlspecialchars($_POST['sideFeature-FacebookHandle']);
	
	update_option("widget_sideFeature", $options);
	}

	echo'
	<p>
	<label for="sideFeature-WidgetTitle">Title: </label><br />
	<input class="widefat" type="text" id="sideFeature-WidgetTitle" name="sideFeature-WidgetTitle" value="'.$options['title'].'" />
	<br /><br />
	<label for="sideFeature-PostNumber">Display Style: </label>
	<input type="radio" id="sideFeature-DisplayStyle" name="sideFeature-DisplayStyle" value="List"'; if($options['style'] == 'List') { echo 'checked'; }
	echo '/>List Format 
	<input type="radio" id="sideFeature-DisplayStyle" name="sideFeature-DisplayStyle" value="Stack"'; if($options['style'] == 'Stack') { echo 'checked'; }
	echo ' />Stack Format
	<br /><br />
	
	<label for="sideFeature-Category">RSS: </label>
	<input type="radio" id="sideFeature-RSS" name="sideFeature-RSS" value="On" '; if($options['rss'] == 'On') { echo 'checked'; }
	echo ' />On 
	<input type="radio" id="sideFeature-RSS" name="sideFeature-RSS" value="Off" '; if($options['rss'] == 'Off') { echo 'checked'; }
	echo '/>Off
	<br /><br/>
	
	<label for="sideFeature-Category">Twitter: </label>
	<input type="radio" id="sideFeature-Twitter" name="sideFeature-Twitter" value="On"'; if($options['twitter'] == 'On') { echo 'checked'; }
	echo ' />On 
	<input type="radio" id="sideFeature-Twitter" name="sideFeature-Twitter" value="Off"'; if($options['twitter'] == 'Off') { echo 'checked'; }
	echo ' />Off
	<br />
	Twitter handle: <input class="widefat" type="text" id="sideFeature-TwitterHandle" name="sideFeature-TwitterHandle" value="'.$options['twitterhandle'].'" /><br/><br/>
	
	<label for="sideFeature-Category">Facebook: </label>
	<input type="radio" id="sideFeature-Facebook" name="sideFeature-Facebook" value="On"'; if($options['facebook'] == 'On') { echo 'checked'; }
	echo ' />On 
	<input type="radio" id="sideFeature-Facebook" name="sideFeature-Facebook" value="Off"'; if($options['facebook'] == 'Off') { echo 'checked'; }
	echo ' />Off
	<br />
	Facebook handle: <input class="widefat" type="text" id="sideFeature-FacebookHandle" name="sideFeature-FacebookHandle" value="'.$options['facebookhandle'].'" />
	
	<input type="hidden" id="sideFeature-Submit" name="sideFeature-Submit" value="1" />
	';
}

register_widget_control( 'ThrivingBookmarks', 'ThrivingBookmarks_control');