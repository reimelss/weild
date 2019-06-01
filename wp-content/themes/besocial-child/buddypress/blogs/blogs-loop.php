<?php
/**
 * BuddyPress - Blogs Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter().
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the start of the blogs loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_blogs_loop' ); ?>

<?php if ( bp_has_blogs( bp_ajax_querystring( 'blogs' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="blog-dir-count-top">
			<?php bp_blogs_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="blog-dir-pag-top">
			<?php bp_blogs_pagination_links(); ?>
		</div>

	</div>

	<?php

	/**
	 * Fires before the blogs directory list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_blogs_list' ); ?>

	<div id="blogs-list" class="item-list">

	<?php while ( bp_blogs() ) : bp_the_blog(); ?>

		<div class="besocial-group-outer">
		<div class="besocial-group-inner">
			<div class="besocial-group-avatar">
				<a href="<?php bp_blog_permalink(); ?>"><?php bp_blog_avatar( 'type=thumb' ); ?></a>
			</div>

			<div class="besocial-group">
				<div class="besocial-group-title"><a href="<?php bp_blog_permalink(); ?>"><?php bp_blog_name(); ?></a></div>
				<div class="besocial-group-meta"><i class="fa fa-clock-o"></i> <span class="activity"><?php bp_blog_last_active(); ?></span></div>
                <div class="besocial-group-desc"><?php bp_blog_latest_post(); ?></div>
                <div class="besocial-group-action">

				<?php

				/**
				 * Fires inside the blogs action listing area.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_blogs_actions' ); ?>


			</div>

				<?php

				/**
				 * Fires after the listing of a blog item in the blogs loop.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_directory_blogs_item' ); ?>
			

			
            </div>

		</div>
        </div>

	<?php endwhile; ?>

	</div>

	<?php

	/**
	 * Fires after the blogs directory list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_blogs_list' ); ?>

	<?php bp_blog_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="blog-dir-count-bottom">

			<?php bp_blogs_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="blog-dir-pag-bottom">

			<?php bp_blogs_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'Sorry, there were no sites found.', 'besocial' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the blogs loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_blogs_loop' ); ?>
