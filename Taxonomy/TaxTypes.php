<?php

namespace MedusaContentSuite\Taxonomy;

use MedusaContentSuite\Config\TaxConfig as TaxConfig;

class TaxTypes
{

  public function init()
  {
    add_action( 'init', array( $this, 'getTaxConfig' ), 1 );
    add_action( 'init', array( $this, 'registerTaxTypes' ), 2 );
    #add_action( 'admin_init', array( $this, 'remove_taxonomy_boxes' ), 1 );
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

			if( ! empty ( $tc['types'] ) ) :

				if( $tc['types'] ) :

					$type_array = array();
					foreach ( $tc['types'] as $t ) :
						$type_array[] = $t['id'];
					endforeach;

					register_taxonomy( $tc['taxes'], $type_array, $tc['args'] );

				endif;

			endif;

		endforeach;

		return $TaxConfig;

	}




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
						$tax_id=$tx_data[$x]['taxes'].'div';
					else:
						$tax_id='tagsdiv-'.$tx_data[$x]['taxes'];
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