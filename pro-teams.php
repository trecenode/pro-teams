<?php
/**
 * Plugin Name: Pro Teams
 * Plugin URI:  https://13node.com/informatica/wordpress/pro-teams-plugin/
 * Description: Show your team members on your page.
 * Version: 1.1
 * Author: Danilo Ulloa
 * Author URI: https://13node.com
 * Text Domain: pro-teams
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'PROTEAMS_TEXT_DOMAIN' ) ) {
	define( 'PROTEAMS_TEXT_DOMAIN', 'pro-teams' );
}

// Add custom CSS
function trece_proteams_css() {
    wp_enqueue_style( 'proteamscss', plugins_url('css/style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'trece_proteams_css' );

/**
 * Add Pro Teams Post Type
 */
function proteams_init() {
    $args = array(
      'label' => 'Pro Team',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'proteam'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-users',
        'has_archive'  => true,
        'supports' => array(
            'title',
            'editor',
            'revisions',
            'thumbnail',
            'gallery')
        );
    register_post_type( 'proteams', $args );
}

add_action( 'init', 'proteams_init' );

// No Pagination
function tpt_portfolio_post_type( $query ) {
    if ( is_post_type_archive( 'proteams' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'tpt_portfolio_post_type', 1 );


/**
 * Register meta boxes.
 */
function tpt_register_meta_boxes() {
    add_meta_box( 'tpt-1', __( 'Details', 'pro-teams' ), 'tpt_display_callback', 'proteams' );
}
add_action( 'add_meta_boxes', 'tpt_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function tpt_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './addSingle.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function tpt_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
		'tpt_website',
        'tpt_instagram',
        'tpt_facebook',
		'tpt_twitter',
		'tpt_linkedin',
		'tpt_youtube',
		'tpt_behance',
		'tpt_deviantart',
		
		'tpt_tattooya',
		'tpt_xarcoal'
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'tpt_save_meta_box' );

/**
 * Add Pro Teams Gallery
 */
function proteam_gallery_add_metabox(){
	add_meta_box(
		'post_custom_gallery',
		__('Gallery', 'pro-teams'),
		'proteam_gallery_metabox_callback',
		'proteams',
		'normal',
		'core'
	);
}
add_action( 'admin_init', 'proteam_gallery_add_metabox' );

function proteam_gallery_metabox_callback(){
	wp_nonce_field( basename(__FILE__), 'sample_nonce' );
	global $post;
	$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
	?>
	<div id="gallery_wrapper">
		<div id="img_box_container">
		<?php 
		if ( isset( $gallery_data['image_url'] ) ){
			for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
			?>
			<div class="gallery_single_row dolu">
			  <div class="gallery_area image_container ">
				<img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
				<input type="hidden"
						 class="meta_image_url"
						 name="gallery[image_url][]"
						 value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
				  />
			  </div>
			  <div class="gallery_area">
				<span class="button remove" onclick="remove_img(this)" title="<?php __('Remove', 'pro-teams') ?>"/><i class="fas fa-trash-alt"></i></span>
			  </div>
			  <div class="clear" />
			</div> 
			</div>
			<?php
			}
		}
		?>
		</div>
		<div style="display:none" id="master_box">
			<div class="gallery_single_row">
				<div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
					<input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]" />
				</div> 
				<div class="gallery_area"> 
					<span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="add_gallery_single_row">
		  <input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();" title="Add image"/>
		</div>
	</div>
	<?php
}

function proteam_gallery_styles_scripts(){
    global $post;
    if( 'proteams' != $post->post_type )
        return;
    ?>  
    <style type="text/css">
	.gallery_area {
		float:right;
	}
	.image_container {
		float:left!important;
		width: 100px;
		background: url(<?php plugins_url( 'images/noimage.png', __FILE__ ); ?>);
		height: 100px;
		background-repeat: no-repeat;
		background-size: cover;
		border-radius: 3px;
		cursor: pointer;
	}
	.image_container img{
		height: 100px;
		width: 100px;
		border-radius: 3px;
	}
	.clear {
		clear:both;
	}
	#gallery_wrapper {
		width: 100%;
		height: auto;
		position: relative;
		display: inline-block;
	}
	#gallery_wrapper input[type=text] {
		width:300px;
	}
	#gallery_wrapper .gallery_single_row {
		float: left;
		display:inline-block;
		width: 100px;
		position: relative;
		margin-right: 8px;
		margin-bottom: 20px;
	}
	.dolu {
		display: inline-block!important;
	}
	#gallery_wrapper label {
		padding:0 6px;
	}
	.button.remove {
		background: none;
		color: #f1f1f1;
		position: absolute;
		border: none;
		top: 4px;
		right: 7px;
		font-size: 1.2em;
		padding: 0px;
		box-shadow: none;
	}
	.button.remove:hover {
		background: none;
		color: #fff;
	}
	.button.add {
		background: #c3c2c2;
		color: #ffffff;
		border: none;
		box-shadow: none;
		width: 100px;
		height: 100px;
		line-height: 100px;
		font-size: 4em;
	}
	.button.add:hover, .button.add:focus {
		background: #e2e2e2;
		box-shadow: none;
		color: #0f88c1;
		border: none;
	}
    </style>
    <script type="text/javascript">
        function remove_img(value) {
            var parent=jQuery(value).parent().parent();
            parent.remove();
        }
	var media_uploader = null;
	function open_media_uploader_image(obj){
		media_uploader = wp.media({
			frame:    "post", 
			state:    "insert", 
			multiple: false
		});
		media_uploader.on("insert", function(){
			var json = media_uploader.state().get("selection").first().toJSON();
			var image_url = json.url;
			var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
			console.log(image_url);
			jQuery(obj).append(html);
			jQuery(obj).find('.meta_image_url').val(image_url);
		});
		media_uploader.open();
	}
	function open_media_uploader_image_this(obj){
		media_uploader = wp.media({
			frame:    "post", 
			state:    "insert", 
			multiple: false
		});
		media_uploader.on("insert", function(){
			var json = media_uploader.state().get("selection").first().toJSON();
			var image_url = json.url;
			console.log(image_url);
			jQuery(obj).attr('src',image_url);
			jQuery(obj).siblings('.meta_image_url').val(image_url);
		});
		media_uploader.open();
	}

	function open_media_uploader_image_plus(){
		media_uploader = wp.media({
			frame:    "post", 
			state:    "insert", 
			multiple: true 
		});
		media_uploader.on("insert", function(){

			var length = media_uploader.state().get("selection").length;
			var images = media_uploader.state().get("selection").models

			for(var i = 0; i < length; i++){
				var image_url = images[i].changed.url;
				var box = jQuery('#master_box').html();
				jQuery(box).appendTo('#img_box_container');
				var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
				var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
				element.append(html);
				element.find('.meta_image_url').val(image_url);
				console.log(image_url);		
			}
		});
		media_uploader.open();
	}
	jQuery(function() {
            jQuery("#img_box_container").sortable();
        });
    </script>
    <?php
}
add_action( 'admin_head-post.php', 'proteam_gallery_styles_scripts' );
add_action( 'admin_head-post-new.php', 'proteam_gallery_styles_scripts' );

function proteam_gallery_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'sample_nonce' ] ) && wp_verify_nonce( $_POST[ 'sample_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Correct post type
	if ( 'proteams' != $_POST['post_type'] )
		return;

	if ( $_POST['gallery'] ){
	
		$gallery_data = array();
		for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ){
			if ( '' != $_POST['gallery']['image_url'][$i]){
				$gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
			}
		}

		if ( $gallery_data ) 
			update_post_meta( $post_id, 'gallery_data', $gallery_data );
		else 
			delete_post_meta( $post_id, 'gallery_data' );
	} 
	else{
		delete_post_meta( $post_id, 'gallery_data' );
	}
}
add_action( 'save_post', 'proteam_gallery_save' );

// Add Template Files
add_filter( 'template_include', 'proteams_templates', 1 );
function proteams_templates( $template ) {

    $post_type = 'proteams';

    if ( is_post_type_archive( $post_type ) && file_exists( plugin_dir_path(__FILE__) . "templates/archive-".$post_type.".php" ) ){
        $template = plugin_dir_path(__FILE__) . "templates/archive-".$post_type.".php";
    }

    if ( is_singular( $post_type ) && file_exists( plugin_dir_path(__FILE__) . "templates/single-".$post_type.".php" ) ){
        $template = plugin_dir_path(__FILE__) . "templates/single-".$post_type.".php";
    }

    return $template;
}