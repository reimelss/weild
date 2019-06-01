<div class="besclwp-author-box">
    <div class="besclwp-author-row">
        <div class="besclwp-author-avatar">
            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
            </a>
        </div>
        <div class="besclwp-author-meta">
                <h5><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></h5>
            <div class="besclwp-author-desc">
                <?php echo wp_kses_post(wpautop(get_the_author_meta('description'))); ?>
            </div>
            <div class="besclwp-author-links">
                <?php if (function_exists('bp_core_get_user_domain')) { ?>
                <a href="<?php echo esc_url(bp_core_get_user_domain( get_the_author_meta( 'ID' ) )); ?>">
                <?php esc_html_e( 'View Profile', 'besocial'); ?>
                </a><span>|</span>
                <?php } ?>
                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                <?php esc_html_e( 'View all posts by', 'besocial'); ?> <?php the_author(); ?>
                </a>
            </div>
        </div>
    </div>
</div>