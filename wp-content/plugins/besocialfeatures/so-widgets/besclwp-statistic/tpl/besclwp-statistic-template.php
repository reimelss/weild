<?php
$fontsize = $instance['a_section']['fontsize'];
$fontcolor = $instance['a_section']['fontcolor'];
$iconcolor = $instance['b_section']['iconcolor'];
$iconbgcolor = $instance['b_section']['iconbgcolor'];
$iconfontsize = $instance['b_section']['iconfontsize'];
$icontainersize = $instance['b_section']['iconcontainersize'];
?>
<div class="besclwp-statistic" style="font-size:<?php echo esc_html($fontsize); ?>px;color:<?php echo esc_html($fontcolor); ?>;">
    <div class="besclwp-statistic-icon" style="width:<?php echo esc_html($icontainersize); ?>px;">
        <div class="besclwp-statistic-icon-inner" style="font-size:<?php echo esc_html($iconfontsize); ?>px;color:<?php echo esc_html($iconcolor); ?>;background-color:<?php echo esc_html($iconbgcolor); ?>;height:<?php echo esc_html($icontainersize); ?>px;line-height:<?php echo esc_html($icontainersize); ?>px;">
            <?php echo siteorigin_widget_get_icon($instance['b_section']['icon']); ?>
        </div>
    </div>
    <div class="besclwp-statistic-number">
        <div class="besclwp-statistic-title">
            <?php echo esc_html($instance['a_section']['title']); ?>
        </div>
        <?php 
            if ($instance['a_section']['statistic'] == 'posts') {
                besocial_post_count();
            } elseif($instance['a_section']['statistic'] == 'comments') {
                besocial_comment_count();
            } elseif($instance['a_section']['statistic'] == 'members') {
                besocial_member_count();
            } elseif($instance['a_section']['statistic'] == 'groups') {
                besocial_bp_group_count();
            } elseif($instance['a_section']['statistic'] == 'activity') {
                besocial_bp_activity_count();
            } elseif($instance['a_section']['statistic'] == 'forums') {
                besocial_bbpress_forum_count();
            } elseif($instance['a_section']['statistic'] == 'topics') {
                besocial_bbpress_topic_count();
            } elseif($instance['a_section']['statistic'] == 'replies') {
                besocial_bbpress_reply_count();
            } elseif($instance['a_section']['statistic'] == 'topic_tags') {
                besocial_bbpress_topic_tag_count();
            } elseif($instance['a_section']['statistic'] == 'likes') {
                besocial_like_count();
            } elseif($instance['a_section']['statistic'] == 'dislikes') {
                besocial_dislike_count();
            } elseif($instance['a_section']['statistic'] == 'woo') {
                besocial_product_count();
            }
        ?>
    </div>
</div>