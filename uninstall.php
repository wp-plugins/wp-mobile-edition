<?php
/**
 * Code used when the plugin is removed (not just deactivated but actively deleted through the WordPress Admin).
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit ();

//Settings
delete_option('fdx3_updater_options');
delete_option('fdx_db_options');
delete_option('fdx_sitemap_time');
