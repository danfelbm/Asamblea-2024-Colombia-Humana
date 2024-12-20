<?php
/**
 * Login with email
 * 
 * Handles to load Login in with email template
 * 
 * Override this template by copying it to yourtheme/woo-social-login/email-login.php
 * 
 * @package WooCommerce - Social Login
 * @since 1.8.2
 */

global $woo_slg_options; // Define global variable 
?>

<!-- beginning of the email login container -->
<div class="woo-slg-email-login-container">

	<?php if( !empty( $seprater_text ) && $position == 'bottom' ) { ?>
		<div class="woo-slg-horizontal-divider"><span><?php print $seprater_text; ?></span></div>
	<?php } ?>

	<?php if( !empty( $login_email_heading ) ) {
		echo '<span><legend>' . $login_email_heading . '</legend></span>';
	} ?>
	<div class="woo-slg-email-login-wrap">
		<input type="email" class="regular-text woo-slg-email-login woo-slg-email-input" placeholder="Escribe tu correo electrónico" />
		<input type="hidden" name="woo_slg_login_redirect_url" value="<?php echo $redirect_url; ?>">
		<input type="button" class="woo-slg-email-login-btn" value="Obtener código de acceso" title="<?php echo $login_btn_text; ?>" />
		<a href="https://asamblea.colombiahumana.co/delegados">Clic aquí si no recuerdas cuál correo registraste</a>
		<input type="button" id="woo-slg-email-login-btn-resend" class="woo-slg-email-login-btn-resend" value="" title="" />
		<div class="woo-slg-clear"></div>
	</div><!--.woo-slg-social-wrap-->

	<div class="woo-slg-login-email-error"></div><!--woo-slg-login-error-->
	<div class="woo-slg-login-success"></div><!--woo-slg-login-success-->


	<div class="woo_slg_email_login_using woo-slg-email-otp-section" style="margin: auto;">
		<span><legend><?php esc_html_e( 'Verify OTP', 'wooslg');?></legend></span>
		<?php wp_nonce_field( 'woo_slg_otp_verify', 'woo_slg_otp_nonce' ); ?>
		<input type="number" class="regular-text woo-slg-otp-login woo-slg-otp-input" placeholder="" />
		<br />
		<input type="button" class="woo-slg-email-login-btn-otp" value="<?php esc_html_e( 'Acceder al sistema', 'wooslg');?>" title="<?php echo $login_btn_text; ?>" />
		<div class="woo-slg-clear"></div>
	</div><!--.woo_slg_email_login_using-->

	<div class="woo-slg-login-email-otp-error"></div><!--woo-slg-login-error-->
	<div class="woo-slg-login-otp-success"></div>

	<div class="woo-slg-login-loader">
		<img src="<?php echo esc_url( WOO_SLG_IMG_URL ); ?>/social-loader.gif" alt="<?php esc_html_e( 'Social Loader', 'wooslg');?>"/>
	</div><!--.woo-slg-login-loader-->

	<?php if( !empty( $seprater_text ) && $position == 'top' ){?>
		<div class="woo-slg-horizontal-divider"><span><?php print $seprater_text;?></span></div>
	<?php } ?>		 
</div>