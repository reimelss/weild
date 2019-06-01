<?php global $current_message; ?>
	<p class="message_participants">
		<?php 
		esc_html_e( 'Conversation between', 'besocial' );
		$participants = array();
		foreach( $current_message->recepients as $recepient_id ){
			if( $recepient_id==get_current_user_id() )
				continue;
			
			$participants[] = bp_core_get_userlink( $recepient_id );
		}
		
		echo ' ' . implode( ', ', $participants ) . ' ' . esc_html__( 'and you.', 'besocial' );
		?>
		
		<span class='view_thread_link'>
			<a href='<?php echo esc_url( trailingslashit( bp_loggedin_user_domain() ) ) . 'messages/view/' . $current_message->thread_id . '/';?>'>
				<?php esc_html_e( 'View Conversation', 'besocial' );?>
			</a>
		</span>
	</p>
    
    <div class="besocial-member-outer <?php besclwp_featured_check($current_message->sender_id); ?>">
		<div class="besocial-member-inner">
            <div class="besocial-member-avatar">   
				<a href="<?php echo bp_core_get_userlink( $current_message->sender_id, true, true );?>">
                <?php echo bp_core_fetch_avatar( array( 'item_id'=>$current_message->sender_id, 'width'=> 50, 'height'=> 50 ) );?>
            </a>
			</div>

			<div class="besocial-member">
				<div class="besocial-member-title">
					<a href="<?php echo esc_url( trailingslashit( bp_loggedin_user_domain() ) ) . 'messages/view/' . $current_message->thread_id . '/';?>">
                    <?php echo stripslashes( $current_message->subject ); ?>
                </a>
				</div>

				<div class="besocial-member-meta"><?php 
                    $content = wp_strip_all_tags($current_message->message);
                    $trimmed_content = wp_trim_words( $content, 20, '...' ); 
                    echo $trimmed_content; 
                ?></div>

			</div>
		</div>
    </div>