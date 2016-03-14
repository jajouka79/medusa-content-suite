<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Config\MenuConfig as MenuConfig;
use MedusaContentSuite\Functions\Common as Common;

class Menus{

	public $menuConfig;

	public function __construct()
	{

		$MenuConfig = new MenuConfig;
		$MenuConfig->setMenuConfig( );
		$this->menuConfig = $MenuConfig->menuConfig;

		#Common::write_log( 'this->menuConfig' );
	    #Common::write_log( $this->menuConfig );


		add_action( 'init', array( $this, 'registerMenus' ), 20 );
		add_action( 'init', array( $this, 'registerMenuLocations' ), 10 );
	}

	public function registerMenuLocations( )
	{
	    #Common::write_log( "registerMenuLocations()" );

	    #if( !is_main_site( ) ): return; endif;
		$config = $this->menuConfig;

	    /*Common::write_log( 'config' );
	    Common::write_log( $config );*/

	    if( ! $config ) :
	    	#Common::write_log( "return false!!!" );
	        return false;
	    endif;

	    $locations = $config['menus']['locations'];

	    #Common::write_log( "registerMenuLocations() - END" );

	    #register_nav_menus( $locations );
	}


	public function registerMenus( )
	{
	    #write_log('registerMenus( )');


		$config = $this->menuConfig;

	    /*Common::write_log( 'config' );
	    Common::write_log( $config );*/

	    $menus = $config['menus']['menus'];

	    if( ! $config ) : return false; endif;

	    if( $menus ) :
	        foreach( $menus as $menu ):
	            $menu_exists = wp_get_nav_menu_object( $menu['name'] );

	            if(!$menu_exists):
	                $menu_id=wp_create_nav_menu( $menu['name'] );
	            else:
	                $menu_id=$menu_exists->term_id;
	            endif;

	            $location[$menu['location']] = $menu_id;
	            set_theme_mod('nav_menu_locations', $location );
	        endforeach;
	    endif;

	    #write_log( 'registerMenus - END' );


	}








	/*add_action('wp_update_nav_menu', 'my_get_menu_items');
	function my_get_menu_items($nav_menu_selected_id) {
	    write_log("my_get_menu_items(nav_menu_selected_id) - " . $nav_menu_selected_id);

	    global $pt_menu_items;

	    write_log('pt_menu_items:');
	    write_log($pt_menu_items);

	    $source = wp_get_nav_menu_object( $nav_menu_selected_id );
	    $source_items   = wp_get_nav_menu_items( $nav_menu_selected_id );

	    write_log("source :- ");
	    write_log($source );

	    write_log("source_items :- ");
	    write_log($source_items );
	}*/




}