<?php
namespace MedusaContentSuite\CMB\Meta;
#use MedusaContentSuite as MedusaContentSuite;
use MedusaContentSuite\Config\TaxMetaConfig as TaxMetaConfig;

class TaxMeta
{
	public function init( )
	{
		add_action( 'cmb2_init', array( $this, 'registerTaxMeta' ) );
	}

	public function getTaxMetaConfig( )
	{
		$TaxMetaConfig = new TaxMetaConfig;
		$TaxMetaConfig = $TaxMetaConfig->getTaxMetaConfig( );
		return $TaxMetaConfig;
	}


	public function registerTaxMeta( )
	{		
		#echo "registerTaxMeta( )<br><br>";
		
		$TaxMetaConfig = $this->getTaxMetaConfig( );
		
		foreach ( $TaxMetaConfig as $mc ) :

			$box_config = $mc;
			$box_fields = $mc[ 'fields' ];
			unset( $box_config[ 'fields' ] );

			#print( "<br><br>" );
			#print_r( $box_config );

			$cmb_demo = new_cmb2_box( $box_config );

			foreach ( $box_fields as $f ) :
				$cmb_demo->add_field( $f );
				#print( "<br><br>" );
				#print_r( $f );
			endforeach;

			#break;

		endforeach;

	}

}