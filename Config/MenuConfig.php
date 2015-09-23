<?php

namespace MedusaContentSuite\Config;

class MenuConfig
{

	public function init()
	{
		print("<ul><li>--------------------------------->---------------------------------MenuConfig > init</li></ul>");
		#add_action('init', array($this, 'getMenuConfig'), 1);
	}

	public function getMenuConfig()
	{
		$config = array(
			'menus'=>array(
				'locations' => array(
					'top-menu-location' => __( 'Top Menu Location' ),
					'main-menu-location' => __( 'Main Menu Location' ),
					'footer-menu-location' => __( 'Footer Menu Location' ),
				),
				'menus'=>array(
					'top-menu' => array(
						'name'=>__( 'Top Menu' ),
						'location'=>__( 'top-menu-location' ),
					),
					'main-menu' => array(
						'name'=>__( 'Main Menu' ),
						'location'=>__( 'main-menu-location' ),
					),
					'footer-menu' => array(
						'name'=>__( 'Footer Menu' ),
						'location'=>__( 'footer-menu-location' ),
					),
				)
			),
			'main_menu_id' => 13,
			'main_menu_name' => 'Main Menu',
		);
		//write_log( $MenuConfig);
		return $config;

	}


}