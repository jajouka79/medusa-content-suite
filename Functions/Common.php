<?php

namespace MedusaContentSuite\Functions;

class Common
{
	public function init()
	{
		write_log( "Common > init" );
		add_action('init', array($this, 'getCommonFunctions'), 5);
	}

	public function getCommonFunctions()
	{
		include "medusa_resources_common_functions.php";
	}	
}