<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class Globals{

	public $rootConfigLoc;
	public $configLoc;
	public $postConfig;

	public function __construct( )
	{
		Common::write_log( "GLOBALS!!!!!");
	}

}