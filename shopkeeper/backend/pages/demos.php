<?php add_thickbox(); ?>

<div class="wrap about-wrap getbowtied-about-wrap">

	
    <?php require_once('global/pages-header.php'); ?>

    <!-- 	<div class="updated error importer-notice importer-notice-1" style="display: none;">
		<p><strong><?php echo __( "We're sorry but the demo data could not import. It is most likely due to low PHP configurations on your server.", 'getbowtied' ); ?></strong></p>
		<p><?php echo sprintf( __( 'Please use %s to factory reset your Wordpress , then come back and retry.', 'getbowtied' ), '<a href="' . admin_url() . 'plugin-install.php?tab=plugin-information&amp;plugin=wordpress-reset&amp;TB_iframe=true&amp;width=850&amp;height=450' . '" class="button-primary thickbox" title="">WordPress Reset Plugin</a>' ); ?></p>
	</div> -->

	<?php

	if ( class_exists( 'RegenerateThumbnails' ) ) :

		$regenerate_thumbnails_link = admin_url() . "tools.php?page=regenerate-thumbnails";
		$regenerate_thumbnails_class = "";
	
	else :

		$regenerate_thumbnails_link = admin_url() . "plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=850&amp;height=450";
		$regenerate_thumbnails_class = "thickbox";

	endif;

	?>

	<?php 
		$go = true;

		if (!is_plugin_active('js_composer/js_composer.php')) $go = false;
		if (!is_plugin_active('woocommerce/woocommerce.php')) $go = false;

		$mem = intval(substr(ini_get('memory_limit'), 0, -1));
		if ($mem < 256) $go = false; 
		$exec = intval(ini_get('max_execution_time'));
		if ($exec < 300) $go = false; 
		$upl = intval(substr(size_format( wp_max_upload_size() ), 0, -1));
		if ($upl < 128 ) $go = false; 
		if ( ! (function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) ) 
		{
			$go = false;
			$fsockopen = true;
		}
		$posting['gzip']['name'] = 'GZip';
		if (  !is_callable( 'gzopen' ) ) 
		{
			$go = false;
		} 
		// WP Remote Get Check
		$posting['wp_remote_get']['name'] = __( 'Remote Get', 'woocommerce');
		$response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

		if ( !( !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) )
		{
			$go = false;
		}

	?>
	


	<div class="getbowtied-themes-demo">

		<div class="import-success importer-notice importer-notice-2" style="display: none">
			<p>
				<?php echo __( 'The demo content has been imported successfully. <a href="'.site_url().'" target="_blank"> View Site</a>', 'getbowtied' ); ?> 
			</p>
		</div>

		<div class="import-error import-failed" style="display: none">
			<p><span class="dashicons dashicons-warning"></span>&nbsp;&nbsp;<?php _e( 'The demo importing process failed. Please check the <a href="javascript:void(0)" class="status_toggle2">System Status</a>. It should help you understand if some of the requirements aren’t met. ', 'getbowtied' ); ?></p>
		</div>


		<div class="toggle-tabs">
			<a href="javascript:void(0)" id="demo_toggle" class="active"><?php _e('Importable Demo', 'getbowtied'); ?></a>
			<span class="sep">|</span>
			<?php 
				if (!$go):
					echo '<a href="javascript:void(0)" id="status_toggle" class="error">';
					echo '<mark class="error">';
					echo '<span class="dashicons dashicons-warning"></span>';
					_e('System Status', 'getbowtied');
					echo '</mark>';
				else:
					echo '<a href="javascript:void(0)" id="status_toggle">';
					_e('System Status', 'getbowtied');
				endif;
			?>
			</a>
		</div> 

		<div class="demo-tab theme-browser rendered">

		<?php if (!$go): ?>
		<div class="import-error">
			<p><span class="dashicons dashicons-warning"></span>&nbsp;&nbsp;<?php _e( 'Please check the <a href="javascript:void(0)" class="status_toggle2">System Status</a> before importing the demo content to make sure the importing process won’t fail.', 'getbowtied' ); ?></p>
		</div> 
		<?php endif; ?>

			<div class="themes">
				<?php if (THEME_SLUG == 'mr_tailor'): ?>

					<!-- Default -->
					<div class="theme">
						
						<div class="theme-screenshot">
							<img src="<?php echo $getbowtied_settings['demo_image']; ?>" alt="">
						</div>
						
						<h3 class="theme-name" id="default"><?php echo __( "Main Demo", "getbowtied" ); ?></h3>
						
						<div class="theme-actions">
							<?php printf( '<a class="button button-primary getbowtied-install-demo-button" data-demo-id="default" href="#">%1s</a>', __( "Install", "getbowtied" ) ); ?>
							<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', $getbowtied_settings['dummy_data_preview'], __( "Live Preview", "getbowtied" ) ); ?>
						</div>
						
						<div class="demo-import-loader preview-all"></div>
						
						<div class="demo-import-loader preview-default"><i class="dashicons dashicons-admin-generic"></i></div>
					
					</div>

					<div class="theme">
					
						<div class="theme-screenshot">
							<img src="<?php echo $getbowtied_settings['demo_image_indie']; ?>" alt="">
						</div>
						
						<h3 class="theme-name" id="default"><?php echo __( "Indie Store", "getbowtied" ); ?></h3>
						
						<div class="theme-actions">
							<?php printf( '<a class="button button-primary getbowtied-install-demo-button" data-demo-id="indie-store" href="#">%1s</a>', __( "Install", "getbowtied" ) ); ?>
							<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', $getbowtied_settings['dummy_data_preview_indie'], __( "Live Preview", "getbowtied" ) ); ?>
						</div>
						
						<div class="demo-import-loader preview-all"></div>
						
						<div class="demo-import-loader preview-indie-store"><i class="dashicons dashicons-admin-generic"></i></div>
				
					</div>


					<div class="theme">
					
						<div class="theme-screenshot">
							<img src="<?php echo $getbowtied_settings['demo_image_startup']; ?>" alt="">
						</div>
						
						<h3 class="theme-name" id="default"><?php echo __( "Startup", "getbowtied" ); ?></h3>
						
						<div class="theme-actions">
							<?php printf( '<a class="button button-primary getbowtied-install-demo-button" data-demo-id="startup" href="#">%1s</a>', __( "Install", "getbowtied" ) ); ?>
							<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', $getbowtied_settings['dummy_data_preview_startup'], __( "Live Preview", "getbowtied" ) ); ?>
						</div>
						
						<div class="demo-import-loader preview-all"></div>
						
						<div class="demo-import-loader preview-startup"><i class="dashicons dashicons-admin-generic"></i></div>
				
					</div>
				<?php else: ?>
					<!-- Default -->
					<div class="theme">
						
						<div class="theme-screenshot">
							<img src="<?php echo $getbowtied_settings['demo_image']; ?>" alt="">
						</div>
						
						<h3 class="theme-name" id="default"><?php echo getbowtied_theme_name() . " - " . __( "Default Demo", "getbowtied" ); ?></h3>
						
						<div class="theme-actions">
							<?php printf( '<a class="button button-primary getbowtied-install-demo-button" data-demo-id="default" href="#">%1s</a>', __( "Install", "getbowtied" ) ); ?>
							<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', $getbowtied_settings['dummy_data_preview'], __( "Live Preview", "getbowtied" ) ); ?>
						</div>
						
						<div class="demo-import-loader preview-all"></div>
						
						<div class="demo-import-loader preview-default"><i class="dashicons dashicons-admin-generic"></i></div>
					
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- STAGING DEMO CHECKLIST -->
		<div class="demo-tab status-holder">
			<?php 
				$plugins = TGM_Plugin_Activation::$instance->plugins;
				// var_dump($plugins);

			?>
			<table class="demo-import-status" cellspacing="0">
				<thead>
					<tr>
						<td><?php _e( 'Required Plugins', 'getbowtied'); ?></td>
						<td></td>
					</tr>
				</thead>
				<?php
				foreach( $plugins as $plugin ):
					$file_path = $plugin['file_path'];
					$active = is_plugin_active( $file_path );
				?>
					<tr>
						<td><?php echo $plugin['name']; ?></td>
						<td><?php 
								if($active):
									echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
								else: 
								 	echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ';
								 	_e('<span>Not installed/activated.</span> Please go to the <a href="'.admin_url( 'admin.php?page=' . $plugins_page ).'">Plugins tab</a> to install/activate it.', 'getbowtied');
								    echo '</mark>';  
								endif;
							?>
						</td>
					</tr>

				<?php 
				endforeach;		
				?>
			</table>

			<table class="demo-import-status" cellspacing="0">
				<thead>
					<tr>
						<td><?php _e( 'Server Environment', 'getbowtied' ); ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if ( function_exists( 'ini_get' ) ) : ?>
						<tr>
							<td data-export-label="Server Memory Limit">
								<?php _e( 'Server Memory Limit', 'getbowtied' ); ?>:
							</td>
							<td>
								<?php
									$mark = $mem >= 256 ? 'yes' : 'error'; 
								?>

								<?php if ($mark == 'yes'): ?>
									<mark class="<?php echo $mark; ?>">
											<span class="dashicons dashicons-yes"></span><?php echo ini_get('memory_limit'); ?>
									</mark>
								<?php else: ?>
									<mark class="<?php echo $mark; ?>">
											<span class="dashicons dashicons-warning"></span>  <span><?php echo ini_get('memory_limit'); ?></span>. 
											<?php _e('The recommended value is 256M. <a target="_blank" href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#server-memory-limit">How to increase the Server Memory Limit?</a>', 'getbowtied'); ?>
									</mark>
								<?php endif; ?>

							</td>
						</tr>
						<tr>
							<td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'woocommerce' ); ?>:</td>
							<td>
								<?php
									$mark = $exec >= 300 ? 'yes' : 'error'; 
								?>
				
								<?php if ($mark == 'yes'): ?>
									<mark class="<?php echo $mark; ?>">
											<span class="dashicons dashicons-yes"></span><?php echo ini_get('max_execution_time'); ?>
									</mark>
								<?php else: ?>
									<mark class="<?php echo $mark; ?>">
											<span class="dashicons dashicons-warning"></span>  <span><?php echo ini_get('max_execution_time'); ?></span>. 
											<?php _e('The recommended value is 300. <a target="_blank" href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#php-time-limit">How to increase PHP Time Limit?</a>', 'getbowtied'); ?>
									</mark>
								<?php endif; ?>

							</td>
						</tr>
					<?php endif; ?>
					<tr>
						<td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'woocommerce' ); ?>:</td>
						<td>
							<?php

								$mark = $upl >= 128 ? 'yes' : 'error'; 
							?>
							<!-- <mark class="<?php echo $mark; ?>">
									<?php echo $upl >= 128 ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-warning"></span>'; ?>  <?php echo size_format( wp_max_upload_size() ); ?>
							</mark> -->

							<?php if ($mark == 'yes'): ?>
								<mark class="<?php echo $mark; ?>">
										<span class="dashicons dashicons-yes"></span><?php echo size_format( wp_max_upload_size() ); ?>
								</mark>
							<?php else: ?>
								<mark class="<?php echo $mark; ?>">
										<span class="dashicons dashicons-warning"></span>  <span><?php echo size_format( wp_max_upload_size() ); ?></span>. 
										<?php _e('The recommended value is 128M. <a target="_blank" href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#max-upload-size">How to increase the Max Upload Size?</a>', 'getbowtied'); ?>
								</mark>
							<?php endif; ?>
						</td>
					</tr>
					<?php
						$posting = array();

						// fsockopen/cURL
						$posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
						$posting['fsockopen_curl']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services.', 'woocommerce' ) . '">[?]</a>';

						if (  (function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) ) {
							$posting['fsockopen_curl']['success'] = true;
						} else {
							$posting['fsockopen_curl']['success'] = false;
							$posting['fsockopen_curl']['note']    = 'Disabled. <a target="_blank" href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#curl">How to enable cURL extension in PHP?</a>';
						}

						// GZIP
						$posting['gzip']['name'] = 'GZip';
						
						if ( is_callable( 'gzopen' ) ) {
							$posting['gzip']['success'] = true;
						} else {
							$posting['gzip']['success'] = false;
							$posting['gzip']['note']    = 'Disabled. <a href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#gzip" target="_blank">How to Enable Gzip compression for your site?</a>';
						}

						// WP Remote Get Check
						$posting['wp_remote_get']['name'] = __( 'Remote Get', 'woocommerce');
						$response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

						if (  !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
							$posting['wp_remote_get']['success'] = true;
						} else {
							$posting['wp_remote_get']['note']    = 'Disabled. <a href="https://shopkeeper-help.zendesk.com/hc/en-us/articles/207587679#remote-get" target="_blank">How to enable Remote Get?</a>';
							
							$posting['wp_remote_get']['success'] = false;
						}

						$posting = apply_filters( 'woocommerce_debug_posting', $posting );

						foreach ( $posting as $post ) {
							$mark = ! empty( $post['success'] ) ? 'yes' : 'error';
							?>
							<tr>
								<td data-export-label="<?php echo esc_html( $post['name'] ); ?>"><?php echo esc_html( $post['name'] ); ?>:</td>
								<td>
									<mark class="<?php echo $mark; ?>">
										<?php echo ! empty( $post['success'] ) ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-warning"></span>'; ?> 
										<span><?php echo ! empty( $post['note'] ) ? __( $post['note'] ) : ''; ?></span>
									</mark>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>

	</div>
</div>

