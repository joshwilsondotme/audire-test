<?php
/**
 * Unregister CPTs provided by WAD plugin, Simple Staff List,
 * and WPSL_Store_Locator
 *
 * This can be removed if those plugins are no longer network activated
 */
add_action('init', function () {
  // unregister_post_type('wpsl_stores');
  // unregister_post_type('news');
  unregister_post_type('staff-member');
  unregister_post_type('forms');
  unregister_post_type('cnss_social_icon_page');

}, 30);

/**
 * Register Custom Taxonomy for Product
 */
add_action( 'init', 'product_type', 0 );
function product_type() {

  $labels = array(
    'name'                       => __( 'Product Types', 'Taxonomy General Name' ),
    'singular_name'              => __( 'Product Type', 'Taxonomy Singular Name' ),
    'menu_name'                  => __( 'Product Types' ),
    'all_items'                  => __( 'All Items' ),
    'parent_item'                => __( 'Parent Item' ),
    'parent_item_colon'          => __( 'Parent Item:' ),
    'new_item_name'              => __( 'New Item Name' ),
    'add_new_item'               => __( 'Add New Item' ),
    'edit_item'                  => __( 'Edit Item' ),
    'update_item'                => __( 'Update Item' ),
    'view_item'                  => __( 'View Item' ),
    'separate_items_with_commas' => __( 'Separate items with commas' ),
    'add_or_remove_items'        => __( 'Add or remove items' ),
    'choose_from_most_used'      => __( 'Choose from the most used' ),
    'popular_items'              => __( 'Popular Items' ),
    'search_items'               => __( 'Search Items' ),
    'not_found'                  => __( 'Not Found' ),
    'no_terms'                   => __( 'No items' ),
    'items_list'                 => __( 'Items list' ),
    'items_list_navigation'      => __( 'Items list navigation' ),
  );
  
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,

   );
  
  register_taxonomy( 
    'product_type', 
    array( 'products' ), $args );

}



/**
 * Register Staff CPT
 */

add_action( 'init', 'register_staff' );

function register_staff() {
  
  //Staff Post Type 
  $labels = array(
    'name'                       => __( 'Staff Members' ),
    'singular_name'              => __( 'Staff' ),
    'add_new'                    => __('Add New Staff'),
    'add_new_item'               => __('Add New Staff'),
    'edit_item'                  => __('Edit Staff'),
    'new_item'                   => __('New Staff'),
    'view_item'                  => __('View Staff'),
    'view_items'                 => __('View Staffs'),
    'not_found'                  => __('No Staff Found'),
  );

  $args = array(
    'label'                      => __( 'Staff Members' ),
    'taxonomies'                 => array('staff_type'),
    'labels'                     => $labels,
    'description'                => '',
    'public'                     => true,
    'show_ui'                    => true,
    'show_in_rest'               => true,
    'rest_base'                  => '',
    'has_archive'                => true,
    'show_in_menu'               => true,
    'exclude_from_search'        => false,
    'capability_type'            => 'post',
    'map_meta_cap'               => true,
    'hierarchical'               => true,
    'query_var'                  => true,
    'menu_position'              => 22,
    'menu_icon'                  => 'dashicons-groups',
    'supports'                   => array( 'title', 'thumbnail' ),
    'menu_position'              => 7,
    'rewrite' => [ 
      'slug' => (!empty(get_option('migration_staff_slug'))) ? get_option('migration_staff_slug') : 'staff',
      'with_front' => false
    ],
  );
  
  register_post_type( 'staff_member', $args );

}

/**
 * Register Custom Taxonomy for Staff
 */
function staff_type() {

  $labels = array(
    'name'                       => __( 'Staff Role', 'Taxonomy General Name' ),
    'singular_name'              => __( 'Staff Role', 'Taxonomy Singular Name' ),
    'menu_name'                  => __( 'Staff Roles' ),
    'all_items'                  => __( 'All Items' ),
    'parent_item'                => __( 'Parent Item' ),
    'parent_item_colon'          => __( 'Parent Item:' ),
    'new_item_name'              => __( 'New Item Name' ),
    'add_new_item'               => __( 'Add New Item' ),
    'edit_item'                  => __( 'Edit Item' ),
    'update_item'                => __( 'Update Item' ),
    'view_item'                  => __( 'View Item' ),
    'separate_items_with_commas' => __( 'Separate items with commas' ),
    'add_or_remove_items'        => __( 'Add or remove items' ),
    'choose_from_most_used'      => __( 'Choose from the most used' ),
    'popular_items'              => __( 'Popular Items' ),
    'search_items'               => __( 'Search Items' ),
    'not_found'                  => __( 'Not Found' ),
    'no_terms'                   => __( 'No items' ),
    'items_list'                 => __( 'Items list' ),
    'items_list_navigation'      => __( 'Items list navigation' ),
  );
  
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
   );
  
  register_taxonomy( 'staff_type', array( 'staff_post_type' ), $args );

}
add_action( 'init', 'staff_type', 0 );

/**
 * Adding Services Slug Option to Permalinks page
 */

 // Add setting
 add_action('admin_init', function() {
	add_settings_field('migration_staff_slug', __('Staff base', 'txtdomain'), 'mytest_staff_slug_output', 'permalink', 'optional');
});
 
// Setting output
function mytest_staff_slug_output() {
	?>
	<input name="migration_staff_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('migration_staff_slug')); ?>" placeholder="<?php echo 'staff'; ?>" />
	<?php
}
 
// Save setting
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('migration_staff_slug', trim($_POST['migration_staff_slug']));
    }
});



/**
 * Register Custom Taxonomy for Services
 */
function services_type() {

  $labels = array(
    'name'                       => __( 'Services Types', 'Taxonomy General Name' ),
    'singular_name'              => __( 'Services Type', 'Taxonomy Singular Name' ),
    'menu_name'                  => __( 'Services Types' ),
    'all_items'                  => __( 'All Items' ),
    'parent_item'                => __( 'Parent Item' ),
    'parent_item_colon'          => __( 'Parent Item:' ),
    'new_item_name'              => __( 'New Item Name' ),
    'add_new_item'               => __( 'Add New Item' ),
    'edit_item'                  => __( 'Edit Item' ),
    'update_item'                => __( 'Update Item' ),
    'view_item'                  => __( 'View Item' ),
    'separate_items_with_commas' => __( 'Separate items with commas' ),
    'add_or_remove_items'        => __( 'Add or remove items' ),
    'choose_from_most_used'      => __( 'Choose from the most used' ),
    'popular_items'              => __( 'Popular Items' ),
    'search_items'               => __( 'Search Items' ),
    'not_found'                  => __( 'Not Found' ),
    'no_terms'                   => __( 'No items' ),
    'items_list'                 => __( 'Items list' ),
    'items_list_navigation'      => __( 'Items list navigation' ),
  );
  
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true
   );
  
  register_taxonomy( 'services_type', array( 'services' ), $args );

}
add_action( 'init', 'services_type', 0 );


/**
 * Adding Services Slug Option to Permalinks page
 */

 // Add setting
add_action('admin_init', function() {
	add_settings_field('migration_services_slug', __('Services base', 'txtdomain'), 'mytest_services_slug_output', 'permalink', 'optional');
});
 
// Setting output
function mytest_services_slug_output() {
	?>
	<input name="migration_services_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('migration_services_slug')); ?>" placeholder="<?php echo 'services'; ?>" />
	<?php
}
 
// Save setting
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('migration_services_slug', trim($_POST['migration_services_slug']));
    }
});

/**
 * Register Custom Taxonomy for Resources
 */
function resources_type() {

  $labels = array(
    'name'                       => __( 'Resources Types', 'Taxonomy General Name' ),
    'singular_name'              => __( 'Resources Type', 'Taxonomy Singular Name' ),
    'menu_name'                  => __( 'Resources Types' ),
    'all_items'                  => __( 'All Items' ),
    'parent_item'                => __( 'Parent Item' ),
    'parent_item_colon'          => __( 'Parent Item:' ),
    'new_item_name'              => __( 'New Item Name' ),
    'add_new_item'               => __( 'Add New Item' ),
    'edit_item'                  => __( 'Edit Item' ),
    'update_item'                => __( 'Update Item' ),
    'view_item'                  => __( 'View Item' ),
    'separate_items_with_commas' => __( 'Separate items with commas' ),
    'add_or_remove_items'        => __( 'Add or remove items' ),
    'choose_from_most_used'      => __( 'Choose from the most used' ),
    'popular_items'              => __( 'Popular Items' ),
    'search_items'               => __( 'Search Items' ),
    'not_found'                  => __( 'Not Found' ),
    'no_terms'                   => __( 'No items' ),
    'items_list'                 => __( 'Items list' ),
    'items_list_navigation'      => __( 'Items list navigation' ),
  );
  
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true
   );
  
  register_taxonomy( 'resources_type', array( 'resources' ), $args );

}
add_action( 'init', 'resources_type', 0 );


/**
 * Display custom Staff member title input placeholder
 */
add_filter( 'enter_title_here', function( $title ) {
    $screen = get_current_screen();

    if ( 'staff_member' == $screen->post_type ){
      $title = 'Add Staff Name';
    }

    return $title;
} );

/**
 * Display custom Location title input placeholder
 */
add_filter( 'enter_title_here', function( $title ) {
    $screen = get_current_screen();

    if ( 'location' == $screen->post_type ){
        $title = 'Add Office Name';
    }

    return $title;
} );

/**
 * Adding Products Slug Option to Permalinks page
 */

 // Add setting
 add_action('admin_init', function() {
	add_settings_field('migration_products_slug', __('Products base', 'txtdomain'), 'mytest_products_slug_output', 'permalink', 'optional');
});
 
// Setting output
function mytest_products_slug_output() {
	?>
	<input name="migration_products_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('migration_products_slug')); ?>" placeholder="<?php echo 'products'; ?>" />
	<?php
}
 
// Save setting
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('migration_products_slug', trim($_POST['migration_products_slug']));
    }
});

/**
 * Adding Resources Slug Option to Permalinks page
 */

 // Add setting
 add_action('admin_init', function() {
	add_settings_field('migration_resources_slug', __('Resources base', 'txtdomain'), 'mytest_resources_slug_output', 'permalink', 'optional');
});
 
// Setting output
function mytest_resources_slug_output() {
	?>
	<input name="migration_resources_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('migration_resources_slug')); ?>" placeholder="<?php echo 'resources'; ?>" />
	<?php
}
 
// Save setting
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('migration_resources_slug', trim($_POST['migration_resources_slug']));
    }
});

/**
 * Changing slugs of pre-registered custom post types
 */

function change_post_types_slug( $args, $post_type ) {

  /*item post type slug*/   
  if ( 'services' === $post_type ) {
     $args['rewrite']['slug'] = (!empty(get_option('migration_services_slug'))) ? get_option('migration_services_slug') : 'services';
  }
  if ( 'products' === $post_type ) {
     $args['rewrite']['slug'] = (!empty(get_option('migration_products_slug'))) ? get_option('migration_products_slug') : 'products';
  }
  if ( 'resources' === $post_type ) {
     $args['rewrite']['slug'] = (!empty(get_option('migration_resources_slug'))) ? get_option('migration_resources_slug') : 'resources';
  }

  return $args;
}
add_filter( 'register_post_type_args', 'change_post_types_slug', 10, 2 );

function services_insert_types() {
  $parent_term = term_exists( 'services_type' ); // array is returned if taxonomy is given
  $parent_term_id = $parent_term['term_id']; // get numeric term id
  wp_insert_term(
    'General Service',
    'services_type',
    array(
      'description' => '',
      'slug'        => 'general-service'
    )
  );
  wp_insert_term(
    'Hearing Aid Service',
    'services_type',
    array(
      'description' => '',
      'slug'        => 'hearing-aid-service'
    )
  );
  wp_insert_term(
    'Hearing Test',
    'services_type',
    array(
      'description' => '',
      'slug'        => 'hearing-test'
    )
  );
  wp_insert_term(
    'Specialty',
    'services_type',
    array(
      'description' => '',
      'slug'        => 'specialty'
    )
  );
}
add_action( 'init', 'services_insert_types' );

function resources_insert_types() {
  $parent_term = term_exists( 'resources_type' ); // array is returned if taxonomy is given
  $parent_term_id = $parent_term['term_id']; // get numeric term id
  wp_insert_term(
    'Financing',
    'resources_type',
    array(
      'description' => '',
      'slug'        => 'financing'
    )
  );
  wp_insert_term(
    'Hearing Loss',
    'resources_type',
    array(
      'description' => '',
      'slug'        => 'hearing-loss'
    )
  );
  wp_insert_term(
    'Patient Link',
    'resources_type',
    array(
      'description' => '',
      'slug'        => 'patient-link'
    )
  );
  wp_insert_term(
    'Tinnitus',
    'resources_type',
    array(
      'description' => '',
      'slug'        => 'tinnitus'
    )
  );
}
add_action( 'init', 'resources_insert_types' );

function products_insert_types() {
  $parent_term = term_exists( 'product_type' ); // array is returned if taxonomy is given
  $parent_term_id = $parent_term['term_id']; // get numeric term id
  wp_insert_term(
    'Assistive Listening Device',
    'product_type',
    array(
      'description' => '',
      'slug'        => 'assistive-listening-device'
    )
  );
  wp_insert_term(
    'Hearing Protection',
    'product_type',
    array(
      'description' => '',
      'slug'        => 'hearing-protection'
    )
  );
  wp_insert_term(
    'Hearing Technology',
    'product_type',
    array(
      'description' => '',
      'slug'        => 'hearing-technology'
    )
  );
  wp_insert_term(
    'Manufacturer',
    'product_type',
    array(
      'description' => '',
      'slug'        => 'manufacturer'
    )
  );
}
add_action( 'init', 'products_insert_types' );