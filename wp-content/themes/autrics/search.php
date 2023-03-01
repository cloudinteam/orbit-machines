<?php
/**
 * the template for displaying search result
 */
   get_header(); 
   get_template_part( 'template-parts/banner/content', 'banner-blog' );

   $blog_sidebar = autrics_option('blog_sidebar',3); 
   $column = ($blog_sidebar == 1 ) || !is_active_sidebar('sidebar-1') ? 'col-md-8 mx-auto' : 'col-lg-8 col-md-12';
?>

<section id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
	   <?php if($blog_sidebar == 2){
				get_sidebar();
			  }  ?>
            <div class="<?php echo esc_attr($column);?>">
				<?php if ( have_posts() ) : ?>
					<div class="xs-page-header">
                        <h2>
						    <?php printf(esc_html__('Search Results for: %s', 'autrics'), get_search_query()); ?>
                        </h2>
                        <?php
                            // show author bio if exists
                            if (get_the_author_meta('description')) {
                                echo '<p>' . the_author_meta('description') . '</p>';
                            }
                        ?>
					</div>

					<?php while ( have_posts() ) : the_post(); ?>
						<?php //get_template_part( 'template-parts/blog/contents/content', get_post_format() ); ?>
						<div class="card post">

							<div class="row mx-0 align-items-stretch"> <!-- align-items-center  -->
								<?php if(has_post_thumbnail()): ?>  
									<div class="col-md-4 col-sm-5">
										<div class="post-media post-image">
											<a href="<?php echo esc_url(get_the_permalink()); ?>">
											<img class="img-fluid " src="<?php echo get_the_post_thumbnail_url(); ?>" alt=" <?php the_title(); ?>">
											</a>
											<?php 
												// $date_style = autrics_option('blog_date_style','classic');
												// if ( $date_style == "creative" ) :
												//       autrics_post_meta_date();
												// endif;
											?>
										</div>
									</div>
								<?php endif; ?>
															
								<div class="col-md-8 col-sm-7">
									<div class="post-body clearfix">
										<div class="entry-header">
											<?php autrics_post_meta(); ?>
										</div>
										<h2 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										<?php if ( is_sticky() ) {
											echo '<sup class="meta-featured-post"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Sticky', 'autrics' ) . ' </sup>';
												}
										?>
										<div class="post-content">
											<div class="entry-content">
											<?php //autrics_excerpt( 40, null ); ?>
											<?php autrics_excerpt( 15, null ); ?>
											</div>
											<?php
											if(!is_single()):
												printf('<div class="post-footer readmore-btn-area"><a class="readmore" href="%1$s">Continue <i class="icon icon-arrow-right"></i></a></div>',
												get_the_permalink());
											endif; 
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>

					<?php get_template_part( 'template-parts/blog/paginations/pagination', 'style1' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/blog/contents/content', 'none' ); ?>
				<?php endif; ?>
			</div><!-- .col-md-8 -->

         <?php if($blog_sidebar == 3){
				get_sidebar();
			  }  ?>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- #main-content -->

<?php get_footer(); ?>