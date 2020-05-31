<?php
/**
 * Move custom menu item classes to the anchor element
 *
 * @package WP_Theme_Components
 * @subpackage move-custom-menu-item-classes-to-anchor-element
 * @author Cameron Jones
 * @version 1.0.0
 */

namespace WP_Theme_Components\Move_Custom_Menu_Item_Classes_To_Anchor_Element;

/**
 * Bail if accessed directly
 *
 * @since 0.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Get the custom item menu classes and add them to the anchor element
 *
 * @since 1.0.0
 * @link https://cameronjonesweb.com.au/blog/how-to-move-the-custom-menu-item-classes-to-the-anchor-element/
 * @param array   $atts The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 * @param WP_Post $item  The current menu item.
 * @return array
 */
function move_custom_menu_item_class_to_anchor_element( $atts, $item ) {
	$custom_classes = get_post_meta( $item->ID, '_menu_item_classes', true );
	if ( ! empty( $custom_classes ) ) {
		$atts['class']  = empty( $atts['class'] ) ? '' : $atts['class'];
		$atts['class'] .= implode( ' ', $custom_classes );
	}
	return $atts;
}

add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\\move_custom_menu_item_class_to_anchor_element', 10, 2 );

/**
 * Remove the custom classes from the list element
 *
 * @since 1.0.0
 * @link https://cameronjonesweb.com.au/blog/how-to-move-the-custom-menu-item-classes-to-the-anchor-element/
 * @param array   $classes The CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post $item    The current menu item.
 * @return array
 */
function remove_custom_menu_item_class_from_li_element( $classes, $item ) {
	$custom_classes = get_post_meta( $item->ID, '_menu_item_classes', true );
	$classes        = array_diff( $classes, $custom_classes );
	return $classes;
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\\remove_custom_menu_item_class_from_li_element', 10, 2 );
