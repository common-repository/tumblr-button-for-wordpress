<?php
/*
Plugin Name: Tumblr Button For WordPress
Plugin URI: http://tommcfarlin.com/tumblr-button-for-wordpress
Description: This plugin makes it easy to incorporate the Tumblr Share Button by adding it to the bottom of each of your posts.
Version: 1.0
Author: Tom McFarlin
Author URI: http://tommcfarlin.com
Author Email: tom@tommcfarlin.com
License:

    Copyright 2011 Tom McFarlin (tom@tommcfarlin.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Tumblr_Button_For_WordPress {

	/*--------------------------------------------*
	 * Constructors
	 *---------------------------------------------*/

	function __construct() {
		
		if(function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('tumblr-button-for-wordpress', false, dirname(plugin_basename(__FILE__)) . '/lang');
		} // end if
		
		if(function_exists('add_action')) {
			add_action('admin_menu', array($this, 'admin'));
		} // end if
		
		if(function_exists('add_filter')) {
			$this->import_tumblr_share_script();
			add_filter('the_content', array($this, 'add_tumblr_button_to_posts'));
		} // end if
		
		if(is_admin()) {
			wp_register_style('tumblr-button-for-wordpress', WP_PLUGIN_URL . '/tumblr-button-for-wordpress/css/admin.css');
			wp_enqueue_style('tumblr-button-for-wordpress');
		} // end if
		
	} // end constructor

	/*--------------------------------------------*
	 * Functions
	 *---------------------------------------------*/
	
	/**
	 * Adds the menu page to WordPress dashboard.
	 */
	function admin() {
		if(function_exists('add_submenu_page')) {
			add_submenu_page('themes.php', 'Tumblr Button', 'Tumblr Button', 'administrator', 'tumblr-button', array($this, 'display'));
		} // end if
	}  // end admin
	
	/**
	 * Adds the plugin's administration panel to the WordPress dashboard.
	 */
	function display() {
		if(is_admin()) {
			$is_updated = $this->configuration();
			include_once('views/admin.php');
		} // end if
	} // end display
	
	/**
	 * Appends the Tumblr share button to the end of each post.
	 *
	 * @content	The post content.
	 */
	function add_tumblr_button_to_posts($content) {
	
		global $post;
		if(is_single($post)) {
			
			$options = get_option('tumblr-button-for-wordpress');
			if(isset($options)) {

				$tumblr_button = '<p>';
					$tumblr_button .= $this->get_tumblr_button_by_id($options['tumblr-button-for-wordpress-selected']);
				$tumblr_button .= '</p>';
			
				$content .= $tumblr_button;
			
			} // end if
			
		} // end if
		
		return $content;
	
	} // end add_tumblr_button_to_posts
	
	/**
	 * Updates the options based on the configuration in the admin panel.
	 */
	function configuration() {
		
		$options = get_option('tumblr-button-for-wordpress');
		
		// if the options aren't initialized, initialize them
		if(!isset($options['tumblr-button-for-wordpress-selected'])) {
			$options['tumblr-button-for-wordpress-selected'] = null;
		} // end if
		
		// if the user is saving their option, update the options
		if(isset($_POST['submit'])) {

			check_admin_referer('tumblr-button-for-wordpress', 'tumblr-button-for-wordpress-admin');
			if(isset($_POST['tumblr-button'])) {
				$options['tumblr-button-for-wordpress-selected'] = $_POST['tumblr-button'];
			} // end if

			update_option('tumblr-button-for-wordpress', $options);
		
		} // end if
		
		return $is_updated;
		
	} // end configuration
	
	/*--------------------------------------------*
	 * Private Functions
	 *---------------------------------------------*/
	
	/**
	 * Imports the Tumblr Share JavaScript library and adds it to the foot of the page.
	 */
	private function import_tumblr_share_script() {
		wp_register_script('tumblr-share-script', 'http://platform.tumblr.com/v1/share.js', null, 1.0, true);	
		wp_enqueue_script('tumblr-share-script');
	} // end import_tumblr_share_script
	
	/**
	 * Returns the proper markup for the selected Tumblr button.
	 *
	 * @id	The button selected from the plugin's admin panel.
	 */
	private function get_tumblr_button_by_id($id) {
	
		$button = '';
	
		switch($id) {
		
			case "button-1":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_1.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;

			case "button-2":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_2.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;				
			
			case "button-3":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_3.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
			case "button-4":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:20px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_4.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
			case "button-5":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:20px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_4T.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
			case "button-6":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_3T.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
			case "button-7":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_2T.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
			case "button-8":
				$button = '<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_1T.png\') top left no-repeat transparent;">Share on Tumblr</a>';
				break;
				
		} // end switch
		
		return $button;
		
	} // end get_tumblr_button_by_id
	
} // end class
new Tumblr_Button_For_WordPress();
?>