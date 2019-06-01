<?php if (function_exists('besclwpiconmenu_get_option')) { ?>
<?php
$besclwp_icon_menu_slug = besclwpiconmenu_get_option( 'besocial_icon_menu_order' );
?>  
<div id="besocial-icon-menu">
    <div id="besocial-sidemenu-scrollbar">
        <nav class="menu-bp-container">
            <ul id="besocial-sidemenu" class="menu">
                <?php
                if(!empty($besclwp_icon_menu_slug)) {
                    $besclwp_icon_menu_array = $besclwp_icon_menu_slug["enabled"];
                    foreach ( (array) $besclwp_icon_menu_array as $key => $label ) {
                        get_template_part( 'templates/iconmenu/' . $key, 'menu');
                    }         
                }
                else {
                    get_template_part( 'templates/iconmenu/' . 'default', 'menu');
                }
                ?>
            </ul>
        </nav>
    </div>
</div>
<?php } ?>