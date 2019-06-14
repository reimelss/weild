<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<style type="text/css">
	@media (min-width :768px){
		.bbp-parent_forum {width: 50%;text-align: right;float: right;}
		.bbp-pagination {width: 50%;}
	}
</style>
<div id="bbpress-forums">
	<?php
		$forum_id =  bbp_get_forum_id();
	?>
	<div class="bbp-parent_forum">
		<span class="bbp-admin-links"><a href="<?php echo get_permalink($forum_id); ?>" class="bbp-parent-forum-link">Back</a></span>
	</div>
	<?php //bbp_breadcrumb(); ?>

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php bbp_topic_tag_list(); ?>

		<?php bbp_single_topic_description(); ?>

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php bbp_get_template_part( 'form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>

</div>
