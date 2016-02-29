<?php

namespace MedusaContentSuite\Config;
 
class MainConfig
{

	public function init()
	{
		#print("<ul><li>MainConfig > init</li></ul>");
		#add_action('init', array($this, 'getMainConfig'), 5);
	}

	public function getMainConfig()
	{
		$config = array(
			'posts_enabled' => false,
			'pages_enabled' => true,
			'pages_excerpt' => false,
			'has_products' => false,
			'product_base_page_id' => false,
			'copy_home_page_for_sub_sites' => true,
			'show_home_in_nav_menu' => true,
			'error_page_id' => 8,
		);

		//write_log( $config );

		return $config;

	}


}