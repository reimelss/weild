<?php if (function_exists('bp_core_get_user_domain')) { ?>
<div class="besclwp-page-title">
    <div class="besclwp-page-title-left">
        <p class="besclwp-author-label"><?php echo esc_html__( 'All posts by', 'besocial' ); ?></p>
        <h1><?php the_author(); ?></h1>
        <p><a href="<?php echo esc_url(bp_core_get_user_domain( get_the_author_meta( 'ID' ) )); ?>" class="besocial-button"><?php echo esc_html__( 'View Profile', 'besocial' ); ?></a></p>
    </div>
    <div class="besclwp-page-title-right">
        <a href="<?php echo esc_url(bp_core_get_user_domain( get_the_author_meta( 'ID' ) )); ?>">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
        </a>
    </div>
</div>
<?php } else { ?>
<?php $besclwp_author_desc = get_the_author_meta('description'); ?>
<div class="besclwp-page-title">
    <div class="besclwp-page-title-left">
        <h1><?php echo esc_html__( 'All posts by', 'besocial' ); ?> <span class="besclwp-highlight"><?php the_author(); ?></span></h1>
        <?php if (!empty($besclwp_author_desc)) { ?>
        <p class="besclwp-subtitle">
            <?php echo nl2br($besclwp_author_desc); ?>
        </p>
        <?php } ?>
    </div>
    <div class="besclwp-page-title-right">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
    </div>
</div>
<?php } ?>