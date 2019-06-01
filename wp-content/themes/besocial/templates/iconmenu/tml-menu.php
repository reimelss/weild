<?php $besclwp_tml_icon = get_option('besclwp_tml_icon'); ?>
<?php $besclwp_menu_title = get_option('besclwp_tml_title'); ?>
<!-- TML MENU -->
<?php
if(class_exists('Theme_My_Login')) {            
$theme_my_login = Theme_My_Login::get_object();
$template = $theme_my_login->get_active_instance();
$menu_links = $template->get_user_links();
?>
<li id="tml-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_tml_icon)) { echo esc_attr($besclwp_tml_icon); } else { echo 'fa-bars'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5>
                <?php if (!empty($besclwp_menu_title)) { echo esc_html($besclwp_menu_title); } else { esc_html_e( 'Menu', 'besocial'); } ?>
            </h5>
        </li>
        <?php 
        foreach ( (array) $menu_links as $link ) {
			echo '<li><a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['title'] ) . '</a></li>' . "\n";
		}
        ?>
    </ul>
</li>    
<?php } else { ?>
<li id="tml-besocial" class="has-submenu"><a href="#"><i class="fa <?php if (!empty($besclwp_tml_icon)) { echo esc_attr($besclwp_tml_icon); } else { echo 'fa-bars'; } ?>"></i></a>
    <ul class="sidemenu-sub">
        <li>
            <h5><?php echo esc_html__( 'Menu', 'besocial'); ?></h5>
        </li>
        <li>
            <?php echo esc_html__( 'Please upload and activate TML plugin to use this feature.', 'besocial'); ?>
        </li>
    </ul>
</li> 
<?php } ?>