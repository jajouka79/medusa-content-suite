<?php

namespace MedusaContentSuite\Taxonomy;

use MedusaContentSuite\Config\TaxConfig as TaxConfig;

class TaxTypes
{

	public $tax;
	public $pt;

	public function init()
	{
		add_action( 'init', array( $this, 'getTaxConfig' ), 1 );
		add_action( 'init', array( $this, 'registerTaxTypes' ), 2 );
		add_action( 'admin_init', array( $this, 'remove_taxonomy_boxes' ), 1 );
	}

	public function getTaxConfig()
	{
		$TaxConfig = new TaxConfig();
		$TaxConfig = $TaxConfig->getTaxConfig();

		return $TaxConfig;
	}

	public function registerTaxTypes()
	{
		#write_log("registerTaxTypes()");
		global $blog_id;

		$TaxConfig =  $this->getTaxConfig();

		foreach ( $TaxConfig as $tc ) :
			
			write_log( $tc);

			if( ! empty ( $tc['pt'] ) ) :

				$pt = array();
				foreach ( $tc['pt'] as $t ) :
					#write_log($t);
					$pt[] = $t['id'];
				endforeach;

				register_taxonomy( $tc['tax'], $pt, $tc['args'] );

				if ( ! empty( $tc['args_ext'] ) ) :
							write_log("xxxxxxxxxxxxx");

					if ( ! empty( $tc['args_ext']['show_tax_meta'] ) ) :
						if ( $tc['args_ext']['show_tax_meta'] == false ) :


							$this->pt = $pt['id'];//here/!!!
							$this->tax = $tc['tax'];

							add_action( 'admin_menu', array( $this, 'remove_tax_metabox' ) );

						endif;
					endif;

				endif;

				/*foreach ( $tc['types'] as $type )://todo - check 
					$this->pt = $type['id'];
					$this->tax = $tc['tax'];//todo-loop
					#add_action('add_meta_boxes', array( $this, 'meta_boxes_function' ) );					
				endforeach;*/

				/*$this->pt = $type['id'];
				$this->tax = $tc['tax'];*/

			endif;

		endforeach;

		return $TaxConfig;

	}

	public function remove_tax_metabox() {
		$pt = $this->pt;
		$tax = $this->tax;
		write_log( "xxxxxxx - remove_tax_metabox - tax - ". $tax );
		write_log( "xxxxxxx - remove_tax_metabox - pt - ". $pt );
		remove_meta_box( 'tagsdiv-'.$tax, 'post', 'side' );
	}

	/*public function meta_boxes_function() {
		$tax = $this->tax;
		write_log("xxxxxxx - ". $tax);
    	\add_meta_box($tax.'divXXX', $tax, 'post_'.$tax.'_meta_box', 'blurb', 'side', null, array( 'taxonomy' => $tax ));
	}*/




	public function remove_taxonomy_boxes() {

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

}