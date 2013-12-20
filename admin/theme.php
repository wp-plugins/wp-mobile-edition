<?php
/*
*------------------------------------------------------------*/
$options_default = array(
		'fdx_email_contato' => 'email@email.com',
        'fdx_logo_url' => FDX3_PLUGIN_URL .'/images/logob.png',
		'fdx_feed_url' => 'http://',
        'fdx_twitter_url' => '',
        'fdx_facebook_url' => '',
        'fdx_google_url' => '',
        'fdx_ink_url' => '',
        'fdx_index_home' => 'index',
        'dark_clean' => 'clean',
        'fdx_color' => 'blue',
        'fdx_text_head' => '',
        'fdx_text_foot' => '',
        'fdx_text_ads' => '',

				);
add_option( 'fdx3_updater_options', $options_default);

//habilitar editor mudar opções
function add_theme_caps()
          {
          $role = get_role( 'editor' );
          $role->add_cap( 'manage_options' );
          }
add_action( 'admin_init', 'add_theme_caps');

function fdx_mobile_theme() {
$options = get_option('fdx3_updater_options');

?>
<div class="wrap"><?php echo get_screen_icon('fdx-lock');?>
<h2><?php echo FDX3_PLUGIN_NAME;?>: <?php _e('mTheme', 'wp-mobile-edition') ?></h2>
<?php
if ( ( isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ) || ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) ) {
echo '<div class="updated fade"><p><strong>' . __( 'Settings updated', 'wp-mobile-edition' ) . '</strong></p></div>';
}
?>
<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<?php include('_sidebar.php'); ?>

<div class="postbox-container">
<div class="meta-box-sortables">

<form action="options.php" method="post">
<?php settings_fields('fdx3_updater_options'); ?>
<div class="postbox" >
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Basic Settings', 'wp-mobile-edition') ?></span></h3>
<div class="inside">
<!-- ############################################################################################################### -->
<?php
$get = get_option('fdx_db_options');
if (!empty($get['domain'])) {
$go = str_replace(FDX_DESKTOP, $get['domain'], FDX_SITEURL);
echo '<br /><table style="width:100%;" class="widefat"><thead><tr><th>You mobile site: <a href="'.$go.'" target="_blank">'.$go.'</a></th> </tr></thead>';
echo '<tbody><tr class="alternate"><td><p>Create a blank page named Contact (slug = contact): ';
echo '<code><strong>'.$go.'/contact</strong></code></p>';
echo '<p>Create a blank page named Index (slug = index): ';
echo '<code><strong>'.$go.'/index</strong></code></p></td></tr></tbody></table><br />';
} else {
echo '<br />';
}
?>




<table style="width:100%;" class="widefat">
 <thead><tr><th><?php _e('Logo', 'wp-mobile-edition') ?></th> </tr></thead>
<tbody><tr class="alternate"><td>
<p><strong><?php _e('Enter your Logo URL', 'wp-mobile-edition') ?> </strong> <span class="description">(PNG, GIF, JPG: 170x30px)</span></p>
<?php
$options = get_option('fdx3_updater_options');
echo "<p> <input id='upload_image' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_logo_url]' value='{$options['fdx_logo_url']}' /> <input id=\"upload_image_button\" type=\"button\" value=\"Upload\" class=\"button\" /></p>";

?>
</td>
 </tr>
 </tbody>
 </table>

<br />


<table style="width:100%;" class="widefat">
 <thead><tr><th><?php _e('Theme Choices', 'wp-mobile-edition') ?></th> </tr></thead>
<tbody><tr class="alternate">
<td>
<?php
$options = get_option('fdx3_updater_options');

	echo "<p><input id='dark_clean_id' type='radio' name='fdx3_updater_options[dark_clean]' value='dark'";
	if( $options['dark_clean'] == 'dark') { echo " checked='true'"; };
	echo " />&nbsp;".__('Theme Dark', 'wp-mobile-edition')."</p>";

	echo "<p><input id='dark_clean_id' type='radio' name='fdx3_updater_options[dark_clean]' value='clean'";
	if( $options['dark_clean'] == 'clean') { echo " checked='true'"; };
	echo " />&nbsp;".__('Theme Light', 'wp-mobile-edition')."</p>";
 ?>

</td>
</tr><tr class="alternate">
<td>
 <p><strong><?php _e('Secondary Color', 'wp-mobile-edition') ?>:&nbsp;&nbsp;&nbsp; </strong>
<?php
$options = get_option('fdx3_updater_options');

	echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='black'";
	if( $options['fdx_color'] == 'black') { echo " checked='true'"; };
	echo " /><strong style='color: black;margin-left: 5px; margin-right: 10px'>".__('Black', 'wp-mobile-edition')."</strong>";

	echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='blue'";
	if( $options['fdx_color'] == 'blue') { echo " checked='true'"; };
	echo " /><strong style='color: blue;margin-left: 5px; margin-right: 10px'>".__('Blue', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='brown'";
	if( $options['fdx_color'] == 'brown') { echo " checked='true'"; };
	echo " /><strong style='color: brown;margin-left: 5px; margin-right: 10px'>".__('Brown', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='green'";
	if( $options['fdx_color'] == 'green') { echo " checked='true'"; };
	echo " /><strong style='color: green;margin-left: 5px; margin-right: 10px'>".__('Green', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='grey'";
	if( $options['fdx_color'] == 'grey') { echo " checked='true'"; };
	echo " /><strong style='color: grey;margin-left: 5px; margin-right: 10px'>".__('Grey', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='pink'";
	if( $options['fdx_color'] == 'pink') { echo " checked='true'"; };
	echo " /><strong style='color: pink;margin-left: 5px; margin-right: 10px'>".__('Pink', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='red'";
	if( $options['fdx_color'] == 'red') { echo " checked='true'"; };
	echo " /><strong style='color: red;margin-left: 5px; margin-right: 10px'>".__('Red', 'wp-mobile-edition')."</strong>";

    echo "<input id='fdx_color_id' type='radio' name='fdx3_updater_options[fdx_color]' value='teal'";
	if( $options['fdx_color'] == 'teal') { echo " checked='true'"; };
	echo " /><strong style='color: teal;margin-left: 5px; margin-right: 10px'>".__('Teal', 'wp-mobile-edition')."</strong>";

?>
</p>


</td>
 </tr>
 </tbody>
 </table>

  <br />

<table style="width:100%;" class="widefat">
 <thead><tr><th><?php _e('Front page displays', 'wp-mobile-edition') ?></th> </tr></thead>
<tbody><tr class="alternate"><td>

<?php
$options = get_option('fdx3_updater_options');

	echo "<p><input id='fdx-index-home_id' type='radio' name='fdx3_updater_options[fdx_index_home]' value='index'";
	if( $options['fdx_index_home'] == 'index') { echo " checked='true'"; };
	echo " />&nbsp;<strong>".__('Your latest posts', 'wp-mobile-edition')."</strong></p>";

	echo "<p><input id='fdx-index-home_id' type='radio' name='fdx3_updater_options[fdx_index_home]' value='menu'";
	if( $options['fdx_index_home'] == 'menu' ) { echo " checked='true'"; };
	echo " />&nbsp;<a href='". admin_url('nav-menus.php')."'><strong>".__('Custom navigation menus', 'wp-mobile-edition')."</strong></a> <em>(".FDX3_PLUGIN_NAME.")</em></p>";
 ?>
<p><strong><?php _e('Tip', 'wp-mobile-edition') ?>:</strong> <?php _e('Create a blank page named Index (slug = index) and add in your custom menu for show latest posts', 'wp-mobile-edition') ?> </p>



</td>
 </tr>
 </tbody>
 </table>

  <br />

<table style="width:100%;" class="widefat">
 <thead><tr><th><?php _e('Social and Feed', 'wp-mobile-edition') ?></th> </tr></thead>
<tbody><tr class="alternate"><td>
<p><?php _e('Enter your URL if you have one. (include http://)', 'wp-mobile-edition') ?>. <strong><?php _e('Leave blank to disable', 'wp-mobile-edition') ?></strong></p>
<?php
$options = get_option('fdx3_updater_options');
echo "<p> <input id='fdx_feed_url_id' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_feed_url]' value='{$options['fdx_feed_url']}' /> &larr;Feed</p>";
echo "<p> <input id='fdx_twitter_url_id' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_twitter_url]' value='{$options['fdx_twitter_url']}' /> &larr;Twitter</p>";
echo "<p> <input id='fdx_facebook_url_id' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_facebook_url]' value='{$options['fdx_facebook_url']}' /> &larr;Facebook</p>";
echo "<p> <input id='fdx_google_url_id' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_google_url]' value='{$options['fdx_google_url']}' /> &larr;Google plus</p>";
echo "<p> <input id='fdx_ink_url_id' type='text' size='60' maxlength='100' name='fdx3_updater_options[fdx_ink_url]' value='{$options['fdx_ink_url']}' /> &larr;Linkedin</p>";



?>
</td>
 </tr>
 </tbody>
 </table>


  <br />

<table style="width:100%;" class="widefat">
 <thead><tr><th><?php _e('Email Address', 'wp-mobile-edition') ?>:</th> </tr></thead>
<tbody><tr class="alternate"><td>
<p><?php
$options = get_option('fdx3_updater_options');
echo "<input id='fdx_email_contato_id' type='text' size='50' maxlength='100' name='fdx3_updater_options[fdx_email_contato]' value='{$options['fdx_email_contato']}' /> ";
_e('Enter your Email Address to activate your theme\'s contact form.', 'wp-mobile-edition') ?>
</p>



</td>
 </tr>
 </tbody>
 </table>

<!-- ############################################################################################################### -->
</div>
</div>
 <div class="postbox closed">
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Bottom Advertisement', 'wp-mobile-edition') ?></span></h3>
<div class="inside">
<!-- ############################################################################################################### -->
<strong><?php _e('Tip', 'wp-mobile-edition') ?>:</strong> <?php _e('You can enter your Mobile AdSense here or insert your own banner ad code. These boxes accept both javascript & html. We suggest sizing ads either 298x70px or below. ', 'wp-mobile-edition') ?> <strong><?php _e('Leave blank to disable', 'wp-mobile-edition') ?></strong>.
 <div align="center">
<p>
<?php
$options = get_option('fdx3_updater_options');
echo "<textarea id='fdx_text_ads_id' name='fdx3_updater_options[fdx_text_ads]' style='width:70%;height:150px;'/>";
echo $options['fdx_text_ads'];
echo "</textarea>";
?>


</p>
</div>
<!-- ############################################################################################################### -->
</div>
</div>




<div class="postbox closed">
<div class="handlediv" title="<?php _e('Click to toggle', 'wp-mobile-edition') ?>"><br /></div><h3 class='hndle'><span><?php _e('Custom and Tracking code', 'wp-mobile-edition') ?></span></h3>
<div class="inside">
<!-- ############################################################################################################### -->
<strong><?php _e('Tip', 'wp-mobile-edition') ?>:</strong> <?php _e('Enter your Google Analytics or Statcounter code above. This is a handy way of tracking your mobile visitors seperately from your main visitors', 'wp-mobile-edition') ?>. <strong><?php _e('Leave blank to disable', 'wp-mobile-edition') ?></strong>.


<div align="center">
<strong><?php _e('End of', 'wp-mobile-edition') ?> "head"</strong>
<p>
<?php
$options = get_option('fdx3_updater_options');
echo "<textarea id='fdx_text_head_id' name='fdx3_updater_options[fdx_text_head]' style='width:70%;height:150px;'/>";
echo $options['fdx_text_head'];
echo "</textarea>";
?>
</p>
</div>
<br />

<div align="center">
<strong><?php _e('End of', 'wp-mobile-edition') ?> "body"</strong>
<p>
<?php
$options = get_option('fdx3_updater_options');
echo "<textarea id='fdx_text_foot_id' name='fdx3_updater_options[fdx_text_foot]' style='width:70%;height:150px;'/>";
echo $options['fdx_text_foot'];
echo "</textarea>";
?>
</p>
</div>
<!-- ############################################################################################################### -->
</div>
</div>

<div align="center"><input name="Submit" class="button-primary" type="submit" value="<?php _e('Save All Options', 'wp-mobile-edition') ?>" /></div>
</form>
</div> <!-- /postbox-container -->
</div><!-- /meta-box-sortables -->



</div><!-- /post-body -->
</div><!-- /poststuff -->


</div><!-- /wrap -->

<div class="clear"></div>
<?php }
function fdx3_updater_admin_init()
{
register_setting( 'fdx3_updater_options', 'fdx3_updater_options', 'fdx3_updater_options_validate' ); // Settings for WP Twitter
}

function fdx3_updater_options_validate($input)
{
	$options = get_option('fdx3_updater_options');
	if( isset( $input['fdx_email_contato'] ) ) 	{ $options['fdx_email_contato'] = 	$input['fdx_email_contato']; }
    if( isset( $input['fdx_feed_url'] ) ) 	{ $options['fdx_feed_url'] = 	$input['fdx_feed_url']; }
    if( isset( $input['fdx_logo_url'] ) ) 	{ $options['fdx_logo_url'] = 	$input['fdx_logo_url']; }
    if( isset( $input['fdx_twitter_url'] ) ) 	{ $options['fdx_twitter_url'] = 	$input['fdx_twitter_url']; }
    if( isset( $input['fdx_facebook_url'] ) ) 	{ $options['fdx_facebook_url'] = 	$input['fdx_facebook_url']; }
    if( isset( $input['fdx_google_url'] ) ) 	{ $options['fdx_google_url'] = 	$input['fdx_google_url']; }
    if( isset( $input['fdx_ink_url'] ) ) 	{ $options['fdx_ink_url'] = 	$input['fdx_ink_url']; }
   	if( isset( $input['fdx_index_home'] ) ) 		{ $options['fdx_index_home'] = 	$input['fdx_index_home']; }
    if( isset( $input['dark_clean'] ) ) 		{ $options['dark_clean'] = 	$input['dark_clean']; }
    if( isset( $input['fdx_color'] ) ) 		{ $options['fdx_color'] = 	$input['fdx_color']; }
    if( isset( $input['fdx_text_head'] ) ) 		{ $options['fdx_text_head'] = 	$input['fdx_text_head']; }
    if( isset( $input['fdx_text_foot'] ) ) 		{ $options['fdx_text_foot'] = 	$input['fdx_text_foot']; }
    if( isset( $input['fdx_text_ads'] ) ) 		{ $options['fdx_text_ads'] = 	$input['fdx_text_ads']; }

   	return $options;
}
?>