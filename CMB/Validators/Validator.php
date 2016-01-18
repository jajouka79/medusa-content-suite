<?php

namespace MedusaContentSuite\CMB\Validators;

use MedusaContentSuite\Config\PostMetaConfig as PostMetaConfig;
use MedusaContentSuite\Config\TaxMetaConfig as TaxMetaConfig;

class Validator{

	private $postType;
	private $taxMetaConfig;
	private $postMetaConfig;


	function __construct(){

		#write_log("qwertyhbkjgfjfdjcm,jh");

		global $post;
		
		write_log( 'post' );
		write_log( $post );

		if( ! empty( $post_id ) ) :


			add_action( 'pre_post_update', array( $this , 'my_project_updated_send_email' ) );

			$postMetaConfig = new PostMetaConfig;
			$postMetaConfig->getPostMetaConfig( );
			$this->postMetaConfig = $postMetaConfig->postMetaConfigByType;
			
			$this->postType = get_post_type( $post->ID ); 

			write_log( $this->postType );

		endif;

		#$taxMetaConfig = new TaxMetaConfig;
		##$taxMetaConfig = $taxMetaConfig->init( );

		#write_log( $TaxMetaConfig );
	}

	public function validate(){


	}


	public function my_project_updated_send_email( $post_id ) {


		// If this is just a revision, don't send the email.
		if ( wp_is_post_revision( $post_id ) )
			return;

		write_log("pre_post_update hook triggered....". $this->post_type );
	}


	

}