<?php

/**
 * Walker Texas Ranger
 * Inserts some BEM naming sensibility into Wordpress menus
 */

class walker_texas_ranger extends Walker_Nav_Menu {
    public $column_is_open;
    public $description;
    public $mega_menu;

    function __construct($css_class_prefix) {

        $this->css_class_prefix = $css_class_prefix;

        // Define menu item names appropriately
        $this->item_css_class_suffixes = array(
            'item'                      => '__item',
            'parent_item'               => '__item--parent',
            'active_item'               => '__item--active',
            'parent_of_active_item'     => '__item--parent--active',
            'ancestor_of_active_item'   => '__item--ancestor--active',
            'sub_menu'                  => '__sub-menu',
            'sub_menu_item'             => '__sub-menu__item',
            'link'                      => '__link',
            'mega'                      => '__mega-menu',
        );

        $column_is_open = false;
        $this->$column_is_open = $column_is_open;
    }

    // Check for children

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_lvl(&$output, $depth = 1, $args=array()) {
        $real_depth = $depth + 1;

        $indent = str_repeat("\t", $real_depth);

        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;

        $classes = array(
            $prefix . $suffix['sub_menu'],
            $prefix . $suffix['sub_menu']. '--' . $real_depth,
        );

        $column_is_open = '';
        if($this->$column_is_open) {
            $output .= '</ul></li>';
            $this->$column_is_open = false;
        }
        

        $class_names = implode( ' ', $classes );

        // Add a ul wrapper to sub nav
        $output .= "\n" . $indent . '<ul class="'. $class_names .'" aria-hidden="true">' ."\n";
        
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
        $column_is_open = '';
        if($this->$column_is_open) {
            $output .= '</ul></li>';
            $this->$column_is_open = false;
        }

    }

    // Add main/sub classes to li's and links

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent

        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;

        $mega_menu = get_field( 'mega_menu', $item );

        if(get_field('column_start', $item)) {
            $column_is_open = '';
            
            if($this->$column_is_open) {
                $output .= '</ul></li>';
                $this->$column_is_open = false;
            }
            $output .= '<li class="site-menu__sub-menu__item site-menu__sub-menu__item--column"><ul class="site-menu__sub-menu site-menu__sub-menu--column">';
            $this->$column_is_open = true;
        }

        // Item classes
        $item_classes =  array(
            'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : '',
            'parent_class'          => $args->has_children ? $parent_class = $prefix . $suffix['parent_item'] : '',
            'active_page_class'     => in_array("current-menu-item",$item->classes) ? $prefix . $suffix['active_item'] : '',
            'active_parent_class'   => in_array("current-menu-parent",$item->classes) ? $prefix . $suffix['parent_of_active_item'] : '',
            'active_ancestor_class' => in_array("current-menu-ancestor",$item->classes) ? $prefix . $suffix['ancestor_of_active_item'] : '',
            'depth_class'           => $depth >=1 ? $prefix . $suffix['sub_menu_item'] . ' ' . $prefix . $suffix['sub_menu'] . '--' . $depth . '__item' : '',
            'has_children_class'    => $args->has_children && $depth >=1 ? $prefix . $suffix['sub_menu_item'] . ' ' . $prefix . $suffix['sub_menu'] . '--' . $depth . '__item' . '--has-children' : '',
            'has_mega_classs'       =>  $args->has_children && $mega_menu == true ? $prefix . $suffix['mega'] : '',
            'item_id_class'         => $prefix . '__item--'. $item->object_id,
            'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--'. $item->classes[0] : '',
            'color_scheme'          => 'color-scheme-'.get_field('color_scheme', $item),
            'description_style'     => $item->description !== '' ? 'description-style-'.get_field('description_style', $item) : '',
        );

        //is it actually a link or just a placeholder
        if ( empty($item->url) || $item->url == '#' ){
            $item_is_link = false;
        } else {
            $item_is_link = true;
        }

        // convert array to string excluding any empty values
        $class_string = implode("  ", array_filter($item_classes));


        //add aria popup if item has children
        $aria_has_popup = $args->has_children ? ' aria-haspopup="true" ' : '';

        // Add the classes to the wrapping <li>
        $output .= $indent . '<li class="' . $class_string . '" role="menuitem" tabindex="-1" '.$aria_has_popup.'>';

        // Link classes
        $link_classes = array(
            'item_link'             => $depth == 0 ? $prefix . $suffix['link'] : '',
            'depth_class'           => $depth >=1 ? $prefix . $suffix['sub_menu'] . $suffix['link'] . '  ' . $prefix . $suffix['sub_menu'] . '--' . $depth . $suffix['link'] : '',
            'item_has_children'     => $depth >= 1 && $args->has_children ? $prefix . $suffix['sub_menu'] . '--' . $depth . $suffix['link'] . '--has-children' : '',
        );

        $link_class_string = implode("  ", array_filter($link_classes));
         if(!$item_is_link) {
            $link_class_string .= ' site-menu__link--label ';
        }
        $link_class_output = 'class="' . $link_class_string . '"';

        $attributes = '';

        if ( $item_is_link ){
            $tag = 'a';
            $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
            $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
            $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
        } else {
            $tag = 'span';
        }

        $description = '';
        $description = $item->description !== '' ? '<span class="site-menu__description">'.$item->description.'</span>' : '';

        // Create link markup
        $item_output = $args->before;
        //data atribute lets us target the section via css without worrying about the wordpress ID
        $item_output .= '<'.$tag . $attributes . ' ' . $link_class_output . ' data-title="' . apply_filters('the_title', $item->title, $item->ID) .'" ' .'>';
        $item_output .=     $args->link_before;
        $item_output .=     '<span class="site-menu__link-text">'.apply_filters('the_title', $item->title, $item->ID).'</span>';
        $item_output .=     $args->link_after;
        $item_output .=     $args->after;
        $item_output .=     $description;
        $item_output .= '</'.$tag.'>';


        // Filter <li>

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

/**
 * bem_menu returns an instance of the walker_texas_ranger class with the following arguments
 * @param  string $location This must be the same as what is set in wp-admin/settings/menus for menu location.
 * @param  string $css_class_prefix This string will prefix all of the menu's classes, BEM syntax friendly
 * @param  arr/string $css_class_modifiers Provide either a string or array of values to apply extra classes to the <ul> but not the <li's>
 * @return [type]
 */

function bem_menu($location = "main_menu", $css_class_prefix = 'main-menu', $css_class_modifiers = null){

    // Check to see if any css modifiers were supplied
    if($css_class_modifiers){

        if(is_array($css_class_modifiers)){
            $modifiers = implode(" ", $css_class_modifiers);
        } elseif (is_string($css_class_modifiers)) {
            $modifiers = $css_class_modifiers;
        }

    } else {
        $modifiers = '';
    }

    $args = array(
        'theme_location'    => $location,
        'container'         => false,
        'items_wrap'        => '<ul class="' . $css_class_prefix . ' ' . $modifiers . '" role="menubar" aria-hidden="false">%3$s</ul>',
        'walker'            => new walker_texas_ranger($css_class_prefix, true)
    );

    if (has_nav_menu($location)){
        return wp_nav_menu($args);
    }else{
        echo "<p>You need to first define a menu in WP-admin<p>";
    }
}
