<?php global $current_comment; //var_dump( $current_comment ); ?>

<div class="besclwp_comment">
            <div class="besclwp_comment_inner">
                <div class="besclwp_comment_left">
                    <?php echo get_avatar( $current_comment->user_id, 50 );?> 
                </div>
                <div class="besclwp_comment_right">
                    <div class="besclwp_comment_right_inner">
                        <cite class="besclwp_fn">
                            <?php comment_author( $current_comment ); ?>
                        </cite>
                    <div class="besclwp_comment_text">
                        <a href="<?php comment_link( $current_comment ); ?>">
                        <?php echo buddyboss_global_search_result_intro( $current_comment->comment_content, 150 );?>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>