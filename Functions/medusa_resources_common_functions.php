<?php  /*
    XXXPlugin Name: Medusa - Resources - Common Functions
    Description: Common functions, as on tin
	Plugin URI: http://www.medusamediacreations.co.uk
	Author: S. Beasley
	Version: 1.0
	Author URI: http://www.medusamediacreations.co.uk

  * TODO
  *
  * split into general and medusa plugin suite functions
  * maybe divide : - wordpress, arrays, strings, color,
  * maybe make into a class for naming issues
  * merge with functions.php
  * organise by scope - GLOBAL SCOPE... etc
  * needs another link function for $qVars
  *

	*/

// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
  exit;
}

function postConfig( $PostConfig )
  {
    write_log( "!!!!!--postConfig" );
    return false;
    return $PostConfig;
  }


function Xcheck_query_term($qvar, $query_terms){
  foreach($query_terms as $qt):
    if($qvar==$qt->qvar) return true;
  endforeach;
  return false;
}

function strip_these_tags( $html, $strip_tags ){

  $output = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", '', $html);
  return $output;
  
}

function get_image_html_str($meta, $images_field_name, $image_size){

  $images = null;
  $image_html="";

  #print_html_r($meta);

  if(isset($images_field_name)):
    if(isset($meta[$images_field_name][0])):
      $images = unserialize($meta[$images_field_name][0]);
      #print_html_r($images);
      #print ("count images : " . count($images));
      if(count($images)>0):
          $image_id=key($images);
          #print ("image_id : " . $image_id);
          $image_html=wp_get_attachment_image( $image_id,  $image_size);
      else:
          $image_html="no image";
      endif;
    endif;
  endif;

  return $image_html;
}


function sluggify( $string, $type ){
  if( $type == 'underscore' ){
    $string = strtolower(str_replace(' ', '_', $string));
  }
  elseif( $type == 'hyphen' ){
    $string = strtolower(str_replace(' ', '-', $string));
  }
  return $string;
}

function get_filter_info($query_terms){
    if($query_terms):
        $filter_str='';
        foreach ($query_terms as $t):
            if ($t):
                #print_html_r($t);
                $filter_str.='<div>'.
                    '<span><i>'.$t->qvar.'</i></span> :'.
                    '<span>'.$t->slug.'</span>'.
                '</div>';
            endif;
        endforeach;
    endif;
    return $filter_str;
}


function get_tax_select_title($terms, $qvar, $tax){
    foreach($terms as $t):
        if(get_query_var(key($t))):
            if(get_query_var(key($t))!=$t[key($t)]['all']['slug']):
                $obj=get_term_by('slug', get_query_var($qvar), $tax);
                if(!isset($title)) return false;
                $title=$obj->name;
            else:
                $title=$t[key($t)]['all']['name'];
            endif;
            return $title;
        endif;
    endforeach;
}




function get_query_terms($terms){
    $x=0;
    foreach($terms as $t):
        #print ("t :- "); print_html_r( $t);
        if(get_query_var(key($t))):
            if(get_query_var(key($t))!=$t[key($t)]['all']['slug']):
                $term_from_tax=get_term_by('slug', get_query_var(key($t)), $t[key($t)]['taxonomy']);
                #print "term_from_tax :- "; print_html_r($term_from_tax);
                if(!$term_from_tax) continue;

                $query_terms[$x]=new stdClass();###????
                $query_terms[$x] = $term_from_tax;
                #$query_terms[$x]->qvar=new stdClass();###????
                $query_terms[$x]->qvar=key($t);###????

                $x++;
            else:
                $all_terms = get_terms( $t[key($t)]['taxonomy'] );
                $all_term_ids = wp_list_pluck( $all_terms, 'term_id' );
                $query_terms[$x]=new stdClass();
                $query_terms[$x]->taxonomy = $t[key($t)]['taxonomy'];
                $query_terms[$x]->field ='term_id';
                $query_terms[$x]->term_id = $all_term_ids;
                $query_terms[$x]->slug = $t[key($t)]['all']['slug'];
                $query_terms[$x]->name = $t[key($t)]['all']['name'];
                $query_terms[$x]->qvar=key($t);
                $x++;
            endif;

        endif;

    endforeach;

    return $query_terms;
}




function get_tax_query_args($query_terms){

  $tax_query=array();
  #print ("query_terms : ");
  #print_html_r($query_terms);

  if(!empty($query_terms)):
      foreach ($query_terms as $qt):
          #print("qt");
          #print_html_r($qt);
          if($qt):
              $tax_query[]=array(
                  'taxonomy' => $qt->taxonomy,
                  'field' => 'id',
                  'terms' => $qt->term_id,
              );
          endif;
      endforeach;
  endif;

  $args = array(
      'tax_query' => $tax_query
  );

  return $args;
}







/*
  'url_query_vars_extra'=>array(
    array(
        'place_type' => array(
            'all'=>array(
                'slug'=>'all-place-types',
                'name'=>'All Place Types',
            ),
        'taxonomy'=>'place_type',
        ),
    ),


    $t[key($t)]['all']['slug']

*/

function get_qvar_info_by_slug($pt, $slug){
  global $pt_data;
  $qvar_info=NULL;

  $pt_query_vars=get_qvars_extra_by_pt($pt);

  foreach($pt_query_vars as $i):

    #write_log($i);

  endforeach;



  return $qvar_info;


}








function get_available_qvars_from_pt($qVars, $pt){

  $pt_url_query_vars=get_qvars_by_pt($pt);

  $qVarsSel=array();

  foreach ($pt_url_query_vars as $p):
      foreach ($qVars as $k=>$v):
          if($p==$k):
              $qVarsSel[$k]=$v;
          endif;
      endforeach;
  endforeach;

  return $qVarsSel;

}


function get_qvars_by_pt($pt){

  global $pt_data;
  $url_query_vars=array();

  foreach ($pt_data as $p):
    if($p['types'] == $pt):
      if(isset($p['extras']['url_query_vars'])):
        $url_query_vars=$p['extras']['url_query_vars'];
        break;
      endif;
    endif;
  endforeach;

  return $url_query_vars;
}



function get_qvars_extra_by_pt($pt){

  global $pt_data;
  $url_query_vars_extras=array();

  foreach ($pt_data as $p):
    if($p['types'] == $pt):
      if(isset($p['extras']['url_query_vars_extra'])):
        $url_query_vars_extras=$p['extras']['url_query_vars_extra'];
        break;
      endif;
    endif;
  endforeach;

  return $url_query_vars_extras;
}



function get_all_qvars_data(){

  #write_log("get_all_qvars_data");

  $url_query_vars_data=array();

  global $pt_data;
  foreach ($pt_data as $p):
      if(isset($p['extras']['url_query_vars'])):
        if($p['extras']['url_query_vars']):
          if(isset($p['extras']['url_query_vars_extra'])):
            if($p['extras']['url_query_vars_extra']):

              $url_query_vars_data[$p['types']]=array();

              $a=$p['extras']['url_query_vars'];
              $b=$p['extras']['url_query_vars_extra'];

              foreach ($a as $a2):
                foreach ($b as $b2):
                  if(key($b2)==$a2):
                    $add=array();

                    $add['qvar']=$a2;
                    $add['taxonomy']=$b2[key($b2)]['taxonomy'];
                    $add['all_slug']=$b2[key($b2)]['all']['slug'];
                    $add['all_name']=$b2[key($b2)]['all']['name'];
                    $url_query_vars_data[$p['types']][]=$add;
                  endif;
                endforeach;
              endforeach;
            endif;
          endif;
        endif;
      endif;
  endforeach;

  #write_log($url_query_vars_data);

  return $url_query_vars_data;

}



function get_all_qvars_data_by_pt($pt){

  global $pt_data;
  $url_query_vars_extras=get_qvars_extra_by_pt($pt);





  return $url_query_vars_extras;
}










function print_html_r( $data ) {
	echo '<pre>';
	print_r($data);
	echo  '</pre>';
}


function get_pt_list_id($pt){
  global $pt_data;
  foreach ($pt_data as $p):
    if($p['types'] == $pt):
      $list_page_id=$p['extras']['list_page'];
      break;
    endif;
  endforeach;

  return $list_page_id;
}

function get_pt_data($pt){
  global $pt_data;
  foreach ($pt_data as $p):
    if($p['types'] == $pt):
      $this_pt=$p;
      break;
    endif;
  endforeach;

  return $this_pt;
}


function get_404_page_id(){
  global $medusa_config;
  $id=$medusa_config['error_page_id'];
  return $id;
}



function widgets_exist($sidebar){
    $sidebars_widgets = get_option('sidebars_widgets');

    if (count($sidebars_widgets[$sidebar])):
        return true;
    else:
        return false;
    endif;
}


function trimToWord($str, $width){
    #echo "trimToWord - " . $width . "<br />";
    //echo "str = " . $str . "<br />";
	//$trim_str=strip_tags(substr($str, 0, strpos(wordwrap($str, $width), "\n")),"<b>");
	$trim_str=strip_tags($str,"<b>");
	$trim_str=substr($trim_str, 0, $width);
	//$trim_str=substr($trim_str, 0, strpos(wordwrap($trim_str, $width), "\n"));
	//echo "trim_str = " . $trim_str . "<br />";
	return $trim_str;
}


function get_user_role() {
	global $current_user;
	$user_roles = (array)$current_user->roles;
	$user_role = array_shift($user_roles);#???
	return $user_role;
}


function all_rev_sliders_in_array(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[] = $slider->getAlias();
            $arrT[] = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}




add_filter('request', 'myfeed_request');

function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'our_services');
	return $qv;
}


function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
		#echo '[...]';
	} else {
		return $excerpt;
	}
}


function get_the_excerpt_by_id($post_id) {
  global $post;
  $save_post = $post;
  $post = get_post($post_id);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}

function get_max_charlength($charlength, $string) {
	$charlength++;

	if ( mb_strlen( $string ) > $charlength ) {
		$subex = mb_substr( $string, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
		#echo '[...]';
	} else {
		return $string;
	}
}



function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}



add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_length( $length ) {
	return 20;
}



function formatInputVars($str){
  #$club = "Barcelona";
  #$var = 'I am a {$club} fan';

  $res = preg_replace_callback('/\{\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/',
  create_function( '$matches', 'extract($GLOBALS, EXTR_REFS | EXTR_SKIP); return $$matches[1];'), $str);
  #echo "$res\n";

  return $res;
}


function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}



function str_replace_limit($search, $replace, $string, $limit = 1) {
  if (is_bool($pos = (strpos($string, $search))))
    return $string;

  $search_len = strlen($search);

  for ($i = 0; $i < $limit; $i++) {
    $string = substr_replace($string, $replace, $pos, $search_len);

    if (is_bool($pos = (strpos($string, $search))))
      break;
  }
  return $string;
}









if (!function_exists('write_log')) {


  function write_log ( $log ){

    if ( true === WP_DEBUG ) {
      if ( is_array( $log ) || is_object( $log ) ) {
          error_log( print_r( $log, true ) );
      } else {
          error_log( $log );
      }
    }
  }
}


function arraySort($input,$sortkey){
  foreach ($input as $key=>$val) $output[$val[$sortkey]][]=$val;
  return $output;
}


function array_insert(&$array, $position, $insert){
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}


function sortMultiArray($arr, $k, $sort) {
  $tmp = Array();
  foreach($arr as &$ma)  $tmp[] = &$ma[$k];
  $tmp = array_map('strtolower', $tmp);      // to sort case-insensitive
  array_multisort($tmp, $sort, $arr);
  return $arr;
}


function sortMultiObject($arr, $k, $sort) {
  $tmp = Array();
  foreach($arr as &$ma)  $tmp[] = &$ma->$k;
  $tmp = array_map('strtolower', $tmp);      // to sort case-insensitive
  array_multisort($tmp, $sort, $arr);
  return $arr;
}


function array_orderby(){
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
                #$tmp[$key] = strtolower($row[$field]);
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}


function object_orderby(){
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row->$field;
                #$tmp[$key] = strtolower($row[$field]);
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}




function object_to_array($data){
    if (is_array($data) || is_object($data)){
        $result = array();
        foreach ($data as $key => $value){
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}



function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}


function check_post_is_featured($post_id){
	$cats=get_the_category($post_id);
	/*echo "cats:<pre>";
	print_r($cats);
	echo "</pre>";*/
	if(count($cats)>0):
		foreach ($cats as $cat):
			if($cat->slug=='featured'):
				return true;
			endif;
		endforeach;
	else:return false;
	endif;
	return false;
}
























/**/

function medusa_resources_common_functions_is_pt_list_page($post_id){

  ##different process for main site????

  #write_log("medusa_resources_common_functions_is_pt_list_page()");

  global $pt_data;

	$page_object = get_queried_object();
	$page_id = get_queried_object_id();

	#echo "page_id - " . $page_id . "<br />";

	$pt_list_data=array();

	$x=0;
	foreach($pt_data as $p):
		if($p['extras']['list_page']):
			$pt_list_data[$x]['list_page']=$p['extras']['list_page'];
			$pt_list_data[$x]['type']=$p['types'];
			$x++;
		endif;
	endforeach;

  #write_log("pt_list_data:");
  #write_log($pt_list_data);

	$pt_list_page=false;
	$pt_list_type=false;

	foreach($pt_list_data as $p):
		if($page_id == $p['list_page']):
			$pt_list_page=true;
			$pt_list_type=$p['type'];
		endif;
	endforeach;

	if($pt_list_type):return $pt_list_type;
	else:return false;
	endif;

}




function get_product_pts(){

  global $pt_data;

  #print "pt_data - ";
  #print_html_r($pt_data);

  $x=0;
  foreach($pt_data as $p):
    if(isset($p['extras']['is_product_pt'])):
      if($p['extras']['is_product_pt']):
        $product_pt[$x]=$p['types'];
        $x++;
      endif;
    endif;
  endforeach;

  return $product_pt;
}



function get_product_pt_page_ids($product_pts){

  global $pt_data;

  $product_pt_page_ids=array();

  $x=0;
  foreach($pt_data as $p):

    if(in_array($p['types'], $product_pts)):

      $product_pt_page_ids[$x]['id']=$p['extras']['list_page'];
      $product_pt_page_ids[$x]['name']=$p['types'];

      $x++;

    endif;

  endforeach;

  return $product_pt_page_ids;
}



function get_product_main_tax($pt){

  global $pt_data;
  $product_tax=null;

  #echo "get_product_main_tax called<br>";

  #echo "pt : " . $pt ."<br>";

  foreach($pt_data as $p):

      if(isset($p['extras']['product_cat'])):
        if($pt==$p['types']):
          $product_tax=$p['extras']['product_cat'];
          break;
      endif;
    endif;

  endforeach;

  #print "product_tax : " . $product_tax . "<br>";

  return $product_tax;

}





function get_the_slug(){//remove after
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  //if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}


function get_the_slug2($id) {
$post_data = get_post($id, ARRAY_A);
$slug = $post_data['post_name'];
return $slug; 
}



function get_this_post_ancestors( $post_id ){

  $anc = get_post_ancestors( $post_id );

  if ( empty ( $anc ) ) : return false; endif;

  $anc2 = array();

  foreach ($anc as $p):

    $p = get_post( $p );

  //print_html_r ($p);

    $anc2[] = array(
      //'meta' => get_post_meta( $p->ID ),
      'id' => $p->ID,
      'name' => $p->post_name,
      'slug' => $p->slug,
      'title' => $p->post_title,
      'template' => get_page_template_slug( $p->ID ),
      'sidebar' => get_post_meta ( $p->ID, '_cmb_page_options_sidebar_sidebar', true ),
      'header_image' => medusa_get_header_image ( $p->ID ),
      'link_boxes' => medusa_get_link_boxes ( $p->ID ),
    );

  endforeach;

  return $anc2;

}


function get_all_ancestral_info( $post_id ){

  $info =  get_this_post_ancestors( $post_id ) ;


  if ( empty ( $info ) ) : return false; endif;

  $new[0] = array ( 
    //'meta' => get_post_meta( $post_id ),
    'name' => get_the_slug2( $post_id ),
    'slug' => get_the_slug2( $post_id ),
    'title' => get_the_title( $post_id ),
    'template' => get_page_template_slug( $post_id ),
    'sidebar' => get_post_meta ( $post_id, '_cmb_page_options_sidebar_sidebar', true ),
    'header_image' => medusa_get_header_image ( $post_id ),
    'link_boxes' => medusa_get_link_boxes ( $post_id ),
  );

  $merged = array_merge( $new, $info );

  return $merged;
}


function medusa_get_header_image( $post_id ){

  $meta = get_post_meta( $post_id );

  if ( ! empty ( $meta )  ) :
    foreach ( $meta as $k=>$v ):
      if ( strpos ( $k, 'header_image_id' ) > -1 ) :
        return array ( 'field' => $k, 'id' => $v[0] );
      endif;
    endforeach;
  endif;

}




function medusa_get_link_boxes( $post_id ){

  $meta = get_post_meta( $post_id );

  if ( ! empty ( $meta )  ) :
    foreach ( $meta as $k=>$v ):
      if ( $k == '_cmb_link_boxes_link_box') :
        return $v[0];
      endif;
    endforeach;
  endif;

}


//http://www.billerickson.net/code/get-page-hierarchy/

function be_get_page_hierarchy($post) {
  //global $post;
  $loop = new WP_Query( array( 
    'post_type' => 'page',
    'post_parent' => $post->post_parent,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'fields' => 'ids',
  ) );
  $output = array(
    'pages' => $loop->posts,
  );
  /*foreach( $loop->posts as $k => $v ) {
    if( $v == get_the_ID() ) {
      if( isset( $loop->posts[$k-1] ) )
        $output['prev'] = $loop->posts[$k-1];
      if( isset( $loop->posts[$k+1] ) )
        $output['next'] = $loop->posts[$k+1];
    }
  }*/
  return $output;
}




function get_top_parent_id( $post_id ){

  $top_parent_id = null;
  $ancestors = null;

  $ancestors=get_this_post_ancestors( $post_id );

  if(!empty ( $ancestors )):
    $num_anc = count( $ancestors );
    $top_parent_id=$ancestors[$num_anc-1]['id'];
  else:
    $top_parent_id=$post_id;
  endif;

  #print_html_r ( $ancestors );

  return $top_parent_id;

}


function get_columns_by_pt($pt){

  global $pt_data;
  $cols=array();

  #print "pt_data - ";
  #print_html_r($pt_data);

  foreach($pt_data as $p):
    if(isset($p['types'])):
      #print_html_r($p);
      if($p['types']==$pt):
        $cols=$p['extras']['columns'];
        break;
      endif;
    endif;
  endforeach;



  return $cols;
}


















function get_image_html($args){

    #print "get_image_html() called<br><br>";

    /*print "args:";
    print_html_r($args);
    print "</pre>";
    $image_html="";*/

    $post_title=get_the_title($args['post_id']);
    $html_image="";

    if(isset($args['img_src'])):
        if($args['img_src']=='custom_field'):
            if(isset($args['img_field'])):
                if($args['img_field']!=''):

                    $image_meta=array();
                    $image_field_array=array();
                    $image_array_str="";

                    $image_meta=get_post_meta($args['post_id'], $args['img_field'], true);

                    /*print "image_meta:";
                    print_html_r($image_meta);*/

                    $image_field_count=count($image_meta);
                    #echo "<br />image_field_count - " . $image_field_count . "<br />";

                    $attr=array(
                        'class' => "attachment-" . $args['img_size'] . " wp-post-image ",#alignright
                        'alt'   => $post_title
                    );

                    if(!empty($image_meta)):

                      $x=0;
                      foreach($image_meta as $key => $value):
                          $html_image[$x]=wp_get_attachment_image($key, $args['img_size'], false, $attr);
                          $x++;
                      endforeach;

                      $html_image=$html_image[0];#use first image

                    endif;

                endif;
            endif;
        endif;
    endif;

    if (has_post_thumbnail($args['post_id'])) :// check if the post has a Post Thumbnail assigned to it.
        //echo "post has thumbnail<br />";
        $attr=array(
            'class' => "attachment-" . $args['img_size'] . " wp-post-image ",#alignright
            'alt'   => $post_title
        );

        $html_image=get_the_post_thumbnail($args['post_id'], $args['img_size'], $attr);

        #print_html_r($html_image);

    #elseif ($image_field_count>0):

        #echo "image_field_array[0] - " . $image_field_array[0] . "<br />";

        #$html_image=wp_get_attachment_image($image_field_array[0], $args['img_size'], false, $attr);


    #elseif ($attachments):
        #print "<br />attachment<br />";
        #print_r($attachments);
        #$html_image=wp_get_attachment_image( $item->ID );

    #else:
        #echo "<br />blank img needed<br />";
       # $html_image=wp_get_attachment_image( HOLDING_IMAGE , $args['img_size'] );
    endif;

    /*
    print "<br />html_image:<pre>";
    print_r($html_image);
    print "</pre>";
    */
    return $html_image;

}


/**
* gets the current post type in the WordPress Admin
*/
function get_current_post_type() {
  global $post, $typenow, $current_screen;
  //we have a post so we can just get the post type from that
  if ( $post && $post->post_type )
  return $post->post_type;
  //check the global $typenow - set in admin.php
  elseif( $typenow )
  return $typenow;
  //check the global $current_screen object - set in sceen.php
  elseif( $current_screen && $current_screen->post_type )
  return $current_screen->post_type;
  //lastly check the post_type querystring
  elseif( isset( $_REQUEST['post_type'] ) )
  return sanitize_key( $_REQUEST['post_type'] );
  //we do not know the post type!
  return null;
}

































function medusa_resources_common_functions_get_pt_pages_for_nav_menu(){

  #write_log("medusa_resources_common_functions_get_pt_pages_for_nav_menu()");

  global $pt_data;

  #if(!isset($pt_data) || empty($pt_data)):

    #$pt_data=medusa_configuration_get_post_types_data();

  #else:

    #write_log("pt_data :");
    #write_log($pt_data);

    #write_log("count(pt_data) :");
    #write_log(count($pt_data));

    foreach ($pt_data as $pt):
        if(isset($pt['extras']['show_in_nav_menu'])):
            if(!empty($pt['extras']['show_in_nav_menu'])):
                #print $pt['types'] . " : " ;
                #print $pt['extras']['show_in_nav_menu'] . "<br>";
                $types[]=$pt['types'];
            endif;
        endif;
    endforeach;

    #write_log("types :");
    #write_log($types);

    $ids = array( );
    $pages_for_menu = array( );

    $x = 0;
    foreach ($types as $type ) :
        if( isset( $type ) ):
            if( ! empty( $type ) ) :
              #write_log("x - " . $x);
              $id=medusa_resources_common_functions_get_page_id_by_title( $type );##??correct parameter?type?
              #write_log("id : " . $id);
              $name=medusa_resources_common_functions_get_page_name_by_id( $id );
              $title=medusa_resources_common_functions_get_page_title_by_id( $id );
              if($id):
                  $pages_for_menu[$x]['name'] = $name;
                  $pages_for_menu[$x]['title'] = $title;
                  $pages_for_menu[$x]['id'] = $id;
                  $x++;
              endif;
            endif;
        endif;
    endforeach;

    #write_log("pages_for_menu : ");
    #write_log($pages_for_menu);

    return $pages_for_menu;

  #endif;
}


function medusa_resources_common_functions_get_course_search_link( $course_search_page_id, $term ){
  $link = get_permalink( $course_search_page_id );
  $params = array( 'subject_area' => $term );
  $link = add_query_arg( $params, $link );
  
  return $link;

}

function medusa_resources_common_functions_get_page_id_by_title( $name ){

  $this_post = get_page_by_title( $name, OBJECT, 'page' );

  if( ! empty( $this_post ) ) :
      #print "get_page_id_by_title called ( " . $name . " ) : ";
      #print( $this_post->ID ) . "<br>";
      return $this_post->ID;
  endif;

  return false;
}

function medusa_resources_common_functions_get_post_id_by_title_type( $name, $type ) {
  #write_log( 'medusa_resources_common_functions_get_post_id_by_title_type( '.$name.' )' );

  $this_post = get_page_by_title( $name, OBJECT, $type );
  //$this_post = get_page_by_title( 'Homepage Adverts', OBJECT, 'homepage_advert' );

  if( ! empty( $this_post ) ):
      #print "get_page_id_by_title called (" . $name . ") : ";
      #print( $this_post->ID ) . "<br>";
      return $this_post->ID;
  endif;

  return false;
}








function medusa_resources_common_functions_get_form_id_by_title($name){
  #print('medusa_resources_common_functions_get_form_id_by_title('.$name.')');

  $this_post = get_page_by_title( $name, OBJECT, 'uwpqsf' );

  if(isset($this_post)):
      if(!empty($this_post)):
          #print "get_page_id_by_title called (" . $name . ") : ";
          #print($this_post->ID) . "<br>";
          return $this_post->ID;
      endif;
  endif;

  return false;
}







function medusa_resources_common_functions_get_page_name_by_id($id){
  #write_log('medusa_resources_common_functions_get_page_name_by_id('.$id.')');

  $this_post = get_post($id);

  #write_log("this_post : ");
  #write_log($this_post);

  if(isset($this_post)):
      if(!empty($this_post)):
          #print "get_page_id_by_title called (" . $name . ") : ";
          #print($this_post->ID) . "<br>";
          return $this_post->post_name;
      endif;
  endif;

  return false;
}



function medusa_resources_common_functions_get_page_title_by_id($id){
  #write_log('medusa_resources_common_functions_get_page_title_by_id('.$id.')');
  $this_post = get_post($id);

  #write_log("this_post : ");
  #write_log($this_post);

  if(isset($this_post)):
      if(!empty($this_post)):
          #write_log("get_page_id_by_title called (" . $name . ") : " . $this_post->ID);
          return $this_post->post_title;
      endif;
  endif;

  return false;
}











function  medusa_resources_common_functions_post_creator(
  #write_log("medusa_resources_common_functions_post_creator()");

  $name = 'AUTO POST',
  $type = 'post',
  $content = 'DUMMY CONTENT',
  $category = array(1,2),
  $template = NULL,
  $author_id = '1',
  $status = 'publish') {


  #write_log("name : " . $name );
  #write_log("type : " . $type);
  #write_log("template : " . $template);
  #write_log("current_blog_id : " . get_current_blog_id());

  $post_data = array(
    'post_title'    => wp_strip_all_tags($name),
    'post_content'  => $content,
    'post_status'   => $status,
    'post_type'     => $type,
    'post_author'   => $author_id,
    'post_category' => $category,
    'page_template' => $template
  );

  $new_post=wp_insert_post($post_data, false);

  #write_log("new_post : " . $new_post );

  return $new_post;
}



function medusa_resources_common_functions_get_sidebar_id($type){

  #write_log ("medusa_resources_common_functions_get_sidebar_id()");

  global $post_type;
  global $post;

  #write_log("post->ID : ". $post->ID);

  $pt_list_type=medusa_resources_common_functions_is_pt_list_page($post->ID);

  #write_log("pt_list_type - ". $pt_list_type);
  #write_log("post_type - ". $post_type);

  $sidebar_id="";

  if($post_type!=='page'):
    $sidebar_id=$type.'-article-'.$post_type;
  else:
    $sidebar_id=$type.'-list-'.$pt_list_type;
  endif;

  #write_log("sidebar_id - " . $sidebar_id);

  return $sidebar_id;
}


function medusa_resources_common_functions_get_nav_menu_pos($type){
  #write_log('medusa_resources_common_functions_get_nav_menu_pos('.$type.')');

  global $pt_data;

  foreach ($pt_data as $pt):
    #write_log('pt :');
    #write_log($pt);
    if(strtolower($type) == strtolower($pt['types'])):
      if(isset($pt['extras']['nav_menu_position'])):
          if(!empty($pt['extras']['nav_menu_position'])):
            #write_log('-------------pt[extras][nav_menu_position] :' . $pt['extras']['nav_menu_position']);
            #write_log('medusa_resources_common_functions_get_nav_menu_pos('.$type.') - ENDED');
            return $pt['extras']['nav_menu_position'];
          endif;
      endif;
    endif;
  endforeach;
}



function medusa_resources_common_functions_get_subsite_nav_menu_pt_item_status($id){

  if(is_main_site()): return false ; endif;
  #print get_current_blog_id();
  $menu_pt_settings=get_option('pt_list_pages');

  #print('menu_pt_settings:');
  #print_html_r($menu_pt_settings);

  foreach($menu_pt_settings as $m):
    if($m['id']==$id):
      if(isset($m['status'])):
        #print "m['status'] - ". $m['status'] . "<br>";
        if($m['status']=="on"):
          return true;
        endif;
      endif;
    endif;
  endforeach;

  return false;
}





function medusa_resources_common_functions_get_posts_for_nav_menu() {
  #write_log("medusa_resources_common_functions_get_posts_for_nav_menu()");

  global $pt_data;

  #write_log('pt_data:');
  #write_log($pt_data);

  $pt_menu_items=array();

    if(isset($pt_data)):
      if(count($pt_data)>0):


        foreach($pt_data as $pt):

          if(isset($pt['extras']['show_posts_in_nav_menu'])):
            if($pt['extras']['show_posts_in_nav_menu']==true):

              $pt_menu_items[]=array(
                'menu_item'=>$pt['args']['labels']['menu_name'],
                'pt'=>$pt['types'],
                'pt_page_id'=>$pt['extras']['list_page'],
                );

            endif;
          endif;
        endforeach;

      endif;
    endif;



  #write_log('pt_menu_items:');
  #write_log($pt_menu_items);

  return $pt_menu_items;
}






function medusa_resources_common_functions_get_pts_for_dummy_data(){

  #write_log("medusa_resources_common_functions_get_pts_for_dummy_data()");

  global $pt_data;

  #write_log('pt_data:');
  #write_log($pt_data);

  $pts_for_dummy_data=array();

  foreach($pt_data as $pt):

    if(isset($pt['extras']['create_dummy_posts'])):
      if($pt['extras']['create_dummy_posts']==true):
        $pts_for_dummy_data[]=array(
          'menu_item'=>$pt['args']['labels']['menu_name'],
          'pt'=>$pt['types']
          );

      endif;
    endif;

  endforeach;

  return $pts_for_dummy_data;
}











function medusa_resources_common_functions_get_chidren_by_title($post_type, $post_title){
  $query = new WP_Query();
  $pages = $query->query(array('post_type' => $post_type));
  $page =  get_page_by_title($post_title);
  $children = get_page_children( $page->ID, $pages );

  $x=0;
  foreach ($children as $c ):
    $children[$x]->permalink=get_permalink($c->ID);
    $x++;
  endforeach;

  return $children; //object

}





function get_image_sizes( $size = '' ) {

  global $_wp_additional_image_sizes;

  $sizes = array();
  $get_intermediate_image_sizes = get_intermediate_image_sizes();

  // Create the full array with sizes and crop info
  foreach( $get_intermediate_image_sizes as $_size ) {

    if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

      $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
      $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
      $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

    } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

      $sizes[ $_size ] = array(
        'width' => $_wp_additional_image_sizes[ $_size ]['width'],
        'height' => $_wp_additional_image_sizes[ $_size ]['height'],
        'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
      );

    }

  }

  // Get only 1 size if found
  if ( $size ) {

    if( isset( $sizes[ $size ] ) ) {
      return $sizes[ $size ];
    } else {
      return false;
    }

  }

  return $sizes;
}


function get_tax_meta_by_post_title( $post_title ){
  global $wpdb;

  write_log( 'get_tax_meta_by_post_title - post title:-' );
  write_log( $post_title );
  #write_log();

  if( $post_title ) :

    $query_str = "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $post_title . "'" ;
    write_log( 'query_str - ' . $query_str );

    $post_id = $wpdb->get_var( $query_str );
    write_log( 'post_id - ' . $post_id );

    /*echo "<br>post_title-";
    echo $post_title;
    echo "<br>post_id-";
    echo $post_id;
    
    echo "<br>query_str-";
    echo $query_str;*/

    $key='wp-large-option-value';

    $meta=get_post_meta($post_id, $key, true);

    /*print "<br>function get_tax_image_by_post_title<pre>";
    print_r($meta);
    print "</pre>";*/

    return $meta;

  endif;
}



function get_tax_image_by_post_title( $post_title, $img_field, $img_size, $attr, $icon=false){

  global $wpdb;

  if( $post_title ) :

    $post_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $post_title . "'" );

    /*echo "<br>post_title-";
    echo $post_title;
    echo "<br>post_id-";
    echo $post_id;
    echo "<br>img_field-";
    echo $img_field;*/

    $key='wp-large-option-value';

    $meta=get_post_meta($post_id, $key, true);

    /*print "<br>function get_tax_image_by_post_title<pre>";
    print_r($meta);
    print "</pre>";*/

    if( isset( $meta[$img_field] ) ):

      $img_id=$meta[$img_field];

      /*print ("img_id - " . $img_id . "<br>");
      print ("img_field - " . $img_field . "<br>");
      print ("img_size - " . $img_size . "<br>");
      print ("icon - " . $icon . "<br>");

      print "attr<pre>";
      print_r($attr);
      print "</pre>";*/

      $icon=false;

      $output=wp_get_attachment_image( $img_id, $img_size, $icon, $attr );

      #echo $output;

      return $output;

    endif;

  endif;

  return false;

}







function get_attachment_id_from_url( $attachment_url = '' ) {

  global $wpdb;
  $attachment_id = false;

  // If there is no url, return.
  if ( '' == $attachment_url )
    return;

  // Get the upload directory paths
  $upload_dir_paths = wp_upload_dir();

  // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
  if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

    // If this is the URL of an auto-generated thumbnail, get the URL of the original image
    $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

    // Remove the upload path base directory from the attachment URL
    $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

    // Finally, run a custom database query to get the attachment ID from the modified attachment URL
    $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

  }

  return $attachment_id;

}












function get_site_section_title_term($id){

  if($anc=get_post_ancestors( $id )):

    #print_html_r($anc);

    $post=get_post($anc[0]);
    $title = $post->post_title;

  else:
    $post=get_post($id);
    $title = $post->post_title;

  endif;

  return $title;


}



/*function medusa_resources_common_functions_get_tax_names_for_pt($pt, $tx_name){

    global $post, $tx_data;

    $taxonomies = get_object_taxonomies($post, 'objects');

    $tx_obj=$taxonomies[$tx_name];

    write_log("medusa_admin_columns_get_tax_for_pt");

   ## write_log("pt:".$pt);

    write_log("taxonomies:");
    write_log($taxonomies);

    #write_log("tx_obj:");
    #write_log($tx_obj);

    #write_log("tx_data:");
    #write_log($tx_data);


return;


    $taxes=array();

    $x=0;
    foreach ($tx_data as $t):
      #write_log("t:");
      #write_log($t);

      $this_type=$t['types'];
      $this_tax=$t['taxes'];


      #write_log("t['args']['slug']" . $t['args']['slug']);

      if (!$this_type==$pt):

        break;

      else:


        #write_log("this_type : ");
        #write_log($this_type);

        #write_log("this_tax : " . $this_tax);

        foreach ($t as $k => $v):

            if ($k=='types'):

              if(in_array_r($pt, $v)):


                foreach ($v as $types):
                #write_log("k:");####
                #write_log($k);

                #write_log("v:");
                #write_log($v);
                  #write_log("types!!!!!!!!!!!!!!!!!!!");

                  #write_log("types : ");
                  #write_log($types);

                  if ($types['id'] == $pt):

                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
                    #write_log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

                    #$arr=$taxes
                    $taxes['pt']=array();
                    $taxes['tx']=array();
                    $taxes['test']=array();

                    #$arr=array_push($taxes, $v);

                    array_push($taxes['pt'], $this_type[0]['id']);
                    array_push($taxes['tx'], $this_tax);
                    array_push($taxes['test'], $types);

                    $x++;
                  endif;

                endforeach;

              endif;
            endif;
        endforeach;

      endif;
    endforeach;

    return $taxes;
}
*/







function format_single_meta ( $meta ) {

  $output = array ();

  foreach ( $meta as $k => $v ) :
    
    //$new_key = str_replace( '_cmb_course_', '', $k );

    $output[$k] = $v[0];

  endforeach;

  return $output;


}











/*
#CALLBACKS
*/
//



function medusa_custom_meta_boxes_get_countries() {
    $countryList = medusa_resources_common_data_countries();
    return $countryList;

}


function medusa_custom_meta_boxes_get_english_counties() {
    $uk_counties = medusa_resources_common_data_uk_counties();
    $english_counties = $uk_counties['England'];
    return $english_counties;

}


function cmb_get_post_options( $query_args ) {
    $posts = get_posts( $query_args );
    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[] = array(
                'name' => $post->post_title,
                'value' => $post->ID
            );
        }
    }
    //write_log('post_options:');
    //write_log($post_options);
    return $post_options;

}


function cmb_get_pt_options( $query_args ) {
    //write_log('cmb_get_pt_options - query_args:-');
    //write_log($query_args );
    $posts = get_posts( $query_args );
    //write_log('cmb_get_pt_options - posts:-');
    //write_log($posts );
    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[$post->ID] = $post->post_title;
        }
    }
    //write_log('cmb_get_pt_options:');
    //write_log($post_options);
    return $post_options;

}


function cmb_get_pt_options_posts_with_anc( $query_args ) {

    #write_log('cmb_get_pt_options - query_args:-');
    #write_log($query_args );
    $posts = get_posts( $query_args );
    #$posts = new WP_Query( $query_args );
    #write_log('cmb_get_pt_options - posts:-');
    #write_log($posts );
    $post_options = array();

    $anc = false;

    if ( $posts ) {
        foreach ( $posts as $post ) {
            #write_log( $post );

            $str="";

            $ancs = get_post_ancestors( $post );

            if(count($ancs)>0){
                #write_log( $ancs );

                foreach($ancs as $anc){
                    $str.=get_the_title($anc) . " > ";
                }
            }

            if($str){$str = ' ('.$str.')';}
            $post_options[$post->ID] = "(".$post->post_type.") - " . $post->post_title . $str;
        }
    }

    $default = array( '' => "none" );

    $post_options = $default + $post_options;

    /*write_log('cmb_get_pt_options:');
    write_log($post_options);*/
    return $post_options;

}


function cmb_get_taxonomy_list ( $allowed ) {//NOT USED

   // write_log ( $allowed );

    $args = array(
      'public'   => true,
      '_builtin' => false,
      'name' => $allowed, //doesn't accept array :-(
    );

    $output = 'objects'; // names or objects
    $operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies( $args, $output, $operator );

    $tax_arr = array();

    //write_log ( $taxonomies );

    if ( $taxonomies ) :

        foreach ( $taxonomies  as $taxonomy ) :
            $tax_arr[] = "(taxonomy) - " . $taxonomy->name;
        endforeach;

    endif;

    return $tax_arr;

}


function cmb_merge_posts_and_tax_names() {

    $tax_names = cmb_get_taxonomy_list ( 'curriculum_areas'  );
    $post_titles = cmb_get_pt_options_posts_with_anc( 
            array(
                'post_type' =>
                    array(
                        'page',
                        'news_article',
                        'post',
                        'case_study',
                        'employer',
                        'showcase',
                    ),
                'numberposts' => -1,
                'orderby' => 'post_title',
                'order' => 'ASC' 
            )
        );

    $merged = array_merge ( $tax_names, $post_titles );

    #write_log("merged : ");
    #write_log($merged);

    return $merged;

}


function cmb_get_post_options2( $query_args ) {
    $args = wp_parse_args( $query_args, array(
            'post_type' => 'post',
            'numberposts' => 10
        ) );
    //write_log($args);
    $posts = get_posts( $args );
    $post_options = array();
    if ( !empty( $args['default'] ) ):
        $post_options[] = array(
            'name' => $args['default'],
            'value' => 'default',
        );
    endif;
    if ( $posts ):
        foreach ( $posts as $post ) {
            if ( !empty( $post->post_title ) ):
                $post_options[] = array(
                    'name' => $post->post_title,
                    'value' => $post->ID,
                );
            endif;
        }
    endif;
    //write_log($post_options);
    return $post_options;

}


//USE this function instead of CMBs 'taxonomy-select' type, as its fucked

function cmb_get_term_options( $taxonomy = 'category', $args = array( 'hide_empty'=> false, 'orderby' => 'name' ) ) {
    //write_log("cmb_get_term_options - taxonomy - " . $taxonomy);
    $args['taxonomy'] = $taxonomy;
    // $defaults = array( 'taxonomy' => 'category' );
    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );
    $taxonomy = $args['taxonomy'];
    //write_log("args : ");
    //write_log($args);
    //write_log("taxonomy - " . $taxonomy);
    $terms = (array) get_terms( $taxonomy, $args, true );
    // Initate an empty array
    $term_options = array();
    if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            //write_log("term : ");
            //write_log($term);
            $term_options[ $term->slug ] = $term->name;
        }
    }
    //write_log("term_options : ");
    //write_log($term_options);
    return $term_options;

}


function cmb_get_taxonomy_id_value_pairs( $taxonomy = 'category', $args = array( 'hide_empty'=> false, 'orderby' => 'name' ) ) {
    //write_log("cmb_get_term_options - taxonomy - " . $taxonomy);
    $args['taxonomy'] = $taxonomy;
    // $defaults = array( 'taxonomy' => 'category' );
    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );
    $taxonomy = $args['taxonomy'];
    //write_log("args : ");
    //write_log($args);
    //write_log("taxonomy - " . $taxonomy);
    $terms = (array) get_terms( $taxonomy, $args, true );

    #print_html_r($terms);

    // Initate an empty array
    $term_options = array();
    if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            //write_log("term : ");
            //write_log($term);
            $term_options[ $term->term_id ] = $term->name;
        }
    }
    //write_log("term_options : ");
    //write_log($term_options);
    return $term_options;
}