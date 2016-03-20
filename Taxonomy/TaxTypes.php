<?php

namespace MedusaContentSuite\Taxonomy;

use MedusaContentSuite\Config\TaxConfig as TaxConfig;
use MedusaContentSuite\Functions\Common as Common;

class TaxTypes extends \MedusaContentSuite\MedusaContentSuite
{
	public $tax;
	public $pt;

	public static $Globals;

	public function __construct( )
	{
		self::$Globals = parent::getGlobals( );

		#Common::write_log( self::$Globals );

		#return;

		add_action( 'init', array( $this, 'registerTaxTypes' ), 1 );
		#add_action( 'admin_init', array( $this, 'remove_taxonomy_boxes' ), 1 );
	}

	public function getTaxTypesForPt( )
	{

	}


	public function registerTaxTypes( )
	{
		#write_log("registerTaxTypes( )");
		global $blog_id;

		//$TaxConfig =  $this->getTaxConfig( );
		$TaxConfig = self::$Globals->taxConfig;

		#Common::write_log( $TaxConfig );

		foreach ( $TaxConfig as $tc ) :
			
			#Common::write_log( $tc );
			Common::write_log( $tc );

			if( ! empty ( $tc['pt'] ) ) :

				$pt = array( );

				foreach ( $tc['pt'] as $t ) :
					#write_log($t);
					if ( ! empty ( $t ) ) : 
						$pt[] = $t['id'];
					endif;

				endforeach;

				register_taxonomy( $tc['tax'], $pt, $tc['args'] );

				if( $t['show_tax_meta'] ) :
					Common::write_log($tc['tax'] . " - TRUE");

					$this->tax = $tc['tax'];
					add_action( 'admin_menu', array( $this, 'remove_tax_metabox' ) );
				endif;

			endif;

		endforeach;

		return $TaxConfig;

	}

	public function remove_tax_metabox() {

		
		$tax = $this->tax;
		Common::write_log( "tax  - " . $tax );
		remove_meta_box( 'tagsdiv-'.$tax, 'post', 'side' );
	}

	/*public function meta_boxes_function() {
		$tax = $this->tax;
		write_log("xxxxxxx - ". $tax);
    	\add_meta_box($tax.'divXXX', $tax, 'post_'.$tax.'_meta_box', 'blurb', 'side', null, array( 'taxonomy' => $tax ));
	}*/




	/*public function remove_taxonomy_boxes() {

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

	}	*/

}