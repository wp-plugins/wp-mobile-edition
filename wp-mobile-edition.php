<?php
/*
Plugin Name: WP Mobile Edition
Description: Is a complete toolkit to mobilize your WordPress site. It has a mobile switcher, themes, and mobile XML Sitemap Generator.
Version: 1.9.2
Author: Fabrix DoRoMo
Author URI: http://fabrix.net
Plugin URI: http://fabrix.net/wp-mobile-edition
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*********************************************************************************/
define('FDX3_PLUGIN_NAME', 'WP Mobile Edition' );
define('FDX3_PLUGIN_VERSION', '1.9.2' );
define('FDX3_PLUGIN_URL', plugin_dir_url(__FILE__));

define('FDX3_WPPAGE', 'http://wordpress.org/extend/plugins/wp-mobile-edition');
define('FDX3_PLUGINPAGE', 'http://fabrix.net/wp-mobile-edition');
define('FDX3_GLOTPRESS', 'http://translate.fabrix.net/projects/wp-mobile-edition');
define('FDX3_SUPFORUM', 'http://wordpress.org/support/plugin/wp-mobile-edition');
define('FDX3_DONATELINK', 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BABHNAQX4HLLW');

define('FDX3_PLUGIN_P1', 'wp-mobile-edition' ); //link1, plugin prefix (.mo)
define('FDX3_PLUGIN_P2', 'wp-mobile-ed-mtheme' ); //link2

/* Locale, menu,...
*------------------------------------------------------------*/
function fdx3_lang_init(){
load_plugin_textdomain('wp-mobile-edition', false, dirname(plugin_basename( __FILE__ )).'/languages');
}

register_nav_menu( 'fdx-menu', FDX3_PLUGIN_NAME);

add_image_size( 'cat-thumb', 60, 60, true );

/*
*------------------------------------------------------------*/
function fdx_3_init() {
    if (is_admin() && current_user_can('administrator')) {
      add_action( 'admin_menu', 'fdx3_admin_add_page' );
      //------------------------------
       if ( isset( $_GET['page'] ) && $_GET['page'] == FDX3_PLUGIN_P1 || isset( $_GET['page'] ) && $_GET['page'] == FDX3_PLUGIN_P2)  {
           add_action('admin_enqueue_scripts', 'fdx_3_enqueue_scripts');
           wp_enqueue_script('media-upload');
           }
 }
add_action('admin_notices', 'fdx_3_admin_notices');  // Add theme
add_action( 'admin_init', 'fdx3_updater_admin_init' );
}

/* Loads CSS or JS
*------------------------------------------------------------*/
function fdx_3_enqueue_scripts() {
      wp_enqueue_style('fdx-css', FDX3_PLUGIN_URL . 'css/fdx-inc.css', array(), FDX3_PLUGIN_VERSION);
      wp_enqueue_script('wpcore-js', admin_url() . 'load-scripts.php?c=0&amp;load=jquery-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable,postbox,post', array(), FDX3_PLUGIN_VERSION, true);
      wp_enqueue_script('fdx-js', FDX3_PLUGIN_URL . 'js/fdx-inc.js', array(), FDX3_PLUGIN_VERSION, true);
 }


/*  notices
*------------------------------------------------------------*/
function fdx_3_admin_notices() {
  if($warning=get_option('fdx_warning')) {
    print "<div class='error'><p><strong style='color:#770000'>";
    print __("ERROR IN SETUP", 'wp-mobile-edition');
    print "</strong></p><p>$warning</p><p><strong>";
    print __('Deactivate and re-activate the plugin', 'wp-mobile-edition').": " .FDX3_PLUGIN_NAME;
    print "</strong></p></div>";
  }
  if($flash=get_option('fdx_flash')) {
    print "<div class='error'><p><strong style='color:#770000'>";
    print __('WARNING', 'wp-mobile-edition');
    print "</strong></p><p>$flash</p></div>";
    update_option('fdx_flash', '');
  }
}


/*
*------------------------------------------------------------*/
require_once( dirname(__FILE__) . '/admin/options-general.php' );
require_once( dirname(__FILE__) . '/admin/theme.php' );

/*
*------------------------------------------------------------*/
function fdx3_admin_add_page(){
    	add_menu_page(' ','WP <small>Mobile Edition</small>', 'manage_options', FDX3_PLUGIN_P1, 'fdx_mobileedition_admin', FDX3_PLUGIN_URL . '/images/menu.png' );
    add_submenu_page(FDX3_PLUGIN_P1, __('Settings', 'wp-mobile-edition'), __('Settings', 'wp-mobile-edition'), 'manage_options', FDX3_PLUGIN_P1, 'fdx_mobileedition_admin');
    add_submenu_page(FDX3_PLUGIN_P1, 'mTheme', 'mTheme', 'manage_options', FDX3_PLUGIN_P2, 'fdx_mobile_theme');

//( Add theme) user has forced theme upgrade
  if (isset($_POST['fdx_force_copy_theme'])){
    update_option('fdx_warning', '');
    update_option('fdx_flash', '');
    fdx_3_directory_copy_themes(dirname(__FILE__) . "/themes", get_theme_root(), false);
    wp_redirect('plugins.php');
  }
}

/* Add theme
*------------------------------------------------------------*/
function fdx_3_pack_activate() {
  update_option('fdx_warning', '');
  update_option('fdx_flash', '');
  if (fdx_3_readiness_audit()) {
    fdx_3_directory_copy_themes(dirname(__FILE__) . "/themes", get_theme_root());
  }
}

function fdx_3_readiness_audit() {
  $ready = true;
  $why_not = array();


  $theme_dir = str_replace('/', DIRECTORY_SEPARATOR, get_theme_root());
  $theme_does = '';
  if (!file_exists($theme_dir)) {
  	$theme_does = __("That directory does not exist.", 'wp-mobile-edition');
  } elseif (!is_writable($theme_dir)) {
  	$theme_does = __("That directory is not writable.", 'wp-mobile-edition');
  } elseif (!is_executable($theme_dir) && DIRECTORY_SEPARATOR=='/') {
  	$theme_does = __("That directory is not executable.", 'wp-mobile-edition');
  }
  if($theme_does!='') {
    $ready = false;
    $why_not[] = sprintf(__('<strong>Not able to install mobile theme files (mTheme)</strong> to %s.', 'wp-mobile-edition'), $theme_dir) . '<p> ' . $theme_does . '</p>';
  }

  if (!$ready) {
    update_option('fdx_warning', join("<hr />", $why_not));
  }
  return $ready;
}

function fdx_3_directory_copy_themes($source_dir, $destination_dir, $benign=true) {
  if(file_exists($destination_dir)) {
  	$dir_does = '';
	  if (!is_writable($destination_dir)) {
	  	$dir_does = "That directory is not writable.";
	  } elseif (!is_executable($destination_dir) && DIRECTORY_SEPARATOR=='/') {
	  	$dir_does = "That directory is not executable.";
	  }
	  if($dir_does!='') {
      update_option('fdx_warning', sprintf(__('<strong>Not able to install mobile theme files (mTheme)</strong> to ', 'wp-mobile-edition'), $destination_dir) . ' ' . $dir_does);
      return;
    }
  } elseif (!is_dir($destination_dir)) {
    if ($destination_dir[0] != ".") {
	    mkdir($destination_dir);
	  }
  }

  $dir_handle = opendir($source_dir);
  while($source_file = readdir($dir_handle)) {
    if ($source_file[0] == ".") {
      continue;
    }
    if (file_exists($destination_child = "$destination_dir/$source_file") && $benign) {
      update_option('fdx_flash',
                    __("Existing mTheme files were found (default mobile theme of plugin)", 'wp-mobile-edition') .
                    "</p><p><strong>" .
                    __("Update of mTheme? (recommended)", 'wp-mobile-edition') .
                    "</p><form method='post' action='" . $_SERVER['REQUEST_URI'] . "'>".
                    "<input type='submit' class='button' name='fdx_force_copy_theme' value='" .
                    __('Yes', 'wp-mobile-edition') .
                    "' />&nbsp;&nbsp;&nbsp;&nbsp;".
                    "<input type='submit' class='button' value='" .
                    __('No', 'wp-mobile-edition') .
                    "' />".
                    "</form></strong><p>");
      continue;
    }
    if (is_dir($source_child = "$source_dir/$source_file")) {
      fdx_3_directory_copy_themes($source_child, $destination_child, $benign);
      continue;
    }

    if (file_exists($destination_child) && !is_writable($destination_child)) {
      update_option('fdx_warning', sprintf(__('<strong>Could not install file</strong> to %s.', 'wp-mobile-edition'), $destination_child) . ' ' . __('Please ensure that the web server has write- access to that file.', 'wp-mobile-edition'));
      continue;
    }
    copy($source_child, $destination_child);
  }
  closedir($dir_handle);
}


/*
*------------------------------------------------------------*/
add_action('init', 'fdx_3_init');
add_action('init', 'fdx_3_options');
add_action('init', 'fdx3_lang_init');

register_activation_hook('wp-mobile-edition/wp-mobile-edition.php', 'fdx_3_pack_activate');
?>