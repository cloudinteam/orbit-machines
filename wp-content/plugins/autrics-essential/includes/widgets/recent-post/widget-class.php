<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * recent post widget
 */
class Autrics_Recent_Post extends WP_Widget {

	function __construct() {

		$widget_opt = array(
			'classname'		 => 'recent-post-widget',
			'description'	 => esc_html__('Recent post with thumbnail','autrics')
		);

		parent::__construct( 'xs-recent-post', esc_html__( 'Autrics recent post', 'autrics' ), $widget_opt );
	}

	function widget( $args, $instance ) {

		global $wp_query;

		echo autrics_return($args[ 'before_widget' ]);

		if ( !empty( $instance[ 'title' ] ) ) {

			echo autrics_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . autrics_return($args[ 'after_title' ]);
		}

		if ( !empty( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}


		$query = array(
			'post_type'		 => array( 'post' ),
			'post_status'	 => array( 'publish' ),
			'orderby'		 => 'date',
			'order'			 => 'DESC',
			'posts_per_page' => $no_of_post
		);  

		$loop = new WP_Query( $query );
		?>
		<div class="widget-posts">
			<?php
			if ( $loop->have_posts() ):
				while ( $loop->have_posts() ):
					$loop->the_post();
					?>
					<div class="widget-post media">
						<?php if(has_post_thumbnail()) : ?> 
							<a href="<?php the_permalink();?>"><?php echo get_the_post_thumbnail( get_the_ID(), array(80, 70) ); ?></a>
						<?php endif; ?>
						<div class="media-body">
							<span class="post-meta-date"> 
								<?php echo get_the_time( 'd M, Y' ); ?>
							</span>
							<h4 class="entry-title">
								<a href="<?php echo get_the_permalink(); ?>" ><?php echo get_the_title();?></a>
							</h4>
						</div>
					</div>

				<?php endwhile; ?>
			<?php else: ?>
				<div class="nopost_message">
					<p><?php echo esc_html__( 'No post available', 'autrics' ) ?></p>
				</div>
			<?php endif; ?>  
			</div>
		<?php
		wp_reset_postdata();
		echo autrics_return($args[ 'after_widget' ]);
	}

	function update( $new_instance, $old_instance ) {

		$old_instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$old_instance[ 'number_of_posts' ] = $new_instance[ 'number_of_posts' ];

		return $old_instance;
	}

	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'Recent posts', 'autrics' );
		}
		if ( isset( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'autrics' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'autrics' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>" />
		</p>
		<?php
	}

}
