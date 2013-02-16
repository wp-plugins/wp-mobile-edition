<?php get_header(); ?>
<div class="ot_article_pagination">
<?php previous_post_link( '%link', '<span class="ot_prev">&lsaquo; '.__('return', 'fdx-lang').'</span>' ); ?>	<div class="ot_date_link"><?php the_time('j/m/y'); ?></div>
<div class="ot_clear"></div>
</div>
<div class="ot_article_data"><?php the_title(); ?></div>
<div class="ot_content ot_page">
<div class="ot_article">
<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
</div>
<div class="ot_clear"></div>
<div align="center" style="margin-bottom: 2px; margin-top: 5px">
<?php
previous_image_link(false, '<span class="icoprev"></span>'); ?>
<?php include (TEMPLATEPATH . '/inc/share.php'); ?>
<?php next_image_link(false, '<span class="iconext"></span>'); ?>
</div>
</div>
<?php get_footer(); ?>