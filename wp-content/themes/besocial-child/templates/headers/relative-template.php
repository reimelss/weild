<?php $besclwp_logo = get_option('besclwp_logo'); ?>
<?php $besclwp_blog_title = get_bloginfo( 'name' ); ?>
<?php $besclwp_icon_menu_check = get_option('besclwp_icon_menu'); ?>
<?php $besclwp_top_search = get_option('besclwp_top_search'); ?>
<header>
    <div id="besocial-header-outer" <?php if ($besclwp_icon_menu_check == 'true') { ?>class="no-padding"<?php } ?>>
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
            <div id="header-menu" <?php if ($besclwp_icon_menu_check == 'true') { ?>class="no-padding"<?php } ?>>
                <?php get_template_part( 'templates/menus/loggedin', 'template'); ?>
            </div>
            <?php } else { ?>
            <div id="header-menu" <?php if ($besclwp_icon_menu_check == 'true') { ?>class="no-padding"<?php } ?>>
                <?php get_template_part( 'templates/menus/loggedout', 'template'); ?>
            </div>                
            <?php } ?>
            <?php if ($besclwp_top_search != 'true') { ?>
            <div id="besocial-header-right">
                <i class="fa fa-remove"></i>
                <i class="fa fa-search"></i>
            </div>
            <div id="besocial-search-bar">
            <form role="search" method="get" class="besocial-topbar-searchbox" action="<?php echo esc_url(home_url( '/' )); ?>">
                <input type="text" class="besocial-topbar-searchtext" placeholder="<?php esc_html_e('Search...', 'besocial'); ?>" name="s" />
                <input type="submit" class="fa-input" name="submit" value="<?php esc_html_e('Go', 'besocial'); ?>" />
            </form>
            </div>
            <?php } ?>
        </div>
    </div>
</header>