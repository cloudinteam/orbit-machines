<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>
   
 <article <?php post_class();?>>
	<div class="post">
      <?php get_template_part( 'template-parts/blog/contents/format/standard', get_post_format() ); ?>       
   </div>
</article>