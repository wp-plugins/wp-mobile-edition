<?php get_header(); ?>
<div class="ot_topheading"><?php _e('Index', 'fdx-lang') ?></div>

<div class="ot_content">

 <?php if (have_posts()) : ?>

 <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
       query_posts('post_type=post&posts_per_page=5&paged=' . $paged);
        while (have_posts()) : the_post(); ?>

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
<div class="ot_thumb_link"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/spaceball.gif"  alt="" border="0" width="1" height="1" /></a></div>
<div class="ot_thumbimg">  <?php  if ( has_post_thumbnail()) {
                echo the_post_thumbnail('cat-thumb', (array('title' => ''.esc_attr($post->post_title).'')));
                    } ?></div>
<div class="ot_frame"></div>
</div>
<div class="ot_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
<div class="ot_more"> <a href="<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/spaceball.gif"  alt="" border="0" width="1" height="1" /></a></div>
</div>
<!--  end posts -->

 <?php endwhile;endif; ?>


          </div><!-- ot_content -->

<?php get_footer(); ?>