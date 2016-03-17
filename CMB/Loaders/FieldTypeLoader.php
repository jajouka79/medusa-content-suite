<?php

namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\MedusaContentSuite as MedusaContentSuite;
use MedusaContentSuite\Config\Paths as Paths;

class FieldTypeLoader
{
	public $fieldTypes;
	public $Globals;

	public function __construct( $Globals )
	{		
		$this->Globals = $Globals;
		$this->loadFieldTypes();
	}


	public function loadFieldTypes( )
	{
		$vendorPath = $this->Globals->activeVendorPath;		

		$fieldTypes = $this->setFieldTypes( );

		foreach( $this->fieldTypes as $ft ) :
			$fieldTypePackagePath = $vendorPath . '/'  . $ft['vendor'] . '/' . $ft['name'] . '/' . $ft['file'];

			if ( file_exists( $fieldTypePackagePath ) ) :
				require_once $fieldTypePackagePath;
			else:
				#write_log( "*****************FILE MISSING" );
			endif;

		endforeach;
	}

	/*
	public static function getFieldTypes( )
	{
		return self::$fieldTypes;
	}
	*/

	public function setFieldTypes( )
	{


		$fieldTypes = array(

			array(
				'vendor' => 'JayWood',
				'name' => 'CMB2_RGBa_Picker',
				'file' => 'jw-cmb2-rgba-colorpicker.php',
			),

			array(
				'vendor' => 'Mte90',
				'name' => 'CMB2-User-Search-field',
				'file' => 'cmb2_user_search_field.php',
			),

			#not working - load as wp plugin instead for now
			/*array(
				'vendor' => 'WebDevStudios',
				'name' => 'CMB2-Date-Range-Field',
				'file' => 'wds-cmb2-date-range-field.php',
			),*/	

			array(
				'vendor' => 'WebDevStudios',
				'name' => 'CMB2-Post-Search-field',
				'file' => 'cmb2_post_search_field.php',
			),	

			array(
				'vendor' => 'jcchavezs',
				'name' => 'cmb2-conditionals',
				'file' => 'cmb2-conditionals.php',
			),

			array(
				'vendor' => 'mattkrupnik',
				'name' => 'cmb2-field-slider',
				'file' => 'cmb2_field_slider.php',
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
				'file' => 'cmb-field-map.php',
			),

			array(
				'vendor' => 'WebDevStudios',
				'name' => 'CMB2-Remote-Image-Select-Field',
				'file' => 'cmb2-remote-img-sel.php',
			),
		);

		$this->fieldTypes = $fieldTypes;
	}
}


