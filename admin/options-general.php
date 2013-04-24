<?php
global $wpdb;
$yfdx_wpdb = $wpdb->get_row("SELECT option_value FROM $wpdb->options WHERE option_name = 'home'");
$yfdx_siteurl = $yfdx_wpdb->option_value;
define ('FDX_SITEURL', $yfdx_siteurl);
$yfdx_domain = str_replace('http://', '', $yfdx_siteurl);
define ('FDX_DOMAIN', $yfdx_domain);
$yfdx_domain2 = str_replace('http://www.', '', $yfdx_siteurl);
$yfdx_check = strpos($yfdx_domain, '/');
$yfdx_check2 = strpos($yfdx_domain2, '/');
if (!empty($yfdx_check)) {
		define ('FDX_DESKTOP', substr($yfdx_siteurl, 7, $yfdx_check));
		define ('FDX_DESKTOP2', substr($yfdx_siteurl, 11, $yfdx_check2));
	} else {
		define ('FDX_DESKTOP', $yfdx_domain);
		define ('FDX_DESKTOP2', $yfdx_domain2);
	}

	$fdx_get = get_option('fdx_db_options');
	if ($fdx_get) {
          	fdx_mobileedition_upgrade($fdx_get['text'], 'text', '');   // , '', 'default value'

        	if ($_SERVER['SERVER_NAME'] == $fdx_get['domain']) {
		  	add_filter('option_template', 'fdx_mobileedition_template');
		 	add_filter('option_stylesheet', 'fdx_mobileedition_template');
			add_filter('option_home', 'fdx_mobileedition_siteurl',1);
			add_filter('option_siteurl', 'fdx_mobileedition_siteurl',1);
			define ('FDXMOBILE_THEME', $fdx_get['theme']);
			define ('FDXMOBILE_STATUS', true);
            define ('FDXMOBILE_TEXT', $fdx_get['text']);

		} else {
			define ('FDXMOBILE_STATUS', false);
		}
		define ('FDXMOBILE_INSTALLED', true);
		define ('FDXMOBILE_DOMAIN', $fdx_get['domain']);
	} else {
		define ('FDXMOBILE_STATUS', false);
		define ('FDXMOBILE_INSTALLED', false);
	}

function fdx_mobileedition_upgrade($data, $keys, $values) {
	global $fdx_get;
	if (!isset($data)){
		$new_array = array();
		foreach($fdx_get as $key => $value){
			$new_array[$key] = $value;
		}
		$new_array[$keys] = $values;
		update_option('fdx_db_options', $new_array);
	}
}

function fdx_3_options() {
    if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-login.php')!==false && FDXMOBILE_STATUS == true) {
    include_once('pages/mobile_login.php');
	exit;
    }
    if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin/')!==false && FDXMOBILE_STATUS == true) {
    include_once('pages/mobile_admin.php');
	exit;
    }

if (FDXMOBILE_INSTALLED == true) {
		if ($_SERVER['SERVER_NAME'] == FDX_DESKTOP) {
//-----------------------------------------------------
$get = get_option('fdx_db_options');
$go = str_replace(FDX_DESKTOP, $get['domain'], FDX_SITEURL);
$mlink = $go . $_SERVER['REQUEST_URI'];
define ('FDX_MLINK',  $mlink);
// set a cookie
if(isset($_GET['switch'])){
setcookie('switch',$_GET['switch']);
}
if(!isset($_GET['switch']) && !isset($_COOKIE['switch'])){
include 'Mobile_Detect.php';  
$detect = new Mobile_Detect();
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
if ($deviceType == "phone"){header('Location: '.$mlink);exit;}
if ($deviceType == "tablet"){header('Location: '.$mlink);exit;}
     }
//-----------------------------------------------------
}
}
}
function fdx_mobileedition_admin(){
	if (!empty($_GET['fdx_action'])) {
		if ($_GET['fdx_action'] == 'add-domain') {
			if (!empty($_POST['domain'])) {
				$subdomain = strtolower($_POST['domain']);
				if (!isset($_POST['link'])) $link = 'no'; else $link = 'yes';
				$domain = array (
					'domain' => $subdomain,
					'theme' => $_POST['theme'],
                    'text' => $_POST['text'],
				);
				update_option('fdx_db_options', $domain);
				echo '<div class="updated fade"><p><strong>' . __( 'Settings updated', 'wp-mobile-edition' ) . '</strong></p></div>';
			} else echo '<div class="error settings-error" id="setting-error-invalid_home"><p>Please enter subdomain for your mobile site.</p></div>';
		}
		if ($_GET['fdx_action'] == 'create-sitemap') {
			if (!empty($_POST['create-sitemap'])) {
				if (get_option('fdx_db_options')) {
					$cek = fdx_sitemap();
					if ($cek)
						echo '<div class="updated"><p>Mobile XML Sitemap Created</p></div>';
					else
						echo '<div class="error settings-error" id="setting-error-invalid_home"><p>' . __( 'Has not been possible create the sitemap file automatically, some hostings provider did this for any reason. Please upload a sitemap file named <code>msitemap.xml</code> to your wordpress root directory manually, you can use FTP Manager to upload it and change the file permissions of a sitemap file to 0666 and try to generate a sitemap again.', 'wp-mobile-edition' ) . '</p></div>';
				}	else echo '<div class="error settings-error" id="setting-error-invalid_home"><p>' . __( 'Please enter subdomain for your mobile site.', 'wp-mobile-edition' ) . '</p></div>';
			}
		}
		if ($_GET['fdx_action'] == 'update-sitemap') {
			if (!empty($_POST['update-sitemap'])) {
				$cek = fdx_sitemap();
				if ($cek)
					echo '<div class="updated"><p>Mobile XML Sitemap Updated</p></div>';
				else
					echo '<div class="error settings-error" id="setting-error-invalid_home"><p><strong>Oops!</strong> Please ensure that your sitemap file has appropriate write permissions. You can use FTP Manager to change the permission of the sitemap file to 0666 and then try updating the sitemap again.</p></div>';
			}
		}
}
	$get = get_option('fdx_db_options');
?>

 <div class="wrap"><?php echo get_screen_icon('fdx-lock');?>
<h2><?php echo FDX3_PLUGIN_NAME;?>: <?php _e('Settings', 'wp-mobile-edition') ?></h2>
<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<?php include('_sidebar.php'); ?>

<div class="postbox-container">
<div class="meta-box-sortables">

<div class="postbox" >
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Mobile Site', 'wp-mobile-edition') ?></span></h3>
<div class="inside">
<p>
                                 <?php
									if (!empty($get['domain'])) {
										$get = get_option('fdx_db_options');
										$go = str_replace(FDX_DESKTOP, $get['domain'], FDX_SITEURL);
									    echo '<h3>You mobile site: <a href="'.$go.'" target="_blank">'.$go.'</a></h3>';
                                        } else {
										echo '<p style="color:#FF0000"><strong>'. __('README FIRST', 'wp-mobile-edition') .'!</strong></p><p><strong>'. __('Have you created your mobile subdomain?', 'wp-mobile-edition') .'</strong></p>
                                        <p>'. __('Setting up a subdomain is done through your hosting provider.', 'wp-mobile-edition') .'</p>
										<p>'. __('if you have not created yet, create subdomain from your domain control panel, point your subdomain document root into the root of wordpress installation or if you don\'t know what to do, contact your hosting provider.', 'wp-mobile-edition') .'</p>';
                                    }
							 ?>
</p>
</div></div>
<div class="postbox" >
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Mobile XML Sitemap', 'wp-mobile-edition') ?></span></h3>
<div class="inside">
<ul><li>
                                     <?php
										if (file_exists(ABSPATH . 'msitemap.xml')) {
											$get = get_option('fdx_db_options');
											$go = str_replace(FDX_DESKTOP, $get['domain'], FDX_SITEURL);
											if ($get) {
												if (is_writable(ABSPATH .'msitemap.xml')) {
													$time = get_option('fdx_sitemap_time');
													if ($time) {
														echo '<p>'. __('Your sitemap was last built on', 'wp-mobile-edition') .': <code>'. $time . '</code></p><p><strong>'. __('Tell Google about your sitemap by joining', 'wp-mobile-edition') .' (<a target="_blank" href="http://www.google.com/webmasters/tools/">Google Webmaster</a>).</strong></p><p>'. __('If you add a new post or remove it, you should update the sitemap manually, and notify Google about your updates by', 'wp-mobile-edition') .' <a href="http://www.google.com/webmasters/tools/ping?sitemap='.$go.'/msitemap.xml" target="_blank"><strong>'. __('pinging it', 'wp-mobile-edition') .'</a></strong></p>';
													} else {
														echo '<p>'. __('You need to update Mobile Domain first', 'wp-mobile-edition') .'</p>';
													}
												} else {
													echo '<p style="color:#FF0000"><strong>'. __('File Permissions needed, please fix this error, then update your sitemap.', 'wp-mobile-edition') .'</strong></p>
													<p>'. __('Ensure that your sitemap file has appropriate write permissions. You can use FTP Manager to change the permission of the sitemap file to 0666 and then try updating the sitemap again.', 'wp-mobile-edition') .'</p>';
												}
												echo '<form method="post" action="options-general.php?page='.FDX3_PLUGIN_P1.'&fdx_action=update-sitemap">
															<div class="submit">
																<input type="submit" name="update-sitemap" class="button" value="'. __('Update Mobile Sitemap', 'wp-mobile-edition') .'" />
															</div>
														</form>';
                                                if ($_POST['text'] <> '') {
                                                echo __('Your Mobile Sitemap', 'wp-mobile-edition') .': <code><a href="'. $go .'/'. $_POST['text'].'/msitemap.xml" target=_new>'. $go .'/'. $_POST['text'] . '/msitemap.xml</a></code>';
                                                  } else {
                                                echo __('Your Mobile Sitemap', 'wp-mobile-edition') .': <code><a href="'.$go.'/msitemap.xml" target=_new>'.$go.'/msitemap.xml</a></code>';
                                                  }
                                        }	else {
												echo '<p>'. __('You need to create Mobile Domain first', 'wp-mobile-edition') .'</p>';
											}
										} else {
												echo '<strong>'. __('Create Mobile XML Sitemap', 'wp-mobile-edition') .'</strong>';
												echo '<form method="post" action="options-general.php?page='.FDX3_PLUGIN_P1.'&fdx_action=create-sitemap">
													<div class="submit">
														<input type="submit" name="create-sitemap" class="button" value="'. __('Generate Mobile XML Sitemap', 'wp-mobile-edition') .'" />
													</div>
												</form>';
											}
                                             ?>
</li></ul>
</div></div>
<form method="post" action="options-general.php?page=<?php echo FDX3_PLUGIN_P1 ?>&fdx_action=add-domain">
<div class="postbox" >
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Subdomain and Mobile Theme Settings', 'wp-mobile-edition') ?></span></h3>
<div class="inside">

<table>
<tr>
<td valign="top"><?php _e('Subdomain for your mobile site', 'wp-mobile-edition') ?>:</td>
<td valign="top"><input type="text" name="domain" id="domain" style="width: 200px" value="<?php echo $get['domain'] ?>" /> <span class="description"><em>(m.domain.com)</em></span> </td>
</tr>
<tr><td><br /></td></tr>
<tr>
<td valign="top"><?php _e('Select mobile theme ', 'wp-mobile-edition') ?>:</td>
<td valign="top"><select name="theme" id="theme" class="postform" style="width: 200px"><option value=""></option>
                                                     <?php
                                                    $themes = get_themes();
													foreach($themes as $theme) {
														if ( $theme["Template"] == $get['theme'] )
															echo '<option value="'.$theme["Template"].'" selected>'.$theme["Name"].'</option>';
														else
                                                        if(strpos(strtolower($theme["Name"]), 'mobile')!==false) {
                                                        echo '<option value="'.$theme["Template"].'">'.$theme["Name"].'</option>';
                                                           }
													}
                                                    ?>
</select></td>
</tr>
</table>


</div></div>







 <div class="postbox closed">
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Advanced Settings', 'wp-mobile-edition') ?></span></h3>
<div class="inside">

 <table>
<tr>
<td valign="top"><?php _e('Custom location of WP Core', 'wp-mobile-edition') ?>:</td>
<td valign="top"><input type="text" name="text" id="text" value="<?php echo $get['text'] ?>" /> <span class="description">(<?php _e('Leave blank if you don\'t know what that is!', 'wp-mobile-edition') ?>)</span><br /><em>root/<code>--?--</code>/wp-admin/</em><br /><em>root/<code>--?--</code>/wp-content/</em><br /><em>root/<code>--?--</code>/wp-includes/</em></td>


</tr>
</table>
</div></div>

<div align="center"> 	<input type="submit" name="submit" class="button-primary" value="<?php _e('Save All Options', 'wp-mobile-edition') ?>" /> </div>
										</form>


</div> <!-- /postbox-container -->
</div><!-- /meta-box-sortables -->



</div><!-- /post-body -->
</div><!-- /poststuff -->


</div><!-- /wrap -->
<div class="clear"></div>
<?php }


/*
* Checks if a file is writable and tries to make it if not.
*/
function fdx_is_writable($filename) {
	if(!is_writable($filename)) {
		if(!@chmod($filename, 0666))
			return false;
	}
	return true;
}

function fdx_dir_is_writable($dirname) {
	if(!is_writable($dirname)) {
		return false;
	}
	return true;
}

/*
*Create xml sitemap loop
*/
function fdx_sitemap() {
	$file = ABSPATH . 'msitemap.xml';
	$get = get_option('fdx_db_options');
	$go = str_replace(FDX_DESKTOP, $get['domain'], FDX_SITEURL);
	global $wpdb;
	$posts = $wpdb->get_results ("SELECT id, post_modified_gmt FROM $wpdb->posts
						WHERE post_status = 'publish'
						AND (post_type = 'post' OR post_type = 'page')
						ORDER BY post_date");

	if (!empty ($posts)) {
		$sitemap  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">' . "\n";
		$sitemap .= "<url>\n";
		$sitemap .= " <loc>".$go."/</loc>\n";
        $sitemap .= " <mobile:mobile />\n";
		$sitemap .= "</url>\n";

		foreach ($posts as $post) {
			$permalink = get_permalink($post->id);
			$permalink = str_replace(get_option('home'), $go, $permalink);
			$sitemap .= "<url>\n";
			$sitemap .= " <loc>$permalink</loc>\n";
            $sitemap .= " <lastmod>".date (DATE_W3C, strtotime ($post->post_modified_gmt))."</lastmod>\n";
			$sitemap .= " <mobile:mobile />\n";
			$sitemap .= "</url>\n";
		}
		$sitemap .= "\n</urlset>";
	}
	if(fdx_is_writable($file) || fdx_dir_is_writable(ABSPATH)) {
		if (file_put_contents ($file, $sitemap)) {
			update_option('fdx_sitemap_time', current_time($gmt = 0));
			return true;
		}
	}
	return false;
}


function fdx_mobileedition_siteurl(){
	$go = str_replace(FDX_DESKTOP, FDXMOBILE_DOMAIN, FDX_SITEURL);
	return $go;
}

function fdx_mobileedition_template($theme) {
	if (is_dir(ABSPATH.'wp-content/themes/'.FDXMOBILE_THEME))
		return FDXMOBILE_THEME;
	else
		return $theme;
}

?>