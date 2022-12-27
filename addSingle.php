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
</div>