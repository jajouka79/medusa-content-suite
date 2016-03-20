<?php

namespace MedusaContentSuite\TimberMods;
use MedusaContentSuite\Functions\Common as Common;







class TimberPostMod extends \TimberPost
{
	public static $news_category;

	function __construct( )
	{
		Common::write_log( "TimberPostMod __construct" );
	}

	public static function test( ) 
	{
        #if ( ! self::$news_category) :

            $news_categories = \get_terms('news_category');
            Common::write_log( "news_categories :" );
            Common::write_log( $news_categories );


            $class_type = \get_terms('class_type');
            Common::write_log( "class_type :" );
            Common::write_log( $class_type );


            /*if (is_array($news_categories) && count(self::$news_category)) :
                self::$news_category = $news_categories[0];
            endif;*/
        #endif;
        
    }

    public static function getVar()
    {
    	return self::$news_category;
    }
}