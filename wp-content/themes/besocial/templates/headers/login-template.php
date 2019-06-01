<?php $besclwp_logo = get_option('besclwp_logo'); ?>
<?php $besclwp_blog_title = get_bloginfo( 'name' ); ?>
<header id="besocial-header-login">
    <div id="besocial-header-outer" class="no-padding">
        <div id="besocial-header">
            <div id="besocial-header-left">
                <?php if (!empty($besclwp_logo)) { ?>
            <?php if (function_exists( 'icl_get_home_url' )) { ?>
                <a href="<?php echo esc_url(icl_get_home_url()); ?>"><img src="<?php echo esc_url($besclwp_logo); ?>" alt="<?php echo esc_attr($besclwp_blog_title); ?>" /></a>
                <?php } else { ?>
                <a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo esc_url($besclwp_logo); ?>" alt="<?php echo esc_attr($besclwp_blog_title); ?>" /></a>
                <?php } ?>
                <?php } else { ?>
                <a href="<?php echo esc_url(home_url( '/' )); ?>">
                    <span><?php echo esc_attr($besclwp_blog_title); ?></span>
                </a>
                <?php } ?>
            </div>                        
            <?php if ( is_user_logged_in() ) { ?>   
            <div id="header-menu" class="no-padding">
                <?php get_template_part( 'templates/menus/loggedin', 'template'); ?>
            </div>
            <?php } else { ?>
            <div id="header-menu" class="no-padding">
                <?php get_template_part( 'templates/menus/loggedout', 'template'); ?>
            </div>                
            <?php } ?>
        </div>
    </div>
</header>