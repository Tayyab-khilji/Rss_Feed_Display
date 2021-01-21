<?php
/*
Plugin Name: Dashboard widget
Plugin URI: 
Description: This plugin will add a widget to  wordpress admin dashboard 
Version: 1.0
Author: Tayyab Rehman
Author URI: 
*/


function tr_dashboard_widget()
{
    // Creating custom widget
    wp_add_dashboard_widget('dashboard_widget','Tr_dashboard_widget','dispaly_widget','setup_widget');
}

// Adding action
add_action('wp_dashboard_setup', 'tr_dashboard_widget');

function setup_widget()
{
    //check if option is set before saving
 if ( isset( $_POST['Tr_rss_feed'] ) ) {
 //retrieve the option value from the form
 $Tr_rss_feed = esc_url_raw( $_POST['Tr_rss_feed'] );

 //save the value as an option
 update_option( 'Tr_dashboard_widget_rss', $Tr_rss_feed );
 }
 //load the saved feed if it exists
 $Tr_rss_feed = get_option( 'Tr_dashboard_widget_rss');
 ?>
 <label for="feed" >
 RSS Feed URL: <input type="text" name="Tr_rss_feed" id="Tr_rss_feed"
 value=" <?php echo esc_url( $Tr_rss_feed ); ?> " size="50" / >
 </label >
 <?php
}
function dispaly_widget()
{
 //load our widget option
 $Tr_option = get_option( 'Tr_dashboard_widget_rss');
 //if option is empty set a default
 $Tr_rss_feed = ( $Tr_option ) ? $Tr_option : 'http://wordpress.org/news/feed/';
 //retrieve the RSS feed and display it
 echo " <div class='rss-widget'> ";
 wp_widget_rss_output( array(
 'url' => $Tr_rss_feed,
 'title' => 'RSS Feed News',
 'items' =>2,
 'show_summary' => 1,
 'show_author' => 0,
 'show_date' => 1
 ) );
 echo "</div>";
}
