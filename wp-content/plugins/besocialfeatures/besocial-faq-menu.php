<?php
$besclwp_categories = get_terms("besclwpfaqcats");
$besclwp_cat_count = count($besclwp_categories);

if ( $besclwp_cat_count > 0 ) {
?>
<div class="besocial-faq-menu">
<ul>
<li class="besocial-faq-title"><?php echo esc_attr__('Categories', 'besclwpcpt'); ?></li>    
<?php	
foreach ( $besclwp_categories as $cat ) {
    $catid = $cat->term_id;
?>
    <li>
        <a href="#" data-cat="besclwp-cat-<?php echo esc_html($catid); ?>"><?php echo esc_html($cat->name); ?><span><?php besclwp_count_faq_in_cat($catid); ?></span></a>
    </li>   
<?php } ?>
</ul>
</div>    
<?php } ?>