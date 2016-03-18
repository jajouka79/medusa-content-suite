<?php


		$config = array(
			'menus'=>array(
				'locations' => array(
					'top-menu-location' => __( 'Top Menu Location' ),
					'footer-menu-location' => __( 'Footer Menu Location' ),
				),
				'menus'=>array(
					'main-menu' => array(
						'name'=>__( 'Main Menu' ),
						'location'=>__( 'primary_navigation' ),
					),
					'top-menu' => array(
						'name'=>__( 'Top Menu' ),
						'location'=>__( 'top-menu-location' ),
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