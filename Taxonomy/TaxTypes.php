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
		/*print("<h1>this->TaxConfig</h1>");
		echo "<pre>";
		print_r ( $TaxConfig );
		echo "</pre>";*/

		$num_taxes = count($TaxConfig);
		#echo "num_taxes - " . $num_taxes . "<br>";

		for( $x = 0; $x < count( $TaxConfig ); $x++ ):

			if( isset( $TaxConfig[$x]['types'] ) ):

				if($TaxConfig[$x]['types']):

					$num_types = count( $TaxConfig[$x]['types'] );
					#echo "num_types - " . $num_types . "<br>";

					$type_array=array();
					for($y=0; $y<$num_types; $y++):
						#print $TaxConfig[$x]['taxes'] . " - TaxConfig[$x]['types'][$y]['id'] - " . $TaxConfig[$x]['types'][$y]['id'] . "<br><br><br>";
						$type_array[$y]=$TaxConfig[$x]['types'][$y]['id'];
					endfor;

					register_taxonomy($TaxConfig[$x]['taxes'], $type_array, $TaxConfig[$x]['args']);

				endif;

			endif;

		endfor;


		return $TaxConfig;

	}




	public function remove_taxonomy_boxes() {

		return false;

		global $tx_data;
		global $pt_data;

		/*

		print "remove_taxonomy_boxes - > tx_data";

		print "<pre>";
		print_r($tx_data);
		print "</pre>";

		print "pt_data<pre>";
		print_r($pt_data);
		print "</pre>";

		$num_taxes=count($tx_data);
		echo "num_taxes - " . $num_taxes . "<br>";

		*/

		for($x=0; $x<count($tx_data); $x++):

			if(isset($tx_data[$x]['types'])):

				if($tx_data[$x]['types']):
					$num_types=count($tx_data[$x]['types']);
					#echo "num_types - " . $num_types . "<br>";

						$tax_id='';


					if($tx_data[$x]['args']['hierarchical']==true):
						$tax_id=$tx_data[$x]['taxes'].'div';
					else:
						$tax_id='tagsdiv-'.$tx_data[$x]['taxes'];
					endif;

					#echo "tx_data[$x]['args']['hierarchical'] - " . $tx_data[$x]['args']['hierarchical'] . "<br>";


					for($y=0; $y<$num_types; $y++):


						#print $tax_id . " - tx_data[$x]['types'][$y]['id'] - " . $tx_data[$x]['types'][$y]['id'] . "<br>";
						#print "tx_data[$x]['types'][$y]['show_tax_meta'] - " . $tx_data[$x]['types'][$y]['show_tax_meta'] . "<br>";


						if($tx_data[$x]['types'][$y]['show_tax_meta'] == false):
							remove_meta_box($tax_id, $tx_data[$x]['types'][$y]['id'], 'side');
						endif;

					endfor;

				endif;

			endif;

		endfor;

	}


	

}