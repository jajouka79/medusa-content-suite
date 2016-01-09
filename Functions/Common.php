<?php

namespace MedusaContentSuite\Functions;
 
class Common
{

  public function init()
  {
	print("<ul><li>Common > init</li></ul>");
    add_action('init', array($this, 'getCommonFunctions'), 5);
  }

	public function getCommonFunctions()
	{
		print("<ul><li>Common > getCommonFunctions</li></ul>");
		$config=array('NOWT'
			
		);

		include "medusa_resources_common_functions.php";
		//write_log( $config);
		return $config;

	}

	
}