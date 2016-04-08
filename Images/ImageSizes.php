<?php

namespace MedusaContentSuite\Images;

use MedusaContentSuite\Functions\Common as Common;

class ImageSizes
	{

		public function __construct( )
		{			
			#Common::write_log( "ImageSizes __construct( )" );
			add_action( 'init', array( $this, 'setImageSizes' ) );
			#add_filter( 'image_size_names_choose', array( $this, 'display_custom_image_sizes' ) );
		}


		public function setImageSizes( )
		{

			#Common::write_log( "setImageSizes( )" );

			if ( function_exists( 'add_image_size' ) )
			{

				add_image_size( 'display-slide-full-width', 1034, 316, true );
				add_image_size( 'thumb-width-300-height-200-crop', 300, 200, true);
				add_image_size( 'thumb-width-100', 100, 0, false);
				add_image_size( 'thumb-width-200', 200, 0, false);
				add_image_size( 'thumb-width-300', 300, 0, false);
				add_image_size( 'thumb-width-300-height-300-crop', 300, 300, true);
				add_image_size( 'thumb-width-600-height-300-crop', 600, 300, true);
				add_image_size( 'thumb-width-600-height-400-crop', 600, 400, true);
				add_image_size( 'thumb-width-750-height-500', 750, 500, false);
				add_image_size( 'thumb-width-750-height-500-crop', 750, 500, true);
				add_image_size( 'promo-box-advert-thumb-width-750-height-1110-crop', 750, 1155, true);
				add_image_size( 'thumb-width-750', 750, 0, false);
				add_image_size( 'display-width-1000', 1000, 800 );
				add_image_size( 'sslp-small-advert-thumb-width-750-height-376-width-crop', 750, 367, true);
				add_image_size( 'homepage-advert-small', 260, 182, true );#0.702
				add_image_size( 'homepage-advert-large', 500, 171, true );#0.342

					
				/*

				add_image_size( 'homepage-module_images', 380, 140, true );
				add_image_size( 'thumb-square-50', 50, 50, true );
				add_image_size( 'thumb-square-60', 60, 60, true );
				add_image_size( 'thumb-square-80', 80, 80, true );
				add_image_size( 'thumb-square-100', 100, 100, true );
				add_image_size( 'thumb-width-120-height-80', 120, 80 , true);
				add_image_size( 'thumb-width-120', 120, 9999999 );
				add_image_size( 'thumb-square-120', 120, 120, true );
				add_image_size( 'thumb-square-125', 125, 125, true );
				add_image_size( 'thumb-square-130', 130, 130, true );
				add_image_size( 'thumb-square-135', 135, 135, true );
				add_image_size( 'thumb-square-140', 140, 140, true );
				add_image_size( 'thumb-width-260', 260, 9999999 );
				add_image_size( 'thumb-width-400-height-200', 400, 200, true);
				add_image_size( 'thumb-width-250-height-165', 250, 165, true);
				add_image_size( 'thumb-height-300', 999999, 300, true);
				add_image_size( 'thumb-width-400-height-160', 400, 160, true);
				add_image_size( 'thumb-width-450-height-180', 450, 180, true);
				add_image_size( 'thumb-width-500-height-200', 500, 200, true);
				add_image_size( 'thumb-width-300-height-150', 300, 150, true);
				add_image_size( 'thumb-width-200-height-100', 200, 100, true);
				add_image_size( 'thumb-square-280', 280, 280, true );
				add_image_size( 'thumb-width-280', 280, 9999999 );
				add_image_size( 'thumb-width-300', 300, 9999999 );
				add_image_size( 'thumb-square-300', 300, 300, true );
				add_image_size( 'thumb-square-400', 400, 400, true );
				add_image_size( 'thumb-square-600', 600, 600, true );
				add_image_size( 'thumb-width-600', 600, 9999999 );
				add_image_size( 'display-width-1000', 1000, 800 );

				*/
			}

		}



		/*public function display_custom_image_sizes( $sizes )
		{

			Common::write_log( "*********************display_custom_image_sizes( )" );

			global $_wp_additional_image_sizes;

			if ( empty( $_wp_additional_image_sizes ) ) :
				return $sizes;
			endif;

			foreach ( $_wp_additional_image_sizes as $id => $data ) :
				if ( !isset($sizes[$id]) ) : 
					$sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
				endif;
			endforeach;

			return $sizes;
		}*/

}