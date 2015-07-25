<?php

namespace Codecourse\Repositories;

class UserRepository
{
	public function __construct()
	{
		echo "UserRepository -> __construct<br>";

		if ( '/var/www/bedrock/vendor/webdevstudios/cmb2/init.php' )  {
			require_once '/var/www/bedrock/vendor/webdevstudios/cmb2/init.php';
		} elseif ( file_exists( '/var/www/bedrock/vendor/webdevstudios/CMB2/init.php' ) ) {
			require_once '/var/www/bedrock/vendor/webdevstudios/CMB2/init.php';
		}
		
	}
}






