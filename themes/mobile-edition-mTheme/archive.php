<?php get_header(); ?>
<div class="ot_topheading"><?php  if (is_home()){ ?>Home <?php } else {  fdx_body_result_text();  } ?> </div>

<div class="ot_content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
if ('ot_odd' == @$odd_or_even){
  $odd_or_even = 'ot_even';
}else{
  $odd_or_even = 'ot_odd';
}
?>
<!-- Start posts -->

<div id="post-<?php the_ID(); ?>" class="ot_snippet <?php echo $odd_or_even; ?>" >
<div class="ot_thumb">
<div class="commentbuble2"><a href="<?php the_permalink(); ?>#comments" title="<?php _e('comments', 'fdx-lang') ?>"><?php $commentscount = get_comments_number(); echo $commentscount; ?></a></div>
<div class="ot_thumb_link"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/spaceball.gif" border="0" alt="" width="1" height="1" /></a></div>
<div class="ot_thumbimg">  <?php  if ( has_post_thumbnail()) {
                echo the_post_thumbnail('cat-thumb', (array('title' => ''.esc_attr($post->post_title).'')));
                    } ?></div>
<div class="ot_frame"></div>
</div>
<div class="ot_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
<div class="ot_more"> <a href="<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/spaceball.gif" border="0" alt="" width="1" height="1" /></a></div>
</div>
<!--  end posts -->

 <?php endwhile;endif; ?>

          </div><!-- ot_content -->

<?php get_footer(); ?>