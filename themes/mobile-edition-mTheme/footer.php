<div class="ot_postfooter">
<div class="ot_top_arrow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/top_arrow.png" alt=""/></div>
<?php previous_posts_link( __( '<span class="ot_prev">&lsaquo; '.__('prev', 'fdx-lang').'</span>') ); next_posts_link( __( '<span class="ot_next">'.__('next', 'fdx-lang').' &rsaquo;</span>') ); ?> <div class="ot_top"><span class="ot_topicon"><a class="backToTop" href="#top"><?php _e('top', 'fdx-lang') ?></a></span></div>
</div>
<div class="ot_clear"></div>
<?php
$options = get_option('fdx3_updater_options');
if ( $options['fdx_text_ads'] <> "" ) {
echo "<div align='center'> \n";
echo stripslashes($options['fdx_text_ads']) . "\n";
echo "</div> \n";
}
?>
<div class="ot_switch">
<div class="ot_switch_text"><?php _e('Mobile Version', 'fdx-lang') ?> | <a href="<?php echo FDX_SITEURL.$_SERVER['REQUEST_URI'].'?switch=0'; ?>"><?php _e('Desktop Version', 'fdx-lang') ?></a></div>
<div class="ot_switch_checkbox"></div>
<div class="ot_clear"></div>
</div>

<div class="ot_footer"><div class="ot_copyright"><a href="<?php echo FDX3_PLUGINPAGE; ?>"><img src="<?php echo get_template_directory_uri();?>/images/menu_fdx.png" width="16" height="16" border="0" alt="" /></a></div>
</div>
</div>



<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/total_script.js" charset="utf-8"></script> 
<?php
$options = get_option('fdx3_updater_options');
if ( $options['fdx_text_foot'] <> "" ) {
echo stripslashes($options['fdx_text_foot']) . "\n";
}
?>
</body>
</html>
