<?php
function wpmp_switcher_login_header($wp_error = '') {
	global $error;


get_header();
echo '<div class="fdx_article_pagination" style="padding-left:7px;">'. __('Login', 'wp-mobile-edition').'</div>';
echo '<div class="fdx_article fdx_page">';


//erro mesages
	if ( $wp_error->get_error_code() ) {
		$errors = '';
		foreach ( $wp_error->get_error_codes() as $code )
   		foreach ( $wp_error->get_error_messages($code) as $error )
                   	$errors .= $error ;

		if ( !empty($errors) )
			echo '<div align="center"><code>' . apply_filters('login_errors', $errors) . "</code></div>\n";
	}
}


$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$errors = new WP_Error();

if ( isset($_GET['key']) )
	$action = 'resetpass';

//----------------------------------------------
$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
switch ($action) {

case 'postpass' :
	if ( empty( $wp_hasher ) ) {
		require_once( ABSPATH . 'wp-includes/class-phpass.php' );
		// By default, use the portable hash from phpass
		$wp_hasher = new PasswordHash(8, true);
	}

	// 10 days
	setcookie( 'wp-postpass_' . COOKIEHASH, $wp_hasher->HashPassword( stripslashes( $_POST['post_password'] ) ), time() + 10 * DAY_IN_SECONDS, COOKIEPATH );

	wp_safe_redirect( wp_get_referer() );
	exit();

break;

case 'logout' :

	wp_logout();

	$redirect_to = 'wp-login.php?loggedout=true';
	if ( isset( $_REQUEST['redirect_to'] ) )
		$redirect_to = $_REQUEST['redirect_to'];

	wp_safe_redirect($redirect_to);
	exit();

break;

case 'lostpassword' :
case 'retrievepassword' :
case 'resetpass' :
case 'rp' :

get_header();
echo '<div class="fdx_article_pagination" style="padding-left:7px;">'. __('Lost Password / Reset Password', 'wp-mobile-edition').'</div>';
echo '<div class="fdx_article fdx_page">';
echo '<p> <blockquote>' . __('This function is disabled in the mobile version, please access the desktop version', 'wp-mobile-edition') . '. <a href="'.wp_login_url( get_permalink() ).'"> <strong>'. __('Login', 'wp-mobile-edition').'</strong></a></blockquote></p>';

break;

case 'register' :

get_header();
echo '<div class="fdx_article_pagination" style="padding-left:7px;">'. __('Register', 'wp-mobile-edition').'</div>';
echo '<div class="fdx_article fdx_page">';
echo '<p> <blockquote>' . __('This function is disabled in the mobile version, please access the desktop version', 'wp-mobile-edition') . '.  <a href="'.wp_login_url( get_permalink() ).'"> <strong>'. __('Login', 'wp-mobile-edition').'</strong></a></blockquote></p>';

break;


case 'login' :
default:

	if ( isset( $_REQUEST['redirect_to'] ) )
		$redirect_to = $_REQUEST['redirect_to'];
	else
		$redirect_to = 'wp-admin/';

	$user = wp_signon();

	if ( !is_wp_error($user) ) {
		if ( !$user->has_cap('edit_posts') && ( empty( $redirect_to ) || $redirect_to == 'wp-admin/' ) )
		$redirect_to = 'wp-admin/'; 
		wp_safe_redirect($redirect_to);
		exit();
	}

	$errors = $user;
	if ( !empty($_GET['loggedout']) )
		$errors = new WP_Error();


	wpmp_switcher_login_header($errors);
?>



<form name="loginform" id="loginform" action="wp-login.php" method="post">
      <fieldset style="width: 160px">
           <legend>	<?php _e('Login', 'wp-mobile-edition') ?></legend>

		<?php _e('Username', 'wp-mobile-edition') ?><br />
		<input type="text" name="log" id="user_login" class="fdx_commentform_input" value="<?php echo esc_attr(stripslashes(@$user_login)); ?>" size="20" tabindex="10" />
           <br />

		<?php _e('Password', 'wp-mobile-edition') ?><br />
		<input type="password" name="pwd" id="user_pass" class="fdx_commentform_input" value="" size="20" tabindex="20" />

<?php do_action('login_form'); ?>
	<br /><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> <em><?php _e('Remember Me', 'wp-mobile-edition'); ?> </em>
	<div align="center" style="margin-top: 5px">
		<input type="submit" name="wp-submit" id="searchsubmit" value="<?php _e('Login', 'wp-mobile-edition'); ?>" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
	</div>
    </fieldset>
</form>

<?php
 break;
}
echo '</div>';
get_footer('2');
?>
