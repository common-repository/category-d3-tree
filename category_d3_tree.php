<?php
/*
Plugin Name: Category D3 Tree
Plugin URI: http://www.anshisolutions.com/
Description: Category D3 Tree
Version: 1.1
Author: Anshi Solutions
Author URI: http://www.anshisolutions.com/
*/

/*
Category D3 Tree (Wordpress Plugin)
Copyright (C) 2014 Anshi Solutions
Contact me at ceo@anshisolutions.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//tell wordpress to register the categoryd3tree shortcode
add_shortcode("category-d3tree", "categoryd3tree_handler");
global $layout;
function categoryd3tree_handler($atts) {

global $cd3t_scripts;
global $layout;
$cd3t_scripts=true;

  //run function that actually does the work of the plugin
  if(isset($atts['taxonomy']))
  	$taxonomy=$atts['taxonomy'];
  else
  	$taxonomy="category";  
  	
  if(isset($atts['layout']))
  	$layout=$atts['layout'];
  else
  	$layout="tree"; 
  	  	
  $output='<script>taxonomy="'. $taxonomy .'"; </script><div id="category'. $layout .'"></div>' ;
  //send back text to replace shortcode in post
  return $output;
}

function categorytree_callback() {
  //process plugin
  $tree=array(
	'parent'                   => -1,
	'name'                  => $_REQUEST['taxonomy'],
	);  

// generate the response
//$tree['children']=buildtree();
$tree['children']=buildrectree(0);
	$response = json_encode( $tree );
 
	// response output
	header( "Content-Type: application/json" );
	echo $response;
  die();
}  

function buildrectree($root)
{
   $args = array(
	'parent'                   => $root,
	'orderby'                  => 'name',
	'hide_empty'               => 0,
	'taxonomy'                 => $_REQUEST['taxonomy'],
	); 
  $l1cats = get_categories( $args );

  foreach($l1cats as $l1cat)
  {
  	
  	$l1cat->children=buildrectree($l1cat->term_id);
  	$tree[]=$l1cat;
  }
  return $tree;
}


function categoryd3tree_scripts() {
global $cd3t_scripts;
global $layout;
if(!$cd3t_scripts)
return;
    wp_register_style( 'categoryd3tree_css', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'categoryd3tree_css' );
    wp_register_script( 'categoryd3tree_js', plugins_url( $layout.'.js', __FILE__ ),array( 'd3_js' ) );
    wp_enqueue_script( 'categoryd3tree_js' );
    wp_register_script( 'd3_js', plugins_url( 'd3.v3.min.js', __FILE__ ),array( 'jquery' ) );
    wp_enqueue_script( 'd3_js' );    
// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
wp_localize_script( 'categoryd3tree_js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );    
}

add_action( 'wp_footer', 'categoryd3tree_scripts' );
add_action( 'wp_ajax_categorytree', 'categorytree_callback' );
add_action( 'wp_ajax_nopriv_categorytree', 'categorytree_callback' );

?>