<div class="tpt_box">
    <style scoped>
        .tpt_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .tpt_field{
            display: contents;
        }
    </style>
    <p class="meta-options tpt_field">
        <label for="tpt_website"><?php __('Website', 'pro-teams') ?></label>
        <input id="tpt_website"
            type="text"
            name="tpt_website"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_website', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_instagram"><?php __('Instagram', 'pro-teams') ?></label>
        <input id="tpt_instagram"
            type="text"
            name="tpt_instagram"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_instagram', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_facebook"><?php __('Facebook', 'pro-teams') ?></label>
        <input id="tpt_facebook"
            type="text"
            name="tpt_facebook"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_facebook', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_twitter"><?php __('Twitter (X)', 'pro-teams') ?></label>
        <input id="tpt_twitter"
            type="text"
            name="tpt_twitter"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_twitter', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_linkedin"><?php __('LinkedIn', 'pro-teams') ?></label>
        <input id="tpt_linkedin"
            type="text"
            name="tpt_linkedin"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_linkedin', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_youtube"><?php __('YouTube', 'pro-teams') ?></label>
        <input id="tpt_youtube"
            type="text"
            name="tpt_youtube"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_youtube', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_behance"><?php __('Behance', 'pro-teams') ?></label>
        <input id="tpt_behance"
            type="text"
            name="tpt_behance"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_behance', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_deviantart"><?php __('DeviantArt', 'pro-teams') ?></label>
        <input id="tpt_deviantart"
            type="text"
            name="tpt_deviantart"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_deviantart', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_tattooya"><?php __('TattooYa', 'pro-teams') ?></label>
        <input id="tpt_tattooya"
            type="text"
            name="tpt_tattooya"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_tattooya', true ) ); ?>">
    </p>
    <p class="meta-options tpt_field">
        <label for="tpt_xarcoal"><?php __('Xarcoal', 'pro-teams') ?></label>
        <input id="tpt_xarcoal"
            type="text"
            name="tpt_xarcoal"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'tpt_xarcoal', true ) ); ?>">
    </p>
</div>