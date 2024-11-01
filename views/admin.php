<![CDATA[ Tumblr Button For WordPress 1.0 ]]>
<?php $options = get_option('tumblr-button-for-wordpress'); ?>

<div class="wrap">
	<h2>
		<?php _e('Tumblr Button For WordPress', 'tumblr-button-for-wordpress'); ?>
	</h2>
	<div class="postbox tumblr-postbox">
		<h3 class="tumblr-for-wordpress-heading">
			<?php _e('Select Your Button', 'tumblr-button-for-wordpress'); ?>
		</h3>
		<div class="inside">
			<fieldset class="left">
				<legend>
					<?php _e('Buttons', 'tumblr-button-for-wordpress'); ?>
				</legend>
				<p class="description">
					<?php _e("Tumblr Button for WordPress makes it easy to include the Tumblr Sharing button at the bottom of each of your individual posts. Select your button, save, and you're done!", 'tumblr-button-for-wordpress'); ?>
				</p>
				<form method="post" action="" id="tumblr-button-configuration">
					<ul>
						<?php for($i = 1; $i <= 8; $i++) { ?>
							<li>
								<input type="radio" id="tumblr-button[tumblr_button_<?php echo $i; ?>]" name="tumblr-button" value="button-<?php echo $i; ?>" <?php checked("button-$i" == $options['tumblr-button-for-wordpress-selected']); ?> />
								<?php if($i > 4) { ?>
									<img src="<?php echo WP_PLUGIN_URL ?>/tumblr-button-for-wordpress/images/share_<?php echo 9 - $i; ?>T.png" alt="<?php _e('Share on Tumblr', 'tumblr-button-for-wordpress'); ?>" />	
								<?php } else { ?>
									<img src="<?php echo WP_PLUGIN_URL ?>/tumblr-button-for-wordpress/images/share_<?php echo $i; ?>.png" alt="<?php _e('Share on Tumblr', 'tumblr-button-for-wordpress'); ?>" />	
								<?php } // end if ?>
							</li>
						<?php } // end for ?>
					</ul>
					<p class="submit" id="tumblr-button-submit">
						<?php wp_nonce_field('tumblr-button-for-wordpress', 'tumblr-button-for-wordpress-admin'); ?>
						<input type="submit" id="submit" name="submit" value="<?php _e('Save', 'tumblr-button-for-wordpress'); ?>" />
					</p><!-- /tumblr-button-submit -->
				</form><!-- /tumblr-button-configuration -->
			</fieldset>
			<div class="more-info">
				<p>
					<?php _e('Feel free to <a href="http://twitter.com/moretom">follow me on Twitter</a> or <a href="http://tommcfarlin.com">drop by my website</a>, or check out the rest of my plugins <a href="http://profiles.wordpress.org/users/tommcfarlin/">here</a>.', 'tumblr-button-for-wordpress'); ?>
				</p>
			</div>
		</div>
	</div>
</div>