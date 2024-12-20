<?php
/**
 * Social Profile List Template
 * 
 * Handles to load social media connected list
 * 
 * Override this template by copying it to yourtheme/woo-social-login/woo-slg-social-profile-list.php
 * 
 * @package WooCommerce - Social Login
 * @since 1.3.0
 */

// Define global variable 
global $woo_slg_model;

$model = $woo_slg_model;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="woo-slg-login-loader">
	<img src="<?php echo esc_url(WOO_SLG_IMG_URL);?>/social-loader.gif" alt="<?php echo esc_html__( 'Social Loader', 'wooslg' ); ?>"/>
</div>
<div class="woo-social-login-profile woo-slg-social-wrap">
	<h2><?php
		echo esc_html__( 'My Social Login Accounts', 'wooslg' );
	?></h2><?php

	if ( $linked_profiles ) { ?>
		<p><?php
			echo $connected_link_heading;

			if( $can_link ) {?>
				
				<a class="woo-slg-show-link" href="javascript:void(0);"><?php echo $add_more_link; ?></a><?php 
				
			} ?>
		</p>
		<div class="table-container">
			<table class="woo-social-login-linked-profiles">
				<thead>
					<tr>
						<th><?php echo esc_html__( 'Provider', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Account', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Last Login', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Unlink', 'wooslg' ); ?></th>
					</tr>
				</thead><?php
	
				foreach ( $linked_profiles as $profile => $value ) {
					$provider_icon	= esc_url(WOO_SLG_IMG_URL) . "/provider-icon/" . $profile . ".png";
					$provider_data	= $model->woo_slg_get_user_common_social_data( $value, $profile );
					?>
					
					<tr>
						<!-- Display provider button -->
						<td data-title="<?php esc_html__( 'Provider', 'wooslg' ); ?>">
							<div class="woo-slg-provider <?php echo $profile; ?>">
								<span class="woo-slg-provider-icon">
									<img src="<?php echo esc_url($provider_icon); ?>">
								</span>
								<span class="woo-slg-provider-name -1">
									<?php 
									if( $profile == 'wordpresscom' ){
										echo 'WordPress';
									}elseif( $profile == 'googleplus' ){
										echo 'google';
									}
									?>
								</span>
							</div>
						</td>
						<!-- Display account email id image-->
						<td data-title="<?php esc_html__( 'Account', 'wooslg' ); ?>">
							<?php
								echo !empty( $provider_data['email'] ) ? $provider_data['email'] : $provider_data['name'];
							?>
						</td>
						<td><?php
							$login_timestamp	= woo_slg_get_social_last_login_timestamp( $user_id, $profile );
							
							if( !empty( $login_timestamp ) ) {
								$date_format = get_option( 'date_format' );
								$time_format = get_option( 'time_format' );

								if( function_exists('wc_date_format') ){
									$date_format = wc_date_format();
								}

								if( function_exists('wc_time_format') ){
									$time_format = wc_time_format();
								}

								printf( '%s @ %s', date_i18n( $date_format, $login_timestamp ), date_i18n( $time_format, $login_timestamp ) );
							} else {
								echo esc_html__( 'Never', 'wooslg' );
							}
						?>
						</td>
						<td>
							<?php
							if( $profile != $primary_social ) {?>
								<!-- Display profile unlink url-->
								<a href="javascript:void(0);" class="button woo-slg-social-unlink-profile" id="<?php echo $profile;?>"><?php
									echo esc_html__( 'Unlink', 'wooslg' );
								?></a><?php 
							} else {
								?>
								<!-- Display primary account unlink url-->
								<a href="javascript:void(0);" class="button woo-slg-social-unlink-profile"><?php
								echo esc_html__( 'Unlink primary account', 'wooslg' );
								?></a><?php
							}
							?>
						</td>
					</tr>
				<?php } ?>

				<tfoot>
					<tr>
						<th><?php echo esc_html__( 'Provider', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Account', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Last Login', 'wooslg' ); ?></th>
						<th><?php echo esc_html__( 'Unlink', 'wooslg' ); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>

		<?php } else { ?>

		<p><?php 
			echo $no_social_connected;
			
			if( $can_link ) { ?>
				<a class="woo-slg-show-link" href="javascript:void(0);"><?php echo $connect_now_link; ?></a><?php 
			} ?>
		</p><?php
	} ?>

	<div class="woo-slg-profile-link-container <?php if( $can_link ) { echo 'woo-slg-hide-section'; } ?>"><?php
		// display social link buttons
		woo_slg_link_buttons();?>

	</div>
</div>