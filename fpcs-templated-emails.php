<?php
/*
 * Plugin Name: Templated Emails
 * Plugin URI: https://github.com/FPCSJames/fpcs-templated-emails
 * Version: 1.0.0
 * Description: Wrap emails in a nice template.
 * Author: James M. Joyce, Flashpoint Computer Services, LLC
 * Author URI: http://www.flashpointcs.net
 * License: MIT
 * License URI: https://fpcs.mit-license.org
 */
 
if(!defined('ABSPATH')) { exit; }

final class FPCS_Templated_Emails {

	public function __construct() {
		add_filter('wp_mail', array($this, 'email_template'));
		add_filter('wp_mail_content_type', function($type) { return 'text/html'; });
	}
	
	public function email_template($args) {
		
		$new = array(
			'to'          => $args['to'],
			'subject'     => $args['subject'],
			'message'     => $args['message'],
			'headers'     => $args['headers'],
			'attachments' => $args['attachments'],
		);
		
		/* Responsive email template by Mailgun: https://github.com/mailgun/transactional-email-templates
		 * Modifications by Flashpoint Computer Services, LLC
		 *
		 * Copyright (c) 2014 Mailgun - MIT license
		 */

		ob_start();?>	
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
			<head>
				<meta name="viewport" content="width=device-width" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<style type="text/css">
				img { max-width: 100%; }
				body { -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; }
				@media only screen and (max-width: 640px) {
				  body { padding: 0 !important; }
				  h1, h2, h3, h4 {font-weight: 800 !important; margin: 20px 0 5px !important; }
				  h1 { font-size: 22px !important; }
				  h2 { font-size: 18px !important; }
				  h3 { font-size: 16px !important; }
				  .container { padding: 0 !important; width: 100% !important; }
				  .content { padding: 0 !important; }
				  .content-wrap { padding: 10px !important; }
				}
				</style>
			</head>

			<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

				<table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
					<td class="container" width="600" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top"><br>
					<div style="text-align: center;"><a href="<?php echo home_url(); ?>"><!-- image --></a></div>
						<div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 10px 20px 0 20px;">
							<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
							<?php echo $args['message'];?>
							</td></tr></table>
							<div class="footer" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px 20px 0 20px;">
							<table width="100%" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">This message was automatically generated at <?php echo current_time('g:ia \o\n M d, Y'); ?>.</td></tr></table>
							</div>
						</div>
					</td>
					<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
				</tr></table>
				
			</body>
		</html>
		<?php
		$new['message'] = ob_get_clean();
		return $new;
	}
}

new FPCS_Templated_Emails();