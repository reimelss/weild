(function ($) {
    "use strict";
    $(document).on( 'heartbeat-send', function ( event, data ) {
        data.besocial_get_notification_count = $('#notifications-besocial').data('count');
        data.besocial_get_message_count = $('#messages-besocial').data('count');
        data.besocial_get_friend_count = $('#friends-besocial').data('count');
        data.besocial_get_group_count = $('#groups-besocial').data('count');
    });
    
    $(document).on( 'heartbeat-tick', function ( event, data ) {
        if ( data.besocial_notification_count ) {
            if ( data.besocial_notification_class == 1 ) {
                $('#notifications-besocial').addClass('besocial-new-notification');
            }
            $('#notifications-besocial').attr('data-count', data.besocial_notification_count);
            $('#notifications-besocial').find('.icon-count').html(data.besocial_notification_count);
            $('#notifications-besocial').find('.icon-count-list').html(data.besocial_notification_count);
        }
        if ( data.besocial_notification_content ) {
            $('#notifications-besocial').find('.notification-content').html(data.besocial_notification_content);
        }
        if ( data.besocial_message_count ) {
            if ( data.besocial_message_class == 1 ) {
                $('#messages-besocial').addClass('besocial-new-notification');
            }
            $('#messages-besocial').attr('data-count', data.besocial_message_count);
            $('#messages-besocial').find('.icon-count').html(data.besocial_message_count);
            $('#messages-besocial').find('.icon-count-list').html(data.besocial_message_count);
        }
        if ( data.besocial_friend_count ) {
            if ( data.besocial_friend_class == 1 ) {
                $('#friends-besocial').addClass('besocial-new-notification');
            }
            $('#friends-besocial').attr('data-count', data.besocial_friend_count);
            $('#friends-besocial').find('.icon-count').html(data.besocial_friend_count);
            $('#friends-besocial').find('.icon-count-list').html(data.besocial_friend_count);
        }
        if ( data.besocial_group_count ) {
            if ( data.besocial_group_class == 1 ) {
                $('#groups-besocial').addClass('besocial-new-notification');
            }
            $('#groups-besocial').attr('data-count', data.besocial_group_count);
            $('#groups-besocial').find('.icon-count').html(data.besocial_group_count);
            $('#groups-besocial').find('.icon-count-list').html(data.besocial_group_count);
        }
    }); 
})(jQuery);    