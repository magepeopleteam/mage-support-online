<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This is helper class of support plugin.
 */
if ( ! class_exists( 'MAGESO_Support_Online_Helper' ) ) {
	class MAGESO_Support_Online_Helper {
		/**
		 * This method is return the active and deactive status.
		 *
		 * @return false|string
		 */
		public static function supportStatus() {

			ob_start();
			$on_day  = mageso_get_option( 'so_working_day', 'general_setting_sec', array() );
			$off_day = mageso_get_option( 'so_off_day', 'general_setting_sec', array() );
			$get_start_time = mageso_get_option( 'so_start_time', 'general_setting_sec', '9:00 AM' );
			$get_end_time   = mageso_get_option( 'so_end_time', 'general_setting_sec', '6:00 PM' );
			$get_week_start_day   = mageso_get_option( 'start_weekday', 'general_setting_sec', 'Sunday' );
			$get_week_end_day   = mageso_get_option( 'end_weekday', 'general_setting_sec', 'Friday' );
if(sizeof($on_day)>0){

			$start_time = date( 'H:i:s', strtotime( $get_start_time ) );
			$end_time   = date( 'H:i:s', strtotime( $get_end_time ) );

			$current_time = current_time( 'H:i:s' );
			$current_day  = date( 'D', strtotime(current_time('Y-m-d')) );
			if ( in_array( strtolower( $current_day ), $on_day ) && $current_time >= $start_time && $current_time <= $end_time ) {
				
				$datetime1 = new DateTime( $end_time );
				$datetime2 = new DateTime( $current_time );

				$interval = date_diff( $datetime2, $datetime1 );
				$hours    = $interval->h;
				$minutes  = $interval->i;

				$hours = $hours > 0 ? $hours . " Hours " : "";


				$status = '' . esc_html__( 'Support is ', 'mage-support-online') . '<span style=color:green;font-weight:bold>' . esc_attr__( 'Online,', 'mage-support-online') . '
                            </span> ' . esc_html__( 'We will be ', 'mage-support-online') . ' ' . esc_html__( 'Offline ', 'mage-support-online') . ' 
                            ' . esc_html__( 'after ' . $hours . $minutes . ' Minutes' );
				$on_day_arr =	mageso_get_option( 'so_working_day', 'general_setting_sec', '' )
				?>
                <div class='mageso-onlice-sec'>
					<?php echo $status; ?>
                    <h3><?php _e('Our office hours','mage-support-online'); ?> </h3>
					<?php echo date_i18n( 'l', strtotime( $get_week_start_day ) ); ?> – <?php echo date( 'l', strtotime( $get_week_end_day ) ).' / '.date_i18n( 'h:i A', strtotime( $get_start_time ) ).' - '.date_i18n( 'h:i A', strtotime( $get_end_time ) ); ?>
                </div>
				<?php
			} else {

				$on_day  = mageso_get_option( 'so_working_day', 'general_setting_sec', array() );
				$off_day = mageso_get_option( 'so_off_day', 'general_setting_sec', array() );
				$on_day_arr =	mageso_get_option( 'so_working_day', 'general_setting_sec', array() );
				if ( ! is_array( $on_day ) && ! is_array( $off_day ) ) {
					$on_day  = array();
					$off_day = array();
				}

				$next_date = date( 'Y-m-d', strtotime( " +1 day" ) );
				$next_day  = date( 'D', strtotime( $next_date ) );

				if ( in_array( strtolower( $next_day ), $on_day ) ) {
					$next_working_day = $next_date . ' ' . $start_time;
				} elseif ( in_array( strtolower( $next_day ), $off_day ) ) {
					$in_pos = (int) array_search( strtolower( $next_day ), $off_day ) + 1 + count( $off_day );
					date( 'Y-m-d', strtotime( " +$in_pos day" ) );
					$next_working_day = date( 'Y-m-d', strtotime( " +$in_pos day" ) ) . ' ' . $start_time;
				}
				$in_pos = (int) array_search( strtolower( $next_day ), $off_day ) + 1 + count( $off_day );

				$current_time = current_time( 'Y-m-d H:i:s' );
				$next_working_day = date( 'Y-m-d', strtotime( " +$in_pos day" ) ) . ' ' . $start_time;
				$start_time = date( 'Y-m-d H:i:s', strtotime( $next_working_day ) );
				$datetime1  = new DateTime( $start_time );
				$datetime2  = new DateTime( $current_time );
				$interval   = date_diff( $datetime1, $datetime2 );
				// print_r($interval);
				$days    = $interval->days;
				$hours   = $interval->h;
				$minutes = $interval->i;

				$day_text = $days > 0 ? $days . ' Days' : "";

				$status = '' . esc_html__( 'Support is ', 'mage-support-online') . '<span style=color:red;font-weight:bold>' . esc_attr__( 'Offline,', 'mage-support-online') . '
                            </span> ' . esc_html__( 'We will be ', 'mage-support-online') . "" . esc_html__( 'Online ', 'mage-support-online') .
				          ' ' . __( 'after <b>' . $day_text . " " . $hours . ' Hours ' . $minutes . ' Minutes </b>' );

				?>
                <div class='mageso-offline-sec'>
					<?php echo $status; ?>
                    <h3><?php _e('Our office hours','mage-support-online'); ?> </h3>
					<?php echo date_i18n( 'l', strtotime( $get_week_start_day ) ); ?> – <?php echo date( 'l', strtotime( $get_week_end_day ) ).' / '.date_i18n( 'h:i A', strtotime( $get_start_time ) ).' - '.date_i18n( 'h:i A', strtotime( $get_end_time ) ); ?>
                </div>
				<?php
			}
			?>
            <div class='mageso-show-current-time'>
                <span class="current_date"></span> |
                <span><?php echo "Our time : <span id='mage_our_time'>" . current_time( 'h:i:s' ); ?></span></span>
            </div>
			<?php
}else{
	?>
                <div class='mageso-offline-sec'>
					<?php _e('No settings found. Please Set your Working & Weekend Day from the Dashboard','mage-support-online'); ?>
                </div>
	<?php
}
			$support_status = ob_get_contents();

			ob_get_clean();

			return $support_status;

		}//end method supportStatus


	}//end class MAGESO_Support_Online_Helper
}//end class exist block, if codition
