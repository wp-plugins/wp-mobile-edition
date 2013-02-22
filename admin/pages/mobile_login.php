<?php
function wpmp_switcher_login_header($wp_error = '') {
	global $error;


get_header();
echo '<div class="ot_article_pagination" style="padding-left:7px;">'. __('Login', 'fdx-lang').'</div>';
echo '<div class="ot_article ot_page">';


//erro mesages
	if ( $wp_error->get_error_code() ) {
		$errors = '';
		foreach ( $wp_error->get_error_codes() as $code )
   		foreach ( $wp_error->get_error_messages($code) as $error )
                   	$errors .= $error ;

		if ( !empty($errors) )
			echo '<code>' . apply_filters('login_errors', $errors) . "</code>\n";
	}
}


$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$errors = new WP_Error();

if ( isset($_GET['key']) )
	$action = 'resetpass';

//----------------------------------------------
$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
switch ($action) {

case 'logout' :

	wp_logout();

	$redirect_to = 'wp-login.php?loggedout=true';
	if ( isset( $_REQUEST['redirect_to'] ) )
		$redirect_to = $_REQUEST['redirect_to'];

	wp_safe_redirect($redirect_to);
	exit();

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

	<p>
		<label><?php _e('Username', 'fdx-lang') ?><br />
		<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr(stripslashes(@$user_login)); ?>" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label><?php _e('Password', 'fdx-lang') ?><br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
	</p>
<?php do_action('login_form'); ?>
	<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> <?php _e('Remember Me', 'fdx-lang'); ?></label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="searchsubmit" value="<?php _e('Login', 'fdx-lang'); ?>" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
	</p>

</form>

<?php
 break;
}
echo '</div>';
get_footer('2');
?>
