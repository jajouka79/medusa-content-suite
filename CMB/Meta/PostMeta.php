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
		
		foreach ( $PostMetaConfig as $mc ) :

			$box_config = $mc;
			$box_fields = $mc[ 'fields' ];
			unset( $box_config[ 'fields' ] );

			#print( "<br><br>" );
			#print_r( $box_config );

			$cmb_demo = new_cmb2_box( $box_config );

			foreach ( $box_fields as $f ) :
				$cmb_demo->add_field( $f );
				#print( "<br><br>" );
				#print_r( $f );
			endforeach;

			#break;

		endforeach;

	}

}