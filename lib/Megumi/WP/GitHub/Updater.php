<?php

namespace Megumi\WP\GitHub;

class Updater {

	private $config = array();

	public function __construct( $plugin_file_name )
	{
		$this->config = get_file_data( $plugin_file_name );

		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	public function plugins_loaded()
	{
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'api_check' ) );
		add_filter( 'plugins_api', array( $this, 'get_plugin_info' ), 10, 3 );
		add_filter( 'upgrader_post_install', array( $this, 'upgrader_post_install' ), 10, 3 );
		add_filter( 'http_request_timeout', array( $this, 'http_request_timeout' ) );
		add_filter( 'http_request_args', array( $this, 'http_request_sslverify' ), 10, 2 );
	}
}
