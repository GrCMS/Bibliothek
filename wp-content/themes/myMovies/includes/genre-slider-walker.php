<?php

/**
 * Custom nav walker for genre slider, used to add css classes needed by genre slider script
 */
class genre_slider_walker extends Walker_Nav_Menu {

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    // Displays start of a level. E.g '<ul>'
    // @see Walker::start_lvl()
    function start_lvl(&$output, $depth, $args) {

        $output .= "<ul class='sub'>";
    }

    // Displays end of a level. E.g '</ul>'
    // @see Walker::end_lvl()
    function end_lvl(&$output, $depth, $args) {

        $output .= "</ul>";
    }

    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth, $args) {

        global $wp_query;

        $attributes  = ! empty ( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty ( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty ( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty ( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        
        if ($item->hasChildren) {
            
            $output .= "<li class='has'><a" . $attributes . ">" . esc_attr($item->title) . "</a>";
        } else {
            
            $output .= "<li><a" . $attributes . ">" . esc_attr($item->title) . "</a>";
        }
    }

    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el(&$output, $item, $depth, $args) {

        $output .= "</li>";
    }

}

?>