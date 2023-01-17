<?php
get_header();
get_template_part( 'template-parts/banner/content', 'banner-shop' ); 

$shop_sidebar = autrics_option('shop_sidebar',3); 
$column = ($shop_sidebar == 1 ) || !is_active_sidebar('sidebar-woo') == true && !is_product() ? 'col-md-12 mx-auto' : 'col-lg-8 col-md-12';

if ( is_single() ){ 
	$column = 'col-md-12';
}

?>
<div class="woo-xs-content">
	<div class="container">
		<div class="row">
			<?php if(($shop_sidebar == 2) && is_shop() ){
				get_sidebar('woo');
			  }  ?>
			<div id="content" class="<?php echo esc_attr($column);  ?>">
				<div class="main-content-inner wooshop clearfix">
					<?php if ( have_posts() ) : ?>
						<?php woocommerce_content(); ?>
					<?php endif; ?>
				</div> <!-- close .col-sm-12 -->
			</div><!--/.row -->
			<?php if(($shop_sidebar == 3) && is_shop() ){
				get_sidebar('woo');
			  }  ?>
		</div><!--/.row -->
	</div><!--/.row -->
</div><!--/.row -->


<?php get_footer(); ?>