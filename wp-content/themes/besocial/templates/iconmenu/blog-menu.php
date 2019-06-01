<?php $besclwp_blog_icon = get_option('besclwp_blog_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_blog_title'); ?>
<?php $besclwp_enable_user_blog = get_option('besclwp_enable_user_blog'); ?>
<!-- Blog -->
<?php if ($besclwp_enable_user_blog == 'true') { ?>
<li id="blog-besocial" class="has-submenu" data-count="<?php echo esc_html(besocial_count_pending_posts(get_current_user_id())); ?>">
    <a href="#">
        <div class="icon-count"><?php echo esc_html(besocial_count_pending_posts(get_current_user_id())); ?></div><i class="fa <?php if (!empty($besclwp_blog_icon)) { echo esc_attr($besclwp_blog_icon); } else { echo 'fa-pencil'; } ?>"></i>
    </a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'My Blog', 'besocial'); } ?>
            </h5>
        </li>
        <?php do_action( 'besocial_before_blog_menu' ); ?>
        <li id="blog-my-blog-besocial"><a href="<?php echo bp_loggedin_user_domain(); ?>user-blog/"><?php echo esc_html__( 'Published Posts', 'besocial'); ?><span class="icon-count-list default-blue"><?php echo esc_html(count_user_posts(get_current_user_id())); ?></span></a></li>
        <li id="blog-my-blog-pending-besocial"><a href="<?php echo bp_loggedin_user_domain(); ?>user-blog/pending-posts/"><?php echo esc_html__( 'Pending Posts', 'besocial'); ?><span class="icon-count-list"><?php echo esc_html(besocial_count_pending_posts(get_current_user_id())); ?></span></a></li>
        <li id="blog-my-blog-add-new-besocial"><a href="<?php echo bp_loggedin_user_domain(); ?>user-blog/add-new-post/"><?php echo esc_html__( 'Add New Post', 'besocial'); ?> <i class="fa fa-plus"></i></a></li>
        <?php do_action( 'besocial_after_blog_menu' ); ?>
    </ul>
</li>
<?php } ?>