<?php
$besclwpsocialicons = '';
if ( function_exists( 'besclwpsocial_get_option' ) ) {
    $besclwpsocialicons = besclwpsocial_get_option( 'besocialsocialicons' );
    $besclwpnewtab = besclwpsocial_get_option( 'besocialsocialiconstab' );
}
?>  
<?php if (!empty($besclwpsocialicons)) { ?>
<?php foreach ( (array) $besclwpsocialicons as $key => $entry ) { 
    $besclwpiconimg = $besclwpiconcustom = $besclwpiconlink  = '';
    if ( isset( $entry['besocialiconimg'] ) ) {            
        $besclwpiconimg = $entry['besocialiconimg'];
    }
    if ( isset( $entry['besocialiconcustom'] ) ) {            
        $besclwpiconcustom = $entry['besocialiconcustom'];
    }
    if ( isset( $entry['besocialiconlink'] ) ) {            
        $besclwpiconlink = $entry['besocialiconlink'];
    } 
    ?>
    <div class="besclwp-footer-icon"> 
        <a href="<?php echo esc_url($besclwpiconlink); ?>" class="fa fa-<?php if (empty($besclwpiconcustom)) { echo esc_attr($besclwpiconimg); } else { echo esc_attr($besclwpiconcustom); } ?>" <?php if ($besclwpnewtab == 'on') { echo 'target="_blank"'; } ?>><?php if (empty($besclwpiconcustom)) { echo esc_attr($besclwpiconimg); } else { echo esc_attr($besclwpiconcustom); } ?></a>
    </div>
    <?php } ?>    
<?php } ?>  
<div class="besclwp-footer-icon"> 
    <a id="besclwp-back-to-top-button" href="#" class="fa-arrow-circle-up"><?php esc_html_e( 'Go To Top', 'besocial' ); ?></a>
</div>
<div class="clear"></div>