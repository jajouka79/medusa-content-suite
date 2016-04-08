<?php

namespace MedusaContentSuite\CMB\Meta;

use MedusaContentSuite\Config\PostMetaConfig as PostMetaConfig;
use MedusaContentSuite\Functions\Common as Common;
#use MedusaContentSuite\Paths\Paths as Paths;
#use Symfony\Component\Yaml\Yaml;

class PostMeta extends \MedusaContentSuite\MedusaContentSuite
{
	public static $Globals;


	public static function getMetaPrefix($pt){

		return "qwerty" . $pt;
	}

	public function __construct(  )
	{				
		self::$Globals = parent::getGlobals( );
		add_action( 'cmb2_init', array( $this, 'registerPostMeta' ), 100 );
	}


	public function registerPostMeta( )
	{
		$PostMetaConfig = self::$Globals->postMetaConfig;
		$PostMetaConfig = apply_filters( 'PostMetaConfigHook', $PostMetaConfig, array( ) );


		if ( ! empty ( $PostMetaConfig ) ) :

			foreach ( $PostMetaConfig as $mb ) :

				if ( ! empty ( $mb ) ) :

					$box_config = $mb;
					unset( $box_config[ 'fields' ] );
					$box_fields = $mb[ 'fields' ];

					$cmb2Box = \new_cmb2_box( $box_config );
					$metabox_id = $box_config['id'];			
					$box_fields_named = array();
				
					foreach ( $box_fields as $f ) :
						$f['metabox_id'] = $metabox_id;
						$tmp = $cmb2Box->add_field( $f );
						$box_fields_named[$f['id']] = $tmp;
					endforeach;
					
					if ( ! is_admin() ){
					    continue;
					}

					/*if ( ! empty ( $mb['grid'] ) ) :
	
						$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb2Box );
		
						$box_grid = $mb[ 'grid' ];

						foreach ( $box_grid['rows'] as $r ) :

							$row = $cmb2Grid->addRow();
						

							$columns = array( );

							foreach ( $r['columns'] as $column ) :
								echo $column[0] . "<br>";
								$columns[] = $box_fields_named[ $column[0] ];
							endforeach;

							$row->addColumns( $columns );
						endforeach;
						

					endif;*/
		
				endif;
			endforeach;
		endif;
	}

	public static function getPosMetaConfig( )
	{
		return self::$Globals->postMetaConfig;
	}

	public static function getPosMetaConfigByPt( $pt )
	{
		$postMetaConfigPt = array( );

		$postMetaConfig = self::$Globals->postMetaConfig;

		foreach( $postMetaConfig as $meta ) :

			#write_log( $meta['object_types'] );

			foreach( $meta['object_types'] as $p ) :

				if( $p == $pt) :
					$postMetaConfigPt[] = $meta;
				endif;

			endforeach;

		endforeach;

		write_log( "postMetaConfigPt:" );
		write_log( $postMetaConfigPt );

	}


	public static function getPostMetaConfigByPostType( $type )
	{
		$metaConfig = array( );
		$PostMetaConfig = self::$Globals->postMetaConfig;

		foreach( $PostMetaConfig as $meta ) :

			#$meta['object_types']

			foreach( $meta['object_types'] as $pt) :

				if( $type == $pt ) :
					#Common::write_log( "type = meta object types" );
					#Common::write_log( $meta );
					$metaConfig[] = $meta;
				endif;

			endforeach;

		endforeach;

		return $metaConfig;
	}


	public static function getFieldsForDisplay( $type )
	{
		$metaConfig = self::getPostMetaConfigByPostType( $type );


		return $metaConfig;
	}


}


/*

	YAML stuff :-

	$path = Paths::getThisPluginPath( "/Paths" ) . '/PostMetaConfig.yml';
	$path = false;

	if( file_exists ( $path ) ) :

		#write_log( '--------------' );
		#write_log( $path );
		$contents = file_get_contents( $path ) ;

		if ( ! empty( $contents ) ) :
			#write_log( 'contents--------------'.$contents );
			$array = Yaml::parse( $contents );
			#write_log( Yaml::dump( $array ) );
			#write_log( $array );
		
		endif;

	endif;
*/
