<?php

namespace MedusaContentSuite\Taxonomy;

use MedusaContentSuite\Config\TaxConfig as TaxConfig;
use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Post\PostTypes as PostTypes;
use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;

class TaxTypes extends \MedusaContentSuite\MedusaContentSuite
{
	public $tax;
	public $pt;

	public static $Globals;

	public function __construct( )
	{
		self::$Globals = parent::getGlobals( );

		#Common::write_log( self::$Globals );
		#Common::write_log( "TaxTypes __construct" );
		add_action( 'init', array( $this, 'registerTaxTypes' ), 1 );
		add_action( 'admin_menu', array( $this, 'removeTaxonomyMetaBox' ), 1 );
	}


	public function getTaxTypesForPt( $type )
	{
		$TaxConfig = self::$Globals->taxConfig;
	}


	public function registerTaxTypes( )
	{
		$TaxConfig = self::$Globals->taxConfig;

		foreach ( $TaxConfig as $tc ) :			
			#Common::write_log( $tc );
			#Common::write_log( $tc['tax'] );
			if( ! empty ( $tc['pt'] ) ) :
				$pts = array( );
				foreach ( $tc['pt'] as $pt ) :
					#Common::write_log( $pt );
					if ( ! empty ( $pt ) ) : 
						$pts[] = $pt['id'];
					endif;
				endforeach;
				#Common::write_log(  $tc['tax'], $pts, $tc['args'] );
				register_taxonomy( $tc['tax'], $pts, $tc['args'] );
			endif;
		endforeach;

		return $TaxConfig;
	}


	public function removeTaxonomyMetaBox( )
	{
		Common::write_log( "removeTaxonomyMetaBox( )" );

		$TaxConfig = self::$Globals->taxConfig;
		
		foreach( $TaxConfig as $tc ) :
			$tax = $tc['tax'];
			#$fieldTypes = $tc['fields'];
			if( ! empty ( $tc['pt'] ) ) :
				foreach( $tc['pt'] as $pt ) :
					#Common::write_log( $pt );
					if( ! empty ( $pt ) ) :

						#Common::write_log( $pt );
						#Common::write_log( $pt['id'] . " - " . $pt['show_tax_meta'] );
						#Common::write_log( $pt['show_tax_meta'] );

						#$test = PostTypes::getPostConfigByPostType( $pt['id'] );
						#$postMetaConfig = PostMeta::getPostMetaConfigByPostType( $pt['id'] );

						# use $tax var with pt var
						# are there any taxonomy fields in given tax attached to given pt
						# gu

						/*if( $pt['id'] == "class" ) : #tmp

							#$this->checkPostMetaFieldsTaxonomy( $pt['id'], $tax );

							Common::write_log( 'postMetaConfig :' );
							Common::write_log( $postMetaConfig );						

						endif;*/

						if( ! $pt['show_tax_meta'] ) :
							#Common::write_log( "removing " . $tax . " meta box from post type : " . $pt['id'] );
							\remove_meta_box( 'tagsdiv-'.$tax, $pt, 'side' );
						endif;
					endif;
				endforeach;
			endif;
		endforeach;
	}


	public function checkPostMetaFieldsTaxonomy( $pt, $tax )
	{
		Common::write_log( 'checkPostMetaFieldsTaxonomy' );
		Common::write_log( 'pt - ' . $pt);
		Common::write_log( 'tax - ' . $tax );

		return true;
	}

	/*
	public function meta_boxes_function( )
	{
		$tax = $this->tax;
		write_log("xxxxxxx - ". $tax);
    	\add_meta_box($tax.'divXXX', $tax, 'post_'.$tax.'_meta_box', 'blurb', 'side', null, array( 'taxonomy' => $tax ));
	
	}
	*/


	/*public function remove_taxonomy_boxes( )
	{

		return false;

		global $tx_data;
		global $pt_data;

		for($x=0; $x<count($tx_data); $x++):

			if(isset($tx_data[$x]['types'])):

				if($tx_data[$x]['types']):
					$num_types=count($tx_data[$x]['types']);
					$tax_id='';

					if($tx_data[$x]['args']['hierarchical']==true):
						$tax_id=$tx_data[$x]['tax'].'div';
					else:
						$tax_id='tagsdiv-'.$tx_data[$x]['tax'];
					endif;

					for($y=0; $y<$num_types; $y++):

						if($tx_data[$x]['types'][$y]['show_tax_meta'] == false):
							remove_meta_box($tax_id, $tx_data[$x]['types'][$y]['id'], 'side');
						endif;

					endfor;

				endif;

			endif;

		endfor;

	}	
	*/

}