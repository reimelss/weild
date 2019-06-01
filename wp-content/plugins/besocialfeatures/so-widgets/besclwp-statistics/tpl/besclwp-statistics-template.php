<?php
if ( ! empty( $instance['heading'] ) ) {
    echo '<h3>' . esc_html($instance['heading']) . '</h3>';
}
if ( ! empty( $instance['a_repeater'] ) ) {
        $list_items = $instance['a_repeater'];
        foreach( $list_items as $index => $repeater_item ) {
            $list_title = $repeater_item['title'];
            $list_icon = $repeater_item['icon'];
            $list_statistic = $repeater_item['statistic'];
            ?>
            <div class="besclwp-statistics">
                <div class="besclwp-statistics-icon">
                    <div class="besclwp-statistics-icon-inner">
                    <?php echo siteorigin_widget_get_icon($list_icon); ?>
                    </div>
                </div>
                <div class="besclwp-statistics-title">   
                <?php echo esc_html($list_title); ?>  
                </div>
                <div class="besclwp-statistics-number">
                <?php 
            if ($list_statistic == 'posts') {
                besocial_post_count();
            } elseif($list_statistic == 'comments') {
                besocial_comment_count();
            } elseif($list_statistic == 'members') {
                besocial_member_count();
            } elseif($list_statistic == 'groups') {
                besocial_bp_group_count();
            } elseif($list_statistic == 'activity') {
                besocial_bp_activity_count();
            } elseif($list_statistic == 'forums') {
                besocial_bbpress_forum_count();
            } elseif($list_statistic == 'topics') {
                besocial_bbpress_topic_count();
            } elseif($list_statistic == 'replies') {
                besocial_bbpress_reply_count();
            } elseif($list_statistic == 'topic_tags') {
                besocial_bbpress_topic_tag_count();
            } elseif($list_statistic == 'likes') {
                besocial_like_count();
            } elseif($list_statistic == 'dislikes') {
                besocial_dislike_count();
            } elseif($list_statistic == 'woo') {
                besocial_product_count();
            }
                ?>
                </div>
            </div>    
<?php
        }
    }
?> 