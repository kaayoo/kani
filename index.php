<?php $options = get_desing_plus_option(); if (!is_paged()): get_header(); ?>

<div id="main_col">

<!-- 検索エンジン -->

<?php /* ?>
	<?php if( function_exists('create_searchform') ){ ?>	
		<h3 class="headline1" style="padding-top:15px;"><span>絞り込み検索</span></h3>
		<div id="feas-0">
			<div id="feas-form-0">
				<?php create_searchform(); ?>
			</div>
			
			<div id="feas-result-0">
				<?php if( is_search() ){ ?>
					<?php if( $add_where != null || $w_keyword != null ){ ?>
						<?php search_result(); ?>」の条件による検索結果 <?php echo $wp_query->found_posts; ?> 件
					<?php }else{ ?>
						<div class = "search_result_text">検索条件が指定されていません。</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
<?php */ ?>	

 <!-- index news -->
 <?php if ($options['show_index_news']) { ?>
 <div id="index_news">
  <h3 class="headline1"><span><?php echo $options['index_headline_news']; ?></span></h3>
  <ol class="clearfix">
   <?php
        $args = array('post_type' => 'news', 'numberposts' => 6);
        $news_post=get_posts($args);
        if ($news_post) :
        foreach ($news_post as $post) : setup_postdata ($post);
   ?>
   <li class="clearfix">
    <p class="date"><?php the_time('Y/n/j'); ?></p>
    <p class="title"><a href="<?php the_permalink() ?>"><?php trim_title(50); ?></a></p>
   </li>
   <?php endforeach; else: ?>
   <li class="no_post"><p><?php _e("There is no registered news.","tcd-w"); ?></p></li>
   <?php endif; ?>
  </ol>
  <?php if ($options['show_index_news_link']) { ?><div class="index_archive_link"><a href="<?php echo get_post_type_archive_link('news'); ?>"><?php _e("Older News","tcd-w"); ?></a></div><?php }; ?>
 </div><!-- END #index_news -->
 <?php }; ?>


 <!-- center banner -->
 <?php if (!empty($options['index_center_banner_image'])) { ?>
 <a id="index_center_banner" href="<?php echo $options['index_center_banner_url']; ?>"<?php if ($options['index_center_banner_target']){ echo ' target="_blank"'; }; ?>><img src="<?php esc_attr_e( $options['index_center_banner_image'] ); ?>" alt="" /></a>
 <?php }; ?>


 <!-- product list -->
 <?php
      if ($options['show_index_product']) {
      $args = array('post_type' => 'product', 'numberposts' => 12);
      $product_post=get_posts($args);
      if ($product_post) {
 ?>
 <div id="index_product">
  <h3 class="headline1"><span><?php echo $options['index_headline_product']; ?></span></h3>
  <ol class="clearfix">
   <?php
        $i = 1;
        foreach ($product_post as $post) : setup_postdata ($post);
        $custom_fields = get_post_custom($post->ID);
        $value1 = get_post_meta($post->ID, 'product_image1', true);
        $image1 = wp_get_attachment_image_src($value1, 'size3');
        $product_desc = $custom_fields['product_description'][0];
   ?>
   <li class="num<?php echo $i; ?>">
    <a class="image" href="<?php the_permalink() ?>"><?php if (!empty($custom_fields['product_image1'][0])) { ?><img src="<?php echo $image1[0]; ?>" alt="" title="" /><?php } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.gif" alt="" title="" />'; }; ?></a>
    <?php echo get_the_term_list( $post->ID, 'product-cat', '<div class="category">', ', ', '</div>' ); ?>
    <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
    <?php if (!empty($custom_fields['product_description'][0])) { ?><p class="desc"><?php echo $product_desc ; ?></p><?php }; ?>
   </li>
   <?php $i++; endforeach; wp_reset_query(); ?>
  </ol>
  <?php if ($options['show_index_product_link']) { ?><div class="index_archive_link"><a href="<?php echo get_post_type_archive_link('product'); ?>"><?php _e("More Products","tcd-w"); ?></a></div><?php }; ?>
 </div><!-- END #index_product -->
 <?php }; }; ?>


 <!-- blog list -->
 <?php if ($options['show_index_blog']) { ?>
 <div id="index_blog">
  <h3 class="headline1"><span><?php echo $options['index_headline_blog']; ?></span></h3>
  <ol class="clearfix">
   <?php
        $args = array('post_type' => 'post', 'numberposts' => 6);
        $index_recent_post=get_posts($args);
        if ($index_recent_post) :
        foreach ($index_recent_post as $post) : setup_postdata ($post);
   ?>
   <li class="clearfix">
    <?php if ($options['show_thumbnail'] and has_post_thumbnail()) { ?><a class="image" href="<?php the_permalink() ?>"><?php echo the_post_thumbnail('size1'); ?></a><?php }; ?>
    <div class="info">
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y.m.d'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
    </div>
   </li>
   <?php endforeach; else: ?>
   <li class="no_post"><p><?php _e("There is no registered post.","tcd-w"); ?></p></li>
   <?php endif; ?>
  </ol>
  <?php if ($options['show_index_blog_link']) { ?><div class="index_archive_link"><?php next_posts_link(__('Older Entries', 'tcd-w')) ?></div><?php }; ?>
 </div><!-- END #index_blog -->
 <?php }; ?>

 <?php include('footer_banner.php'); ?>

</div><!-- END #main_col -->


<?php get_sidebar(); ?>

<?php get_footer(); else: include('archive.php'); endif; ?>
