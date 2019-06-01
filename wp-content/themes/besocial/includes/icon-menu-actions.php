<?php
/* ---------------------------------------------------------
Before Activity Menu
----------------------------------------------------------- */

function besocial_add_before_activity_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'activity_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_activity_menu','besocial_add_before_activity_menu');

/* ---------------------------------------------------------
After Activity Menu
----------------------------------------------------------- */

function besocial_add_after_activity_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'activity_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_activity_menu','besocial_add_after_activity_menu');

/* ---------------------------------------------------------
Before Profile Menu
----------------------------------------------------------- */

function besocial_add_before_profile_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'profile_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_profile_menu','besocial_add_before_profile_menu');

/* ---------------------------------------------------------
After Profile Menu
----------------------------------------------------------- */

function besocial_add_after_profile_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'profile_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_profile_menu','besocial_add_after_profile_menu');

/* ---------------------------------------------------------
Before Notifications Menu
----------------------------------------------------------- */

function besocial_add_before_notifications_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'notifications_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_notifications_menu','besocial_add_before_notifications_menu');

/* ---------------------------------------------------------
After Notifications Menu
----------------------------------------------------------- */

function besocial_add_after_notifications_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'notifications_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_notifications_menu','besocial_add_after_notifications_menu');

/* ---------------------------------------------------------
Before Messages Menu
----------------------------------------------------------- */

function besocial_add_before_messages_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'messages_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_messages_menu','besocial_add_before_messages_menu');

/* ---------------------------------------------------------
After Messages Menu
----------------------------------------------------------- */

function besocial_add_after_messages_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'messages_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_messages_menu','besocial_add_after_messages_menu');

/* ---------------------------------------------------------
Before Friends Menu
----------------------------------------------------------- */

function besocial_add_before_friends_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'friends_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_friends_menu','besocial_add_before_friends_menu');

/* ---------------------------------------------------------
After Friends Menu
----------------------------------------------------------- */

function besocial_add_after_friends_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'friends_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_friends_menu','besocial_add_after_friends_menu');

/* ---------------------------------------------------------
Before Blog Menu
----------------------------------------------------------- */

function besocial_add_before_blog_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'blog_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_blog_menu','besocial_add_before_blog_menu');

/* ---------------------------------------------------------
After Blog Menu
----------------------------------------------------------- */

function besocial_add_after_blog_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'blog_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_blog_menu','besocial_add_after_blog_menu');

/* ---------------------------------------------------------
Before Groups Menu
----------------------------------------------------------- */

function besocial_add_before_groups_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'groups_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_groups_menu','besocial_add_before_groups_menu');

/* ---------------------------------------------------------
After Groups Menu
----------------------------------------------------------- */

function besocial_add_after_groups_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'groups_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_groups_menu','besocial_add_after_groups_menu');

/* ---------------------------------------------------------
Before Forums Menu
----------------------------------------------------------- */

function besocial_add_before_forums_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'forums_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_forums_menu','besocial_add_before_forums_menu');

/* ---------------------------------------------------------
After Forums Menu
----------------------------------------------------------- */

function besocial_add_after_forums_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'forums_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_forums_menu','besocial_add_after_forums_menu');

/* ---------------------------------------------------------
Before Woocommerce Menu
----------------------------------------------------------- */

function besocial_add_before_woocommerce_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'woocommerce_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_woocommerce_menu','besocial_add_before_woocommerce_menu');

/* ---------------------------------------------------------
After Woocommerce Menu
----------------------------------------------------------- */

function besocial_add_after_woocommerce_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'woocommerce_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_woocommerce_menu','besocial_add_after_woocommerce_menu');

/* ---------------------------------------------------------
Before Settings Menu
----------------------------------------------------------- */

function besocial_add_before_settings_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'settings_before') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_before_settings_menu','besocial_add_before_settings_menu');

/* ---------------------------------------------------------
After Settings Menu
----------------------------------------------------------- */

function besocial_add_after_settings_menu() {
    $besclwp_icon_menu_links = besclwpiconmenu_get_option( 'besocial_icon_menu_links' );
    if (!empty($besclwp_icon_menu_links)) {
        foreach ( (array) $besclwp_icon_menu_links as $key => $entry ) { 
            $position = $text = $url = $target = '';
            if ( isset( $entry['besocial_icon_menu_link_position'] ) ) {            
                $position = $entry['besocial_icon_menu_link_position'];
            }    
            if ($position == 'settings_after') {
                if ( isset( $entry['besocial_icon_menu_text'] ) ) {            
                    $text = $entry['besocial_icon_menu_text'];
                }
                if ( isset( $entry['besocial_icon_menu_url'] ) ) {            
                    $url = $entry['besocial_icon_menu_url'];
                }
                if ( isset( $entry['besocial_icon_menu_target'] ) ) {            
                    $target = $entry['besocial_icon_menu_target'];
                }
                $new_tab = '';
                if ($target == 'on') {
                    $new_tab = 'target="_blank"';
                }  
            ?>
            <li><a href="<?php echo esc_url($url); ?>" <?php echo esc_html($new_tab); ?>><?php echo esc_html($text); ?></a></li>
            <?php }
        }
    }
}

add_action('besocial_after_settings_menu','besocial_add_after_settings_menu');
?>