<?php get_header(); ?>

<div class="container pt-3">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>

				<div class="col-6">
					<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail('large', ['class' => 'img-responsive']); ?>
				</div>
				<div class="col-6">
					<?php the_content(); ?>
					<?php 
						$single_website = get_post_meta( get_the_ID(), 'tpt_website', true);
						$single_instagram = get_post_meta( get_the_ID(), 'tpt_instagram', true);

						if( empty(! $single_website ) ) {
							echo '<a href="' . $single_website . '" target="_blank"><i class="fas fa-globe fa-4x"></i></a>';
						} 
						if(! empty( $single_instagram ) ) {
							echo '<a href="' . $single_instagram . '" target="_blank"><i class="fab fa-instagram fa-4x"></i></a>';
						} 
					?>
					<br clear="all">
					<?php edit_post_link(); ?>
					<?php wp_link_pages(); ?>
				</div>
				
			</div>
			<div class="row">
				<?php							
						$postData = get_post_meta( get_the_ID() );	
						$photos_query = $postData['gallery_data'][0];
						
						if($photos_query !== NULL) {
							$photos_array = unserialize($photos_query);
							$url_array = $photos_array['image_url'];
							$count = sizeof($url_array);
							
							for( $procount=0; $procount<$count; $procount++ ){
							?>
							<div class="col-3">
								<a href="<?php echo $url_array[$procount]; ?>" rel="lightbox"><img class="img-responsive gallery-img" src="<?php echo $url_array[$procount]; ?>"/></a>
							</div>
							<?php
								
							}
						}
					?>
			</div><!-- .post-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
			<nav class="navigation index">
				<div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>
				<div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>
			</nav><!--.navigation-->
		<?php else : ?>
	<?php endif; ?>
</div>  

<?php get_footer(); ?>