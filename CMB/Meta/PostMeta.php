<?php
namespace MedusaContentSuite\CMB\Meta;
#use MedusaContentSuite as MedusaContentSuite;
use MedusaContentSuite\Config\PostMetaConfig as PostMetaConfig;

class PostMeta
{
	public function init( )
	{
		add_action( 'cmb2_init', array( $this, 'registerPostMeta' ) );
	}

	public function getPostMetaConfig( )
	{
		$PostMetaConfig = new PostMetaConfig;
		$PostMetaConfig = $PostMetaConfig->getPostMetaConfig( );
		return $PostMetaConfig;
	}


	public function registerPostMeta( )
	{		
		#echo "registerPostMeta( )<br><br>";
		
		$PostMetaConfig = $this->getPostMetaConfig( );
		
		if ( ! empty ( $PostMetaConfig ) ) :

			foreach ( $PostMetaConfig as $mb ) :

				if ( ! empty ( $mb ) ) :

					$box_config = $mb;
					unset( $box_config[ 'fields' ] );
					$box_fields = $mb[ 'fields' ];
					


					/*
					print( "<br><br>" );
					print_r( $box_config );
					*/

					$cmb_demo = new_cmb2_box( $box_config );

					$metabox_id = $box_config['id'];
			
					$box_fields_named = array();
				
					foreach ( $box_fields as $f ) :
						$f['metabox_id'] = $metabox_id;
						$xxx = $cmb_demo->add_field( $f );
						$box_fields_named[$f['id']] = $xxx;
						/*print( "<br>f : <br>" );
						print_r( $f );*/
						/*print( "<br>xxx : <br><pre>" );
						var_dump( $xxx );
						print( "</pre>" );*/
					endforeach;
					
					/*print( "<br><pre>box_fields_named : <br>" );
					print_r( $box_fields_named );
					print( "</pre>" );*/

					if ( ! is_admin() ){
					    continue;
					}

					if ( ! empty ( $mb['grid'] ) ) :
	
						$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
		
						$box_grid = $mb[ 'grid' ];

						/*
						print( "<br>box_grid:<br><pre>" );
						print_r( $box_grid );
						print ("</pre>");
						*/

						foreach ( $box_grid['rows'] as $r ) :

							$row = $cmb2Grid->addRow();
						
							/*print( "<br>r:<br><pre>" );
							print_r( $r );
							print ("</pre>");*/

							$columns = array( );

							foreach ( $r['columns'] as $column ) :
								$columns[] = $box_fields_named[ $column[0] ];

								/*print( "<br>column:<br><pre>" );
								print_r( $column );
								print ("</pre>");*/
							endforeach;


							$row->addColumns( $columns );
						endforeach;
						

					endif;

					/*$row->addColumns(array(
					   array($field1, 'class' => 'col-md-8'),
					   array($field2, 'class' => 'col-md-4')
					));*/
				
				endif;

			endforeach;

		endif;

	}



}

