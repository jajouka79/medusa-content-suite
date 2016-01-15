<?php
namespace MedusaContentSuite\CMB\Meta;

use MedusaContentSuite\Config\TaxMetaConfig as TaxMetaConfig;

class TaxMeta
{
	public function init( )
	{
		add_action( 'cmb2_admin_init', array( $this, 'registerTaxMeta' ), 110);
	}

	public function getTaxMetaConfig( )
	{
		$TaxMetaConfig = new TaxMetaConfig;
		$TaxMetaConfig = $TaxMetaConfig->getTaxMetaConfig( );
		return $TaxMetaConfig;
	}

	public function registerTaxMeta( )
	{		
		write_log( "TaxMeta -> registerTaxMeta" );
		
		$TaxMetaConfig = $this->getTaxMetaConfig( );

		foreach( $TaxMetaConfig as $mc ) :

			$box_config = $mc['box_config'];

			write_log( $box_config );

			$box_fields = $mc['fields'];

			unset( $box_config['fields'] );

			$cmb_demo = new_cmb2_box( $box_config );

			foreach ( $box_fields as $f ) :
				$cmb_demo->add_field( $f );
			endforeach;

		    /*
		    $wlo_overrides = array(
		        'get_option'    => 'wlo_get_option',
		        'update_option' => 'wlo_update_option',
		        'delete_option' => 'wlo_delete_option',
		    );
		    */

		    /*
		    $cats = new \Taxonomy_MetaData_CMB2( 
		    	$box_config['tax_types'][0],
		    	$box_config['id'],
		    	__( 'Category Settings', 'taxonomy-metadata' ), 
		    	$wlo_overrides 
		    );
		    */

			//write_log( $cmb_demo );
		
		endforeach;

		//add_action( 'cmb2_admin_init', 'yourprefix_register_taxonomy_metabox' );

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