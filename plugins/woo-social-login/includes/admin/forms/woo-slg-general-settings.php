<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page General Tab
 * 
 * The code for the plugins settings page general tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for dropdown field
$woo_slg_email_notification_option = array( 
	'wordpress' 	=> esc_html__('Wordpress','wooslg'), 
	'woocommerce' 	=> esc_html__('WooCommerce','wooslg') 
);
$positions = array( 'top' => esc_html__('Above Login/Register form','wooslg'),
		 'bottom' => esc_html__('Below Login/Register form','wooslg'),
		 'hook' => esc_html__('Custom Hook','wooslg') );

// Get all pages
$all_pages = get_pages( array( 
		'post_type' => 'page',
		'posts_page_page' => -1,
		'post_staus' => 'publish'
	) );

// Assign some variable
$woo_slg_social_btn_position = ( empty( $woo_slg_social_btn_position ) ) ? 'bottom' : $woo_slg_social_btn_position;
$woo_slg_social_hooks_class = ( $woo_slg_social_btn_position == 'hook' ) ? '' : ' woo-slg-hide-section';
$woo_slg_social_btn_hooks = ( !empty( $woo_slg_social_btn_hooks ) ) ? $woo_slg_social_btn_hooks : array();
$role = !empty( $woo_slg_options['woo_slg_default_role'] ) ? $woo_slg_options['woo_slg_default_role'] : 'subscriber';
?>

<!-- beginning of the general settings meta box -->
<div id="woo-slg-general" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="general">
			<div class="postbox">

				<!-- <div class="handlediv" title="<?php esc_html_e( 'Click to toggle', 'wooslg' ); ?>"><br /></div> -->
				
				<div class="woo-slg-social-icon-text-wrap">
					<!-- general settings box title -->
					<h3 class="hndle">
						<img src="<?php echo esc_url(WOO_SLG_IMG_URL).'/tab-icon/wp-logo.svg'; ?>" alt="<?php esc_html_e('General','wooslg');?>"/>
						<span class="woo-slg-vertical-top"><?php esc_html_e( 'General Settings', 'wooslg' ); ?></span>
					</h3>
				</div>

				<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php
							
								// do action for add setting before general settings
								do_action( 'woo_slg_before_general_setting', $woo_slg_options );

								//check WooCommerce is activated or not
								if( class_exists( 'Woocommerce' ) ) {
								?>
	
								<tr valign="top">
									<th scope="row">
										<label for="woo_slg_email_notification_type"><?php echo esc_html__( 'New Account Email Template : ', 'wooslg' ); ?></label>
									</th>
									<td>
										<div class="d-flex woo_slg">
											<select name="woo_slg_email_notification_type" id="woo_slg_email_notification_type" class="wslg-select" data-width="350px" style="width: 300px;">
												<?php foreach ( $woo_slg_email_notification_option as $key => $option ) { ?>
													<option value="<?php echo $key; ?>" <?php selected( $woo_slg_email_notification_type, $key ); ?>>
														<?php esc_html_e( $option ); ?>
													</option>
												<?php } ?>
											</select>
											<p class="description"><?php esc_html_e('Choose new account email notification type. This option allows you to choose whether you want to send either WordPress or WooCommerce new account email, when user registers via social media.','wooslg'); ?></p>
										</div>
									</td>
								</tr>
	
								<?php } ?>
							
							<tr>
								<th scope="row">
									<label for="woo_slg_default_role"><?php esc_html_e( 'New User Default Role : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<select name="woo_slg_default_role" id="woo_slg_default_role" class="wslg-select" style="width: 300px;"><?php wp_dropdown_roles( $role ); ?></select>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_notification"><?php esc_html_e( 'Enable New Account Email : ', 'wooslg' );?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<input type="checkbox" id="woo_slg_enable_notification" name="woo_slg_enable_notification" value="1" <?php echo ($woo_slg_enable_notification=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_enable_notification"><?php echo esc_html__( 'Check this box, if you want to notify user when he gets registered by social media.', 'wooslg' ); ?></label>
										</li>				
										<li class="wooslg-settings-meta-box">
											<input type="checkbox" id="woo_slg_send_new_account_email_to_admin" name="woo_slg_send_new_account_email_to_admin" value="1" <?php echo ($woo_slg_send_new_account_email_to_admin=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_send_new_account_email_to_admin"><?php echo esc_html__( 'Check this box, if you want to notify admin when new user registers through social media.', 'wooslg' ); ?></label>
										</li>
									</ul>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_redirect_url"><?php esc_html_e( 'Enter Redirect URL : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_redirect_url" type="text" class="regular-text" placeholder="<?php echo esc_html__( 'http://','wooslg'); ?>" name="woo_slg_redirect_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_redirect_url ); ?>" />
									<p class="description"><?php echo esc_html__( 'Enter a redirect URL for users after they login with social media. The URL must start with', 'wooslg' ).' http:// or https://'; ?></p>
									<?php echo sprintf( esc_html__( '%sPlease enter valid url %s. %s', 'wooslg' ), '<br/><span class="woo-slg-not-rec woo-slg-hide">','(i.e. ' . esc_url('http://www.example.com') . ')', '</spna>'); ?>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="woo_slg_base_reg_username"><?php esc_html_e( 'Select Autoregistered Usernames : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<input type="radio" name="woo_slg_base_reg_username" id="woo_slg_base_reg_username" value="" <?php echo ($woo_slg_base_reg_username=='') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_base_reg_username">
											<?php echo esc_html__( 'Based on unique ID & random number ( i.e. woo_slg_123456 )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<input type="radio" name="woo_slg_base_reg_username" id="woo_slg_base_reg_username_realnam" value="realname" <?php echo ($woo_slg_base_reg_username=='realname') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_base_reg_username_realnam">
											<?php echo esc_html__( 'Based on real name ( i.e. john_smith )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<input type="radio" name="woo_slg_base_reg_username" id="woo_slg_base_reg_username_emailbased" value="emailbased" <?php echo ($woo_slg_base_reg_username=='emailbased') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_base_reg_username_emailbased">
											<?php echo esc_html__( 'Based on email ID ( i.e. john.smith@example.com to john_smith_example_com )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<input type="radio" name="woo_slg_base_reg_username" id="woo_slg_base_reg_username_realemailbased" value="realemailbased" <?php echo ($woo_slg_base_reg_username=='realemailbased') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_base_reg_username_realemailbased">
											<?php echo esc_html__( 'Actual email ID ( i.e. john.smith@example.com to john.smith@example.com )', 'wooslg' ).'</label><br>'.sprintf(esc_html__(' %s  Note  %s : ( Not Recommended This may create compatibility issues with other third party plugins. )','wooslg'), '<span class="woo-slg-warning-message">', '<span class="woo-slg-not-rec">', '</span>'); ?>
										</li>
									</ul>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_auto_session_expire_time"><?php esc_html_e( 'Keep user logged in for : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_auto_session_expire_time" type="number" class="regular-text" placeholder="<?php esc_html_e( '00 Minutes', 'wooslg' ); ?>" name="woo_slg_auto_session_expire_time" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_auto_session_expire_time ); ?>" />
									<p class="description"><?php echo esc_html__( 'Enter time in minutes to extend user session time. Leave it empty to keep default WordPress session timeout.', 'wooslg' ); ?></p>
								</td>
							</tr>
							<!-- General Settings End -->
														
							<!-- Page Settings End --><?php
							
							// do action for add setting after general settings
							do_action( 'woo_slg_after_general_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.esc_html__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div>

			<div class="postbox-wrap">
				<!-- <div class="handlediv" title="<?php esc_html_e( 'Click to toggle', 'wooslg' ); ?>"><br /></div> -->
					
				<!-- general settings box title -->
				

				<div class="inside">
					<h3 class="hndle">
						<span class="woo-slg-vertical-top"><?php esc_html_e( 'Display Settings', 'wooslg' ); ?></span>
					</h3>
					<!-- Display Settings Start -->
					<table class="form-table">
						<tbody>
							<?php
							
								// do action for add setting before display settings
								do_action( 'woo_slg_before_display_setting', $woo_slg_options );
							?>
							
							<tr>
								<th scope="row">
									<label><?php esc_html_e( 'Display Social Login buttons on : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											
												<input type="checkbox" id="woo_slg_enable_wp_login_page" name="woo_slg_enable_wp_login_page" value="1" <?php echo ($woo_slg_enable_wp_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_enable_wp_login_page">
												<?php echo esc_html__( 'Check this box to add social login on Wordpress default login page.', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											
												<input type="checkbox" id="woo_slg_enable_wp_register_page" name="woo_slg_enable_wp_register_page" value="1" <?php echo ($woo_slg_enable_wp_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_enable_wp_register_page">
												<?php echo esc_html__( 'Check this box to add social login on Wordpress default register page.', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_login_heading"><?php esc_html_e( 'Enter Social Login Title : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_login_heading" type="text" class="regular-text" name="woo_slg_login_heading" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_login_heading ); ?>" />
									<br><p class="description"><?php echo esc_html__( 'Enter Social Login Title to display above social buttons.', 'wooslg' ); ?></p>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php esc_html_e( 'Select Buttons Type : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											
												<input type="radio" id="woo_slg_social_btn_type" class="woo_slg_social_btn_change" name="woo_slg_social_btn_type" value="0" <?php echo ($woo_slg_social_btn_type=='0') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_social_btn_type">	<?php echo esc_html__( 'Use image as buttons', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											
												<input type="radio" class="woo_slg_social_btn_change" id="woo_slg_social_btn_type_n" name="woo_slg_social_btn_type" value="1" <?php echo ($woo_slg_social_btn_type=='1') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_social_btn_type_n">
												<?php echo esc_html__( 'Use text as buttons', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php esc_html_e( 'Social Buttons Position : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<div class="d-flex d-flex-wrap text-select-right">
										<select class="woo_slg_social_btn_position wslg-select" name="woo_slg_social_btn_position" data-width="350px" style="width: 350px;">
											<?php foreach( $positions as $key => $position ){?>
												<option value="<?php print $key; ?>" <?php selected($woo_slg_social_btn_position, $key, true); ?>><?php print $position; ?></option>
											<?php }?>
										</select>
										<p class="description"><?php echo esc_html__( 'Select the postion where you want to display the social login buttons. Select Custom Hook if you want to display on custom form.', 'wooslg' ); ?></p>
									</div>
								</td>
							</tr>
							<tr id="woo-slg-social-btn-hooks-container" class="<?php print $woo_slg_social_hooks_class;?>">
								<th scope="row"><label><?php esc_html_e( 'Custom Hooks : ', 'wooslg' ); ?></label></th>
								<td>
									<ul id="custom-hooks-container">
										<?php if( !empty( $woo_slg_social_btn_hooks ) ) {
												$hooks_count = 1;

												foreach ( $woo_slg_social_btn_hooks as $key => $hook) {?>
													<li class="woo-slg-social-btn-custom-hook">
														<input type="text" name="woo_slg_social_btn_hooks[]" class="woo-slg-social-btn-hook regular-text" value="<?php print $hook;?>">
														<?php if( $hooks_count > 1 ){?>
															<button class="woo-slg-remove-custom-hook" type="button">X</button>
														<?php }?>
													</li>
												<?php 
													$hooks_count++;
												}
											}
										else {?>
										<li class="woo-slg-social-btn-custom-hook">
											<input type="text" name="woo_slg_social_btn_hooks[]" class="woo-slg-social-btn-hook">
										</li>
										<?php } ?>
									</ul>
									<p class="description"><?php echo esc_html__( 'If your theme/plugin does provide custom hooks then you can enter the name of the hook here.', 'wooslg' ); ?></p>
									<p class="description"><?php echo sprintf(esc_html__( 'You can find more information about using hook in the %s manual %s.', 'wooslg' ), '<a href="' . esc_url('https://docs.wpwebelite.com/woocommerce-social-login/social-login-setup-docs/#using-custom-hooks') . '" target="_blank">', '</a>'); ?></p>
									<br>
									<button type="button" id="woo-slg-add-custom-hook" class="btn button-primary custom-hook-btn">Add more</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="inside">
						<table class="form-table">
							<tbody>
							<tr class="woo-slg-setting-seperator">
								<td colspan="2">
									<h3 class="hndle"><?php esc_html_e( 'GDPR Settings', 'wooslg' ); ?></h3>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_gdpr"><?php esc_html_e( 'Enable GDPR : ', 'wooslg' ); ?></label>
								</th>
								<td>	
									<div class="d-flex-wrap fb-avatra">
										<label for="woo_slg_enable_gdpr" class="toggle-switch">
											<input id="woo_slg_enable_gdpr" type="checkbox" name="woo_slg_enable_gdpr" value="1" <?php echo ($woo_slg_enable_gdpr=='yes') ? 'checked="checked"' : ''; ?>/>
											<span class="slider"></span>
										</label>
										<p><?php echo esc_html__( 'Check this box to enable GDPR notice on social login.', 'wooslg' ); ?></p>
									</div>
								</td>
							</tr>
							<!-- <tr>
								<th scope="row">
									<label for="woo_slg_enable_gdpr"><?php esc_html_e('Enable GDPR : ', 'wooslg'); ?></label>
								</th>
								<td>
									<label class="toggle-switch">
										<input id="woo_slg_enable_gdpr" type="checkbox" name="woo_slg_enable_gdpr" value="1" <?php echo ($woo_slg_enable_gdpr=='yes') ? 'checked="checked"' : ''; ?>/>
										<span class="slider"></span>
										<?php echo esc_html__('Check this box to enable GDPR notice on social login.', 'wooslg'); ?>
									</label>
								</td>
							</tr> -->

							<tr>
								<th scope="row">
									<label for="woo_slg_gdpr_privacy_page"><?php esc_html_e( 'Select Privacy Page : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<select id="woo_slg_gdpr_privacy_page" class="wslg-select" name="woo_slg_gdpr_privacy_page" data-width="350px">
										<option value=""><?php esc_html_e( 'Choose a Page', 'wooslg' ); ?></option>
										<?php if( !empty($all_pages) ){
											foreach( $all_pages as $page_data ){ ?>
											<option value="<?php print $page_data->ID; ?>" <?php selected($woo_slg_gdpr_privacy_page, $page_data->ID, true); ?>><?php print $page_data->post_title; ?></option>
										<?php } 
										}?>
									</select>
									<p class="description"><?php echo esc_html__( 'Choose a page to act as your privacy page.', 'wooslg' ); ?></p>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gdpr_privacy_policy"><?php esc_html_e( 'Social Login Privacy Policy : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<textarea id="woo_slg_gdpr_privacy_policy" class="regular-text" rows="5" name="woo_slg_gdpr_privacy_policy">
										<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gdpr_privacy_policy ); ?>
									</textarea>
									<p class="description note-text"><strong> Note: </strong><?php echo esc_html__( '   Enter the text with your privacy policy link to show above the social buttons.', 'wooslg'); ?><br><b><code>[privacy_policy]</code></b> - <?php echo esc_html__( 'Display privacy policy page link.', 'wooslg'); ?></p>
								</td>
							</tr>
							
							<!-- Start User Agreement GDPR Code -->
							<tr>
								<th scope="row">
									<label for="woo_slg_enable_gdpr_ua"><?php esc_html_e( 'Enable GDPR User Agreement : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<div class="d-flex-wrap fb-avatra">
										<label for="woo_slg_enable_gdpr_ua" class="toggle-switch">
											<input id="woo_slg_enable_gdpr_ua" type="checkbox" name="woo_slg_enable_gdpr_ua" value="1" <?php echo ($woo_slg_enable_gdpr_ua == 'yes' ) ? 'checked="checked"' : ''; ?>/>
											<span class="slider"></span>
										</label>
										<p><?php echo esc_html__( 'Check this box to enable GDPR User Agreement notice on social login.', 'wooslg' ); ?></p>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="woo_slg_gdpr_ua_page"><?php esc_html_e( 'Select Agreement Page : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<select id="woo_slg_gdpr_ua_page" class="wslg-select" name="woo_slg_gdpr_ua_page" data-width="350px">
										<option value=""><?php esc_html_e( 'Choose a Page', 'wooslg' ); ?></option>
										<?php if( !empty($all_pages) ){
											foreach( $all_pages as $page_data ){ ?>
											<option value="<?php print $page_data->ID; ?>" <?php selected($woo_slg_gdpr_ua_page, $page_data->ID, true); ?>><?php print $page_data->post_title; ?></option>
										<?php } 
										}?>
									</select>
									<p class="description"><?php echo esc_html__( 'Choose a page to act as your Agreement.', 'wooslg' ); ?></p>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gdpr_user_agree"><?php esc_html_e( 'Social Login Agreement : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<textarea id="woo_slg_gdpr_user_agree" class="regular-text" rows="5" name="woo_slg_gdpr_user_agree"><?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gdpr_user_agree ); ?></textarea>
									<p class="description note-text"><strong> Note: </strong><?php echo esc_html__( 'Enter the text with your agreement link to show above the social buttons.', 'wooslg'); ?><br><b><code>[user-agreement]</code></b> - <?php echo esc_html__( 'Display Agreement page link.', 'wooslg'); ?></p>
								</td>
							</tr>
							<!-- End User Agreement GDPR Code -->

							<!-- Display Settings End -->
							
							<?php
								//check WooCommerce is activated or not
								if( class_exists( 'Woocommerce' ) ) {
								
									$woo_slg_enable_expand_collapse_option = array(
										'' 				=> esc_html__('None','wooslg'),
										'collapse' 		=> esc_html__('Collapse','wooslg'),
										'expand' 		=> esc_html__('Expand','wooslg')
									);
							?>
						</table>
						</div>
						<div class="inside">
						<table class="form-table">
							<tr class="woo-slg-setting-seperator">
								<td colspan="2">
									<h3 class="hndle"><?php esc_html_e( 'WooCommerce Settings', 'wooslg' ); ?></h3>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php esc_html_e( 'Display Social Login buttons on : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											 
												<input type="checkbox" id="woo_slg_enable_login_page" name="woo_slg_enable_login_page" value="1" <?php echo ($woo_slg_enable_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_enable_login_page">
												<?php echo esc_html__( 'Check this box to add social login on WooCommerce login page.', 'wooslg' ); ?>
												</label>
										</li>
										<li class="wooslg-settings-meta-box">
											
												<input type="checkbox" id="woo_slg_enable_woo_register_page" name="woo_slg_enable_woo_register_page" value="1" <?php echo ($woo_slg_enable_woo_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_enable_woo_register_page"><?php echo esc_html__( 'Check this box to add social login on WooCommerce Registration page.', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											
												<input type="checkbox" id="woo_slg_enable_on_checkout_page" name="woo_slg_enable_on_checkout_page" value="1" <?php echo ($woo_slg_enable_on_checkout_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<label for="woo_slg_enable_on_checkout_page">
												<?php echo esc_html__( 'Check this box to add social login on WooCommerce Checkout page.', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_display_link_thank_you"><?php esc_html_e( 'Display "Link Your Account" button on : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li>
											<input type="checkbox" id="woo_slg_display_link_thank_you" name="woo_slg_display_link_thank_you" value="1" <?php echo ($woo_slg_display_link_thank_you=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_display_link_thank_you"><?php echo esc_html__( ' Check this box to allow customers to link their social account on the Thank You page.','wooslg' ); ?></label>
										</li>
										<li>
											<input type="checkbox" id="woo_slg_display_link_acc_detail" name="woo_slg_display_link_acc_detail" value="1" <?php echo (empty($woo_slg_display_link_acc_detail) || $woo_slg_display_link_acc_detail=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_display_link_acc_detail"><?php echo esc_html__( ' Check this box to allow customers to link their social account on the Account Details page.','wooslg' ); ?></label>
										</li>
									</ul>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_enable_expand_collapse"><?php echo esc_html__( 'Expand/Collapse Buttons : ', 'wooslg' ); ?></label>
								</th>
								<td>
									<select name="woo_slg_enable_expand_collapse" id="woo_slg_enable_expand_collapse" class="wslg-select" data-width="350px">
										<?php foreach ( $woo_slg_enable_expand_collapse_option as $key => $option ) { ?>
											<option value="<?php echo $key; ?>" <?php selected( $woo_slg_enable_expand_collapse, $key ); ?>>
												<?php esc_html_e( $option ); ?>
											</option>
										<?php } ?>
									</select>
									<p class="description"><?php echo ''. esc_html__('Here you can select how to show the social login buttons.','wooslg'); ?></p>
								</td>
							</tr>
							<?php } ?>
							<!-- Page Settings End -->

							<?php
								// do action for add setting after display settings
								do_action( 'woo_slg_after_display_setting', $woo_slg_options ); 
							?>

							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.esc_html__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
						
					</table>
					</div>
				</div>
				</div><!-- .inside -->
				  
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-general -->