<?php

define ( 'BP_MEMBERS_SLUG', 'affiliates' );


function bp_get_members_pagination_countss() {
		global $members_template;

		if ( empty( $members_template->type ) )
			$members_template->type = '';

		$start_num = intval( ( $members_template->pag_page - 1 ) * $members_template->pag_num ) + 1;
		$from_num  = bp_core_number_format( $start_num );
		$to_num    = bp_core_number_format( ( $start_num + ( $members_template->pag_num - 1 ) > $members_template->total_member_count ) ? $members_template->total_member_count : $start_num + ( $members_template->pag_num - 1 ) );
		$total     = bp_core_number_format( $members_template->total_member_count );

		if ( 'active' == $members_template->type ) {
			if ( 1 == $members_template->total_member_count ) {
				$pag = __( 'Viewing 1 active affiliate', 'buddypress' );
			} else {
				$pag = sprintf( _n( 'Viewing %1$s - %2$s of %3$s active affiliate', 'Viewing %1$s - %2$s of %3$s active affiliates', $members_template->total_member_count, 'buddypress' ), $from_num, $to_num, $total );
			}
		} elseif ( 'popular' == $members_template->type ) {
			if ( 1 == $members_template->total_member_count ) {
				$pag = __( 'Viewing 1 affiliate with friends', 'buddypress' );
			} else {
				$pag = sprintf( _n( 'Viewing %1$s - %2$s of %3$s affiliate with friends', 'Viewing %1$s - %2$s of %3$s affiliates with friends', $members_template->total_member_count, 'buddypress' ), $from_num, $to_num, $total );
			}
		} elseif ( 'online' == $members_template->type ) {
			if ( 1 == $members_template->total_member_count ) {
				$pag = __( 'Viewing 1 online affiliate', 'buddypress' );
			} else {
				$pag = sprintf( _n( 'Viewing %1$s - %2$s of %3$s online affiliate', 'Viewing %1$s - %2$s of %3$s online affiliates', $members_template->total_member_count, 'buddypress' ), $from_num, $to_num, $total );
			}
		} else {
			if ( 1 == $members_template->total_member_count ) {
				$pag = __( 'Viewing 1 affiliate', 'buddypress' );
			} else {
				$pag = sprintf( _n( 'Viewing %1$s - %2$s of %3$s affiliate', 'Viewing %1$s - %2$s of %3$s affiliates', $members_template->total_member_count, 'buddypress' ), $from_num, $to_num, $total );
			}
		}

		/**
		 * Filters the members pagination count.
		 *
		 * @since 1.5.0
		 *
		 * @param string $pag Pagination count string.
		 */
		return apply_filters( 'bp_members_pagination_count', $pag );
	}