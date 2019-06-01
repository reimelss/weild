<?php get_header(); ?>
<div class="besclwp-post-content besclwp-404-container">
    <h1><span class="besclwp-highlight"><?php esc_html_e( '404', 'besocial' ); ?></span> <?php esc_html_e( 'Page Not Found', 'besocial' ); ?></h1>
    <p><?php esc_html_e( 'You can return', 'besocial'); ?> <a href="<?php esc_url( home_url( '/' ) ); ?>/" title="<?php esc_html_e( 'Home', 'besocial' ); ?>"><?php esc_html_e( 'home', 'besocial'); ?></a> <?php esc_html_e( 'or search for the page you were looking for;', 'besocial'); ?></p>
    <div class="besclwp-no-result-form">
    <?php get_search_form(); ?>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>