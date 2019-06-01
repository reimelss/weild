<a class="besclwp-toggle-menu" href="#"><i class="fa fa-bars"></i></a>               
<?php if ( has_nav_menu( 'besclwp-main-menu' ) ) {
    $defaults = array(
        'theme_location'  => 'besclwp-main-menu',
        'menu'            => '',
        'container'       => 'nav',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'items_wrap'      => '<ul id="%1$s" class="besclwp-nav %2$s">%3$s</ul>',
        'depth'           => 3
    );
    wp_nav_menu( $defaults );
} ?> 