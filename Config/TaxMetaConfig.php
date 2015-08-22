<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Callbacks as Callbacks;

class TaxMetaConfig
{

	public function init()
	{
		#print("<ul><li>TaxMetaConfig > init</li></ul>");
		add_action( 'init', array( $this, 'getTaxMetaConfig' ), 1 );
	}

	public function getTaxMetaConfig()
	{

		$cb = new Callbacks();
		#$cb = $cb->tester('ass');

		#return $config;

	}


}