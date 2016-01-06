<?php
namespace MedusaContentSuite\CMB\Meta;

use MedusaContentSuite\Config\PostMetaConfig as PostMetaConfig;

class PostMeta
{
	public function init( )
	{
		add_action( 'cmb2_init', array( $this, 'registerPostMeta' ), 100 );
	}

	public function getPostMetaConfig( )
	{
		#write_log( "PostMeta - getPostMetaConfig" );

		$PostMetaConfig = new PostMetaConfig;
		$PostMetaConfig = new PostMetaConfig;
		$PostMetaConfig = $PostMetaConfig->getPostMetaConfig( );
		return $PostMetaConfig;
	}

	public function registerPostMeta( )
	{		
		//write_log("PostMeta > registerPostMeta");
		
		$PostMetaConfig = $this->getPostMetaConfig( );
		
		if ( ! empty ( $PostMetaConfig ) ) :

			foreach ( $PostMetaConfig as $mb ) :

				if ( ! empty ( $mb ) ) :

					$box_config = $mb;
					unset( $box_config[ 'fields' ] );
					$box_fields = $mb[ 'fields' ];

					 if ( ! defined( 'CMB2_LOADED' ) ) :
					 	write_log( "CMB2_LOADED - FALSE" );

					 return;

					 else:
					 	//write_log( "CMB2_LOADED" );

					 endif;


					$cmb_demo = \new_cmb2_box( $box_config );
					$metabox_id = $box_config['id'];			
					$box_fields_named = array();
				
					foreach ( $box_fields as $f ) :
						$f['metabox_id'] = $metabox_id;
						$xxx = $cmb_demo->add_field( $f );
						$box_fields_named[$f['id']] = $xxx;
					endforeach;
					
					if ( ! is_admin() ){
					    continue;
					}

					/*if ( ! empty ( $mb['grid'] ) ) :
	
						$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
		
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



}

