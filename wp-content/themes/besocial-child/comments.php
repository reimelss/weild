<?php if (post_password_required()) { ?>
<?php return; } ?>
<?php if (have_comments()) { ?>
<?php $besclwp_num_comments = get_comments_number(); ?>
<div id="besclwp_comments_block" class="besclwp_comments_block">
<h3><?php esc_html_e("Comments", 'besocial'); ?> <span><i class="fa fa-comments"></i> <?php echo esc_html($besclwp_num_comments); ?></span></h3>

    <ol class="besclwp_commentlist">
        <?php wp_list_comments( array('callback' => 'besclwp_comment') ); ?>
    </ol>
    <div class="besclwp_comments_rss">
        <?php post_comments_feed_link('<i class="fa fa-rss-square"></i>' . esc_html__( 'Subscribe', 'besocial' )); ?>
    </div>  
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
    <div class="besclwp-pager comments-pager">    
            <div class="besclwp-pager-left">
                <?php previous_comments_link( '<i class="fa fa-chevron-left"></i> ' . esc_html__( 'Older comments', 'besocial' ) ); ?>
            </div>
            <div class="besclwp-pager-right">
                <?php next_comments_link( esc_html__( 'Newer comments', 'besocial' ) .  ' <i class="fa fa-chevron-right"></i>'); ?>
            </div>
        <div class="clear"></div>
        </div>
    <?php } ?>

<?php
if (!empty($comments_by_type['pings'])) {
    $besclwp_count = count($comments_by_type['pings']);
    ($besclwp_count !== 1) ? $besclwp_txt = esc_html__('Pings&#47;Trackbacks', 'besocial') : $besclwp_txt = esc_html__('Pings&#47;Trackbacks', 'besocial');
?>

    <h6 id="pings"><?php printf( esc_html__( '%1$d %2$s for "%3$s"', 'besocial'), $besclwp_count, $besclwp_txt, get_the_title() )?></h6>

    <ol class="besclwp_commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>

<?php } ?>
</div>     
<?php } ?>     
<?php if (comments_open()) { ?>  
<div id="besclwp_comment_form" class="besclwp_comment_form">   
    <?php comment_form(); ?>
</div>    
<?php } ?>   

