<?php get_header(); ?>
<div class="ot_article_pagination">
<div class="ot_date_link"><?php
$arc_year = get_the_time('Y');
$arc_month = get_the_time('m');
$arc_day = get_the_time('d');
?><a href="<?php echo get_day_link($arc_year, $arc_month, $arc_day); ?>"><?php the_time( get_option('date_format') ); ?></a></div> <?php next_post_link( '%link', '<span class="ot_next">'.__('next', 'fdx-lang').' &rsaquo;</span>' ); ?> <?php previous_post_link( '%link', '<span class="ot_prev">&lsaquo; '.__('prev', 'fdx-lang').'</span>' ); ?>
</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="ot_content ot_page">
<div class="ot_article_intro">

<div class="ot_thumb">
<div class="commentbuble2"><a href="<?php the_permalink(); ?>#comments" title="<?php _e('comments', 'fdx-lang') ?>"><?php $commentscount = get_comments_number(); echo $commentscount; ?></a></div>
<div class="ot_thumb_link"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/spaceball.gif" border="0"  alt="" width="1" height="1"/></a></div>
<div class="ot_thumbimg">  <?php  if ( has_post_thumbnail()) {
                echo the_post_thumbnail('cat-thumb', (array('title' => ''.esc_attr($post->post_title).'')));
                    } ?></div>
<div class="ot_frame"></div>
</div>
<div class="ot_article_heading">
<div class="ot_article_title_text"><?php the_title(); ?></div>
<div class="ot_article_data"><?php the_author_posts_link(); ?>  <?php $category = get_the_category(); if ($category) { echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';}?> </div>
</div>
<div class="ot_clear"></div>
</div>

<div class="ot_article">
<?php the_content();?>
<?php the_tags( '<span class="tags">', '</span><span class="tags">', '</span>'); ?>
<div class="ot_clear"></div>
</div>
<div align="center" style="margin-bottom: 2px; margin-top: 5px">
<?php $prevPost = get_previous_post(); if ($prevPost) { ?>
<a href="<?php $prevPost = get_previous_post(false); $prevURL = get_permalink($prevPost->ID); echo $prevURL; ?>" title="<?php _e('prev', 'fdx-lang') ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/prev.png" width="24" height="24" border="0" alt="&laquo;" /></a>
<?php }
include (TEMPLATEPATH . '/inc/share.php');
$nextPost = get_next_post(); if ($nextPost) { ?>
<a href="<?php $nextPost = get_next_post(false); $nextURL = get_permalink($nextPost->ID); echo $nextURL; ?>" title="<?php _e('next', 'fdx-lang') ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/next.png" width="24" height="24" border="0" alt="&raquo;" /></a>
<?php } ?>
</div>
</div>
<?php if(function_exists('dsq_options')) { ?>
<div class="rack1"></div> 
<div class="ot_comments_respond">Comentarios</div>
<div class="ot_comments_container">
<?php comments_template('',true); ?>
</div>
<?php } else { comments_template('',true); } ?>

<?php endwhile; endif; ?>
<?php get_footer(); ?>