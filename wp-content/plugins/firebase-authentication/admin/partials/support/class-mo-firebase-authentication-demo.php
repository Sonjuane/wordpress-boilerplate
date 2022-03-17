<?php

	class Mo_Firebase_Authentication_Admin_Demo {

		public static function mo_firebase_authentication_handle_demo(){
			self::demo_request();
		}

		public static function demo_request(){

		?>
		<div class="row">
		<div class="col-md-12">
		<div class="mo_firebase_auth_card" style="width:100%">
			<h3><?php esc_html_e('Request for Demo','firebase-authentication'); ?></h3><hr>
			<p>
			<?php esc_html_e('Want to try out the paid features before purchasing the license? Just let us know which plan you\'re interested in and we will setup a demo for you.','firebase-authentication');?></p>
			<form method="post" action="">
				<input type="hidden" name="option" value="mo_fb_demo_request_form" />
				<?php wp_nonce_field('mo_fb_demo_request_form', 'mo_fb_demo_request_field'); ?>
				
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-3">
						<p style="margin-bottom: 3px"><strong><p style="display:inline;color:red;">*</p>Email ID: </strong></p>
					</div>
					<div class="col-md-6">
					<input name="mo_fb_demo_request_email" value="" placeholder="We will use this email to setup the demo for you" style="width:80%; font-size: 14px;" type="email" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-3">
						<p style="margin-bottom: 3px"><strong><p style="display:inline;color:red;">*</p>Request a demo for: </strong></p>
					</div>
					<div class="col-md-6">
						<select required name="mo_fb_demo_request_plan" id="mo_fb_demo_plan" style="width:80%; font-size: 14px;" >
								<option disabled selected>------------------ Select ------------------</option>
								<option value="mo-firebase-authentication-premium-plan">WP Firebase Authentication Premium Plugin</option>
								<option value="mo-firebase-authentication-enterprise-plan">WP Firebase Authentication Enterprise Plugin</option>
								<option value="Not Sure">Not Sure</option>
							</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-3">
						<p style="margin-bottom: 3px"><strong><p style="display:inline;color:red;">*</p>Usecase: </strong></p>
					</div>
					<div class="col-md-6">
					<textarea type="text" minlength="15" name="mo_fb_demo_request_usecase" value="" placeholder="Example: WooCommerce Integration, WP Login with Firebase credentials for my Mobile App users, Firebase social login for my WordPress, etc" style="width:80%; font-size: 14px;" rows="4" required></textarea>
					</div>
				</div>
				<br>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<input type="submit" style="text-align:center; font-size: 14px; font-weight: 400;" class="button button-primary button-large" name="submit" value="Submit Demo Request" ><br>
						</div>
					</div>
					<br>

				<!--<table class="mo_fb_demo_table_layout" cellpadding="4" cellspacing="4">
					<tr>
						<td><strong><p style="display:inline;color:red;">*</p>Email ID:</strong>
						</td>
						<td>
							<input type="email" style="width: 350px; height:35px;" name="mo_demo_request_email" placeholder="We will use this email to setup the demo for you" value="">
						</td>
					</tr>
				</table> -->
			</form>
		</div>
		</div>
		</div>
		<?php
		}
	}


