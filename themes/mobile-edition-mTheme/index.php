<?php get_header(); ?>
<div class="ot_topheading"><?php  if (is_home()){ ?>Home <?php } else {  fdx_body_result_text();  } ?> </div>
<?php
$options = get_option('fdx3_updater_options');
if ( $options['fdx_index_home'] == "index" ) {
include('inc-blog.php');
} else {
include('inc-menu.php');
}
?>
<?php get_footer(); ?>