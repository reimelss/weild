<?php
$besclwp_footermessage = wp_kses(get_option('besclwp_footermessage'), array('a' => array('href' => array(),'target' => array()),'em' => array(),'strong' => array(),'i' => array('class' => array()),'span' => array()));
?>
</div>
</main>
<div class="clear"></div>
<footer id="footer">
<?php if ( is_active_sidebar( 'besclwpfooterwidgets' ) ) { ?>
    <div id="footer-widgets">
        <div class="footer-widgets-inner">
            <?php dynamic_sidebar( 'besclwpfooterwidgets' ); ?>
        </div>
    </div>
<?php } ?>
    <div id="footer-info-fullwidth">
        <div id="footer-info">
            <div class="footer-info-inner">
                <div class="footer-credits">
<?php if (!empty($besclwp_footermessage)) { echo stripslashes($besclwp_footermessage); } ?>
                </div>
<?php get_template_part( 'templates/footericons', 'template'); ?>
            </div>
        </div>
    </div>
</footer>
<?php 
$besclwp_icon_menu = get_option('besclwp_icon_menu');
$besclwp_mobile_icon = get_option('besclwp_mobile_icon');
if ((empty($besclwp_icon_menu)) || ($besclwp_icon_menu != 'true')) {
    if (( is_user_logged_in()) && (function_exists('bp_is_active'))) {
?>
<div id="besocial-icon-menu-toggle"><i class="fa <?php if (!empty($besclwp_mobile_icon)) { echo esc_attr($besclwp_mobile_icon); } else { echo 'fa-user'; } ?>"></i></div>   
<?php } ?>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>