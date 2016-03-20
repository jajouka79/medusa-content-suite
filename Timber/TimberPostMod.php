<?php

namespace MedusaContentSuite\TimberMods;
use MedusaContentSuite\Functions\Common as Common;

class TimberPostMod  extends TimberPost 
{
	var $news_category;

	function __construct( )
	{
		Common::write_log( "TimberPostMod __construct" );
	}

	public function test( ) 
	{
        if (!$this->news_category) {
            $news_categories = $this->get_terms('news_category');
            if (is_array($news_categories) && count($news_category)) {
                $this->news_category = $news_categories[0];
            }
        }
        return $this->news_category;
    }
}