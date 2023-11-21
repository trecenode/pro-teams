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
						$single_facebook = get_post_meta( get_the_ID(), 'tpt_facebook', true);
						$single_twitter = get_post_meta( get_the_ID(), 'tpt_twitter', true);
						$single_linkedin = get_post_meta( get_the_ID(), 'tpt_linkedin', true);
						$single_youtube = get_post_meta( get_the_ID(), 'tpt_youtube', true);
						$single_behance = get_post_meta( get_the_ID(), 'tpt_behance', true);
						$single_deviantart = get_post_meta( get_the_ID(), 'tpt_deviantart', true);
						
						$single_tattooya = get_post_meta( get_the_ID(), 'tpt_tattooya', true);
						$single_xarcoal = get_post_meta( get_the_ID(), 'tpt_xarcoal', true);

						if( empty(! $single_website ) ) {
							echo '<a href="' . $single_website . '" target="_blank"><i class="fas fa-globe fa-4x"></i></a>';
						} 
						if(! empty( $single_instagram ) ) {
							echo '<a href="' . $single_instagram . '" target="_blank"><i class="fab fa-instagram fa-4x"></i></a>';
						} 
						if(! empty( $single_facebook ) ) {
							echo '<a href="' . $single_facebook . '" target="_blank"><i class="fab fa-facebook fa-4x"></i></a>';
						}
						if(! empty( $single_twitter ) ) {
							echo '<a href="' . $single_twitter . '" target="_blank"><i class="fab fa-twitter fa-4x"></i></a>';
						}
						if(! empty( $single_linkedin ) ) {
							echo '<a href="' . $single_linkedin . '" target="_blank"><i class="fab fa-linkedin fa-4x"></i></a>';
						}
						if(! empty( $single_youtube ) ) {
							echo '<a href="' . $single_youtube . '" target="_blank"><i class="fab fa-youtube fa-4x"></i></a>';
						}
						if(! empty( $single_behance ) ) {
							echo '<a href="' . $single_behance . '" target="_blank"><i class="fab fa-behance fa-4x"></i></a>';
						}
						if(! empty( $single_deviantart ) ) {
							echo '<a href="' . $single_deviantart . '" target="_blank"><i class="fab fa-deviantart fa-4x"></i></a>';
						}
						// Custom Icons
						if(! empty( $single_tattooya ) ) {
							echo '<a href="' . $single_tattooya . '" target="_blank">'.plugins_url( 'images/tattooya.png', __FILE__ ).'</a>';
						}
						if(! empty( $single_xarcoal ) ) {
							echo '<a href="' . $single_xarcoal . '" target="_blank">'.plugins_url( 'images/xarcoal.png', __FILE__ ).'</a>';
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