<?php
  function fdx_mobile_admin() {
    $base = get_option('home');

    if (($user = wp_get_current_user())==null || $user->ID==0) {
      header("Location: $base/wp-login.php");
    }


get_header();
if(current_user_can('manage_options')) {
//-------------------------------------------------------------------
    $base = get_option('home');
    $base = get_option('home');
    global $current_user;
    get_currentuserinfo();
    echo '<div class="fdx_article_pagination" style="padding-left:7px;"><a href="'.$base.'/">' . __('Return to the site', 'wp-mobile-edition') . '</a><span class="fdx_next"><a href="'. wp_logout_url( get_permalink() ) .'">' . __('Logout', 'wp-mobile-edition') . '</a></span></div>';
    echo '<div class="fdx_article fdx_page">';
    echo '<div align="center">' . get_avatar(get_the_author_meta(), 96) . '</div>';
    echo '<blockquote>'.__('Display name', 'wp-mobile-edition') . ': <strong>' . $current_user->display_name . '</strong><br />';
    echo __('Email', 'wp-mobile-edition') . ': <strong>' . $current_user->user_email . '</strong><br />';
    echo __('First name', 'wp-mobile-edition') . ': <strong>' . $current_user->user_firstname . '</strong><br />';
    echo __('Last name', 'wp-mobile-edition') . ': <strong>' . $current_user->user_lastname . '</strong><br />';
    echo __('Username', 'wp-mobile-edition') . ': <strong>' . $current_user->user_login . '</strong><br />';
    echo __('User ID', 'wp-mobile-edition') . ': <strong>' . $current_user->ID . '</strong></blockquote>';
    echo '<p>' . __('To access the full control panel, please access the Desktop version. Or, to access a panel mobile version, install the Official App.', 'wp-mobile-edition');
    echo ' (<a href="http://wordpress.org/extend/mobile/">Mobile Apps</a>)</p>';
//-------------------------------------------------------------------
    } else {
//-------------------------------------------------------------------
    $base = get_option('home');
    global $current_user;
    get_currentuserinfo();
    echo '<div class="fdx_article_pagination" style="padding-left:7px;"><a href="'.$base.'/">' . __('Return to the site', 'wp-mobile-edition') . '</a><span class="fdx_next"><a href="'. wp_logout_url( get_permalink() ) .'">' . __('Logout', 'wp-mobile-edition') . '</a></span></div>';
    echo '<div class="fdx_article fdx_page">';
    echo '<div align="center">' . get_avatar(get_the_author_meta(), 96) . '</div>';
    echo '<blockquote>'.__('Display name', 'wp-mobile-edition') . ': <strong>' . $current_user->display_name . '</strong><br />';
    echo __('Email', 'wp-mobile-edition') . ': <strong>' . $current_user->user_email . '</strong><br />';
    echo __('First name', 'wp-mobile-edition') . ': <strong>' . $current_user->user_firstname . '</strong><br />';
    echo __('Last name', 'wp-mobile-edition') . ': <strong>' . $current_user->user_lastname . '</strong><br />';
    echo __('Username', 'wp-mobile-edition') . ': <strong>' . $current_user->user_login . '</strong><br />';
    echo __('User ID', 'wp-mobile-edition') . ': <strong>' . $current_user->ID . '</strong></blockquote>';
    echo '<p>' . __('To view and edit your complete profile, please access the desktop version', 'wp-mobile-edition') . '</p>';
//-------------------------------------------------------------------
    }

  echo '</div>';
  get_footer('2');
  }

  fdx_mobile_admin();

?>
