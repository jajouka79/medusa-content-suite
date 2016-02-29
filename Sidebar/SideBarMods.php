<?php

namespace MedusaContentSuite\Sidebar;

use MedusaContentSuite\Functions\Common as Common;

class SidebarMods
{
	public function __construct()
	{
		#Common::write_log( " ModConfig > __construct " );
		
		add_action( 'init', array( $this, 'medusaConfigurationSidebars' ), 1 );
	}

	public function medusaConfigurationSidebars()
	{
		#Common::write_log( "medusa_configuration_sidebars()" );

		if ( function_exists( 'medusa_configuration_get_post_types_data' ) ):
			$pt_data=medusa_configuration_get_post_types_data( );
			#Common::write_log( $pt_data );
		endif;

		if ( function_exists( 'medusa_custom_sidebars_widgets_init' ) ):
			medusa_custom_sidebars_widgets_init( );
		endif;
	}

	public function medusa_configuration_sidebars_to_remove()
	{
		$remove = array(
			//'home-widget-1',
			//'home-widget-2',
			//'home-widget-3',
			//'top-widget',
			//'footer-widget',
			//'right-sidebar-half',
			//'left-sidebar-half',
			//'left-sidebar',
			//'right-sidebar',
			//'main-sidebar',
			//'gallery-widget',
			//'colophon-widget',
		);

		return $remove;
	}

}