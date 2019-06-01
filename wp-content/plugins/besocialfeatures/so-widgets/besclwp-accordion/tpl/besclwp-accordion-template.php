<?php
if ( ! empty( $instance['a_repeater'] ) ) {
        $accordion_items = $instance['a_repeater'];
        foreach( $accordion_items as $index => $repeater_item ) {
            $accordion_title = $repeater_item['title'];
            $accordion_icon = $repeater_item['icon'];
            $accordion_editor = $repeater_item['text'];
            echo '<div class="besclwp-accordion-header"><strong>' . siteorigin_widget_get_icon($accordion_icon) . ' ' . $accordion_title . '</strong></div><div class="besclwp-accordion-content">' . wp_kses_post($accordion_editor) . '</div>';
        }
    }
?>