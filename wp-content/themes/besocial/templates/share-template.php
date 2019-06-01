<?php
$besclwp_post_featured_id = get_post_thumbnail_id();
$besclwp_post_featured_array = wp_get_attachment_image_src($besclwp_post_featured_id, 'full', true);
$besclwp_post_featured = $besclwp_post_featured_array[0];
?>
<div id="besclwp-share-buttons" class="besclwp-share-buttons">
        <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
        <?php if (is_product()) { ?>
        <h5><i class="fa fa-share-alt"></i><?php esc_html_e( 'Share This Product', 'besocial') ?></h5>
        <?php } ?>
        <?php } else { ?>
        <h5><i class="fa fa-share-alt"></i><?php esc_html_e( 'Share This Post', 'besocial') ?></h5>
        <?php } ?>   
<ul class="rrssb-buttons">

    <li class="rrssb-email">
        <a href="mailto:?Subject=<?php echo rawurlencode(get_the_title()); ?>&amp;body=<?php the_permalink(); ?>">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.386 2.614H2.614A2.345 2.345 0 0 0 .279 4.961l-.01 14.078a2.353 2.353 0 0 0 2.346 2.347h18.771a2.354 2.354 0 0 0 2.347-2.347V4.961a2.356 2.356 0 0 0-2.347-2.347zm0 4.694L12 13.174 2.614 7.308V4.961L12 10.827l9.386-5.866v2.347z"/></svg>
          </span>
            <span class="rrssb-text"><?php esc_html_e( 'email', 'besocial') ?></span>
        </a>
    </li>

    <li class="rrssb-facebook">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="popup">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"/></svg>
          </span>
            <span class="rrssb-text"><?php esc_html_e( 'facebook', 'besocial') ?></span>
        </a>
    </li>

    <li class="rrssb-twitter">
        <a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" class="popup">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62a15.093 15.093 0 0 1-8.86-2.32c2.702.18 5.375-.648 7.507-2.32a5.417 5.417 0 0 1-4.49-3.64c.802.13 1.62.077 2.4-.154a5.416 5.416 0 0 1-4.412-5.11 5.43 5.43 0 0 0 2.168.387A5.416 5.416 0 0 1 2.89 4.498a15.09 15.09 0 0 0 10.913 5.573 5.185 5.185 0 0 1 3.434-6.48 5.18 5.18 0 0 1 5.546 1.682 9.076 9.076 0 0 0 3.33-1.317 5.038 5.038 0 0 1-2.4 2.942 9.068 9.068 0 0 0 3.02-.85 5.05 5.05 0 0 1-2.48 2.71z"/></svg>
          </span>
            <span class="rrssb-text"><?php esc_html_e( 'twitter', 'besocial') ?></span>
        </a>
    </li>

    <li class="rrssb-googleplus">
        <a href="https://plus.google.com/share?url=<?php echo rawurlencode(get_the_title()); ?>%20<?php the_permalink(); ?>" class="popup">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 8.29h-1.95v2.6h-2.6v1.82h2.6v2.6H21v-2.6h2.6v-1.885H21V8.29zM7.614 10.306v2.925h3.9c-.26 1.69-1.755 2.925-3.9 2.925-2.34 0-4.29-2.016-4.29-4.354s1.885-4.353 4.29-4.353c1.104 0 2.014.326 2.794 1.105l2.08-2.08c-1.3-1.17-2.924-1.883-4.874-1.883C3.65 4.586.4 7.835.4 11.8s3.25 7.212 7.214 7.212c4.224 0 6.953-2.988 6.953-7.082 0-.52-.065-1.104-.13-1.624H7.614z"/></svg>            </span>
            <span class="rrssb-text"><?php esc_html_e( 'google+', 'besocial') ?></span>
        </a>
    </li>

    <li class="rrssb-linkedin">
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>" class="popup">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M25.424 15.887v8.447h-4.896v-7.882c0-1.98-.71-3.33-2.48-3.33-1.354 0-2.158.91-2.514 1.802-.13.315-.162.753-.162 1.194v8.216h-4.9s.067-13.35 0-14.73h4.9v2.087c-.01.017-.023.033-.033.05h.032v-.05c.65-1.002 1.812-2.435 4.414-2.435 3.222 0 5.638 2.106 5.638 6.632zM5.348 2.5c-1.676 0-2.772 1.093-2.772 2.54 0 1.42 1.066 2.538 2.717 2.546h.032c1.71 0 2.77-1.132 2.77-2.546C8.056 3.593 7.02 2.5 5.344 2.5h.005zm-2.48 21.834h4.896V9.604H2.867v14.73z"/></svg>
          </span>
            <span class="rrssb-text"><?php esc_html_e( 'linkedin', 'besocial') ?></span>
        </a>
    </li>
    
    <li class="rrssb-pinterest">
        <!-- Replace href with your meta and URL information.  -->
        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($besclwp_post_featured); ?>&amp;description=<?php echo rawurlencode(get_the_title()); ?>" class="popup">
          <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M14.02 1.57c-7.06 0-12.784 5.723-12.784 12.785S6.96 27.14 14.02 27.14c7.062 0 12.786-5.725 12.786-12.785 0-7.06-5.724-12.785-12.785-12.785zm1.24 17.085c-1.16-.09-1.648-.666-2.558-1.22-.5 2.627-1.113 5.146-2.925 6.46-.56-3.972.822-6.952 1.462-10.117-1.094-1.84.13-5.545 2.437-4.632 2.837 1.123-2.458 6.842 1.1 7.557 3.71.744 5.226-6.44 2.924-8.775-3.324-3.374-9.677-.077-8.896 4.754.19 1.178 1.408 1.538.49 3.168-2.13-.472-2.764-2.15-2.683-4.388.132-3.662 3.292-6.227 6.46-6.582 4.008-.448 7.772 1.474 8.29 5.24.58 4.254-1.815 8.864-6.1 8.532v.003z"/></svg>
          </span>
          <span class="rrssb-text"><?php esc_html_e( 'pinterest', 'besocial') ?></span>
        </a>
      </li>

    <li class="rrssb-vk">
        <a href="http://vk.com/share.php?url=<?php the_permalink(); ?>" class="popup">
            <span class="rrssb-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="70 70 378.7 378.7"><path d="M254.998 363.106h21.217s6.408-.706 9.684-4.23c3.01-3.24 2.914-9.32 2.914-9.32s-.415-28.47 12.796-32.663c13.03-4.133 29.755 27.515 47.482 39.685 13.407 9.206 23.594 7.19 23.594 7.19l47.407-.662s24.797-1.53 13.038-21.027c-.96-1.594-6.85-14.424-35.247-40.784-29.728-27.59-25.743-23.126 10.063-70.85 21.807-29.063 30.523-46.806 27.8-54.405-2.596-7.24-18.636-5.326-18.636-5.326l-53.375.33s-3.96-.54-6.892 1.216c-2.87 1.716-4.71 5.726-4.71 5.726s-8.452 22.49-19.714 41.618c-23.77 40.357-33.274 42.494-37.16 39.984-9.037-5.842-6.78-23.462-6.78-35.983 0-39.112 5.934-55.42-11.55-59.64-5.802-1.4-10.076-2.327-24.915-2.48-19.046-.192-35.162.06-44.29 4.53-6.072 2.975-10.757 9.6-7.902 9.98 3.528.47 11.516 2.158 15.75 7.92 5.472 7.444 5.28 24.154 5.28 24.154s3.145 46.04-7.34 51.758c-7.193 3.922-17.063-4.085-38.253-40.7-10.855-18.755-19.054-39.49-19.054-39.49s-1.578-3.873-4.398-5.947c-3.42-2.51-8.2-3.307-8.2-3.307l-50.722.33s-7.612.213-10.41 3.525c-2.488 2.947-.198 9.036-.198 9.036s39.707 92.902 84.672 139.72c41.234 42.93 88.048 40.112 88.048 40.112"/></svg>
          </span>
            <span class="rrssb-text"><?php esc_html_e( 'vk.com', 'besocial') ?></span>
        </a>
    </li>
</ul>
</div>    