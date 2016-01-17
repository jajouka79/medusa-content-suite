<?php
namespace MedusaContentSuite\CMB\Meta;

use MedusaContentSuite\Config\TaxMetaConfig as TaxMetaConfig;

class TaxMeta
{
	public $taxMetaConfig;

	public function init( )
	{
		add_action( 'cmb2_admin_init', array( $this, 'registerTaxMeta' ), 110);
		$this->setTaxMetaConfig( );
	}

	public function setTaxMetaConfig( )
	{
		#write_log( "TaxMeta -> setTaxMetaConfig" );

		$taxMetaConfig = new TaxMetaConfig;
		$taxMetaConfig->init( );
		$taxMetaConfig = $taxMetaConfig->taxMetaConfig;
		$this->taxMetaConfig = $taxMetaConfig;

	}

	public function registerTaxMeta( )
	{		
		#write_log( "TaxMeta -> registerTaxMeta" );
		#write_log( $this->taxMetaConfig );
		
		$x = 0;
		if ( ! empty ( $this->taxMetaConfig ) ) :

			foreach( $this->taxMetaConfig as $mc ) :

				if ( ! empty ( $mc ) ) :

					$box_config = $mc['box_config'];

					#write_log( $box_config );

					$box_fields = $mc['fields'];

					#write_log( "dddddddd" );
					#write_log( count ( $box_fields ) );

					//unset( $box_config['fields'] );
					
					#${"cmb_tax_metabox_" . $x} = new_cmb2_box( $box_config );
					#new_cmb2_box( $box_config );
					$cmb_tax_metabox = \new_cmb2_box( $box_config );
					#write_log ( ${"cmb_tax_metabox_" . $x} );

					foreach ( $box_fields as $f ) :
						#${"cmb_tax_metabox_" . $x}->add_field( $f );
						$cmb_tax_metabox->add_field( $f );
					endforeach;
					
					$x++;

				endif;

			endforeach;

		endif;

	}


	/*public function jw_remove_taxonomy_description( $columns ){

	    write_log( "cat field funk" );
	    write_log( $columns );

	    // only edit the columns on the current taxonomy, replace category with your 
	    // custom taxonomy (don't forget to change in the filter as well)
	    if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'news_category' )
	    return $columns;

	    // unset the description columns
	    if ( $posts = $columns['description'] ){ unset($columns['description']); }

	    return $columns;

	}*/

}