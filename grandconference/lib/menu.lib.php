<?php
/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', esc_html__('Primary Menu', 'grandconference' ) );
	
	if(GRANDCONFERENCE_THEMEDEMO)
	{
		register_nav_menu( 'demo-primary-menu', esc_html__('Demo Primary Menu', 'grandconference' ) );
	}
	
	register_nav_menu( 'secondary-menu', esc_html__('Secondary Menu', 'grandconference' ) );
	register_nav_menu( 'top-menu', esc_html__('Top Bar Menu', 'grandconference' ) );
	register_nav_menu( 'side-menu', esc_html__('Side (Mobile) Menu', 'grandconference' ) );
	register_nav_menu( 'footer-menu', esc_html__('Footer Menu', 'grandconference' ) );
}

class grandconference_walker extends Walker_Nav_Menu {

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args=array(), &$output='') {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'arrow'; //enter any classname you like here!
        }
        
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;
		$megamenu = get_post_meta( $item->ID, 'menu-item-megamenu', true );

		
		$item_classes = '';
		if(is_array($item->classes)) {
			$item_classes = implode(" ", $item->classes);
		}
		else if(is_string($item->classes)) {
			$item_classes = $item->classes;
		}
		$output .= "<li class='" . $item_classes;
		
		if($depth == 0 && !empty($megamenu))
		{
			$output .= " elementor-megamenu megamenu arrow";
		}
		
		$output .= "'>";
		
		$output .= '<a href="'.esc_url($permalink).'" ';
		
		if(!empty($item->target)) {
			$output.= 'target="' . esc_attr( $item->target ) .'"';  
		}
		
		$output .= '><span class="grandconference-menu-title">'.$title.'</span>';
		$output .= '</a>';
		
		if($depth == 0 && !empty($megamenu))
		{
			if(!empty($megamenu) && class_exists("\\Elementor\\Plugin"))
			{
				$output .= '<div class="elementor-megamenu-wrapper"> '.grandconference_get_elementor_content($megamenu).'</div>';
			}
		}
	}
}

function grandconference_menu_prefix_edit_classes( $classes, $item ) {
	$char = "#";
	
	if(strpos($item->url, $char) !== false){
		if ( ( $key = array_search( 'current-menu-item', $classes ) ) !== false ) {
			unset( $classes[$key] );
		}
	}
	
	return $classes;
}
add_filter( 'nav_menu_css_class', 'grandconference_menu_prefix_edit_classes', 10, 2 );
?>