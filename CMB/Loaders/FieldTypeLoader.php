<?php

namespace MedusaContentSuite\CMB\Loaders;

class FieldTypeLoader
{
	public $vendorPath;
	public $fieldTypes;

	public function init( )
	{
		write_log( "FieldTypeLoader - init" );

		if ( ! defined( 'CMB2_LOADED' ) ) :

			throw new Exception( "Medusa Content Suite - FieldTypeLoader - CMB2 NOT LOADED" );

		else:
			
			write_log( "CMB2_LOADED" );

			$this->setVendorPath( );

			write_log( 'this->vendorPath : ' );
			write_log( $this->vendorPath );

			if ( file_exists( $this->vendorPath ) ) :

				$fieldTypes = $this->setFieldTypes( );

				write_log( 'this->fieldTypes : ' );
				write_log( $this->fieldTypes );

				//foreach( $fieldTypes as $ft ) :				

					/*
					if ( file_exists( $ft[''] ) ) :
						require_once  $vendorPath . '/WebDevStudiosXXX/cmb2/init.php';
					elseif ( file_exists( $vendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
						require_once  $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
					endif;
					*/

				//endforeach;

			else : 
				throw new Exception( "Medusa Content Suite - FieldTypeLoader - can't find vendor directory" );
			endif;






			$this->loadFieldTypes( );


		endif;		
	}

	public function loadFieldTypes( )
	{		
		write_log( "FieldTypeLoader > loadFieldTypes" );




	}

	public function setVendorPath( )
	{
		$filePath = plugin_dir_path( __FILE__ );
		$pluginPath = str_replace( "/CMB/Loaders", "", $filePath );
		$packageVendorPath = $pluginPath . "vendor";

		#TODO
		/*
			project vendor path needs setting up
		*/

		$this->vendorPath = $packageVendorPath;		
	}

	public function setFieldTypes( ){

		$fieldTypes = array(

			array(
				'vendor' => 'WebDevStudios',
				'name' => 'CMB2-Post-Search-field',
				'file' => 'cmb2_post_search_field.php',
			),	

			array(
				'vendor' => 'WebDevStudios',
				'name' => 'cmb2-attached-posts',
				'file' => 'cmb2-attached-posts-field.php',
			),

			array(
				'vendor' => 'mustardBees',
				'name' => 'cmb-field-gallery',
				'file' => 'cmb-field-gallery.php',
			),

			array(
				'vendor' => 'mustardBees',
				'name' => 'cmb-field-select2',
				'file' => 'cmb-field-select2.php',
			),

			array(
				'vendor' => 'mustardBees',
				'name' => 'cmb_field_map',
				'file' => 'cmb_field_map.php',
			),


		);

		$this->fieldTypes = $fieldTypes;

	}

}


