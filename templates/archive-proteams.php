<?php get_header(); ?>
<div class="container pt-3">
    <div class="row">

	<?php if ( have_posts() ) : ?>
		<?php $procount=0; while ( have_posts() ) : the_post(); $procount++; ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('col-4 py-3'); ?>>
                
                <div class="text-center">
                <a href="<?php echo get_permalink(); ?>" class="item-backdrop">   
                    <?php  if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail('medium', ['class' => 'img-responsive aligncenter zoom']); ?>
                    <?php the_title( '' ); ?>
                </a>
                </div>

			</div><!-- .post-->
		<?php if($procount%3==0) {echo '</div><div class="row">';} 
			  endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php else : ?>
	<?php endif; ?>

	</div>
</div>  
<?php get_footer(); ?>