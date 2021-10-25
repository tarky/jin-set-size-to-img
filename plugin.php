<?php
/*
Plugin Name: Jin set size to img
Author: webfood
Plugin URI: http://webfood.info/
Description: Jin set size to img
Version: 0.1
Author URI: http://webfood.info/
Text Domain: Jin set size to img
Domain Path: /languages

License:
 Released under the GPL license
  http://www.gnu.org/copyleft/gpl.html

  Copyright 2021 (email : webfood.info@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function set_width_height( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
  $img_attr = wp_get_attachment_image_src($post_thumbnail_id, $size);
  $html = str_replace('<img', '<img width="'.$img_attr[1].'" height="'.$img_attr[2].'"', $html);
  return $html;
};

add_filter( 'post_thumbnail_html', 'set_width_height', 99, 5 );

add_filter('the_content','prepare_lazyloading_to_balloon_icon');
function prepare_lazyloading_to_balloon_icon($the_content){
	return str_replace(
		'<div class="balloon-icon "><img src',
	  '<div class="balloon-icon "><img width="60" height="60" loading="lazy" src',
		$the_content);
}

require_once 'custom_my_widget_profile.php';
add_action( 'widgets_init', function() {
	unregister_widget( 'My_Widget_Profile' );
  register_widget( 'Custom_My_Widget_Profile' );
}, 99);
