<?php
    function create_custom_postypes() {

        // CPT: Event
        $labels = array (
            'name' => 'Events',
            'singular_name' => 'Event',
            'menu_name' => 'Events',
            'name_admin_bar' => 'Event',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Event',
            'new_item' => 'New Event Content',
            'edit_item' => 'Edit Event Content',
            'view_item' => 'View Event Content',
            'all_items' => 'All Events',
            'search_items' => 'Search Event Contents',
            'parent_item_colon' => 'Parent Event Content',
            'not_found' => 'No Event Content Found',
            'not_found_in_trash' => 'No Event Content Found in Trash'
        );

        $args = array (
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-calendar-alt',
                'query_var' => true,
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' ),
                'taxonomies' => array( 'category' ),
        );
        register_post_type( 'events', $args );

        // CPT: Resource
        $labels = array (
                'name' => 'Resources',
                'singular_name' => 'Resource',
                'menu_name' => 'Resources',
                'name_admin_bar' => 'Resource',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Resource',
                'new_item' => 'New Resource',
                'edit_item' => 'Edit Resource Content',
                'view_item' => 'View Resource Content',
                'all_items' => 'All Resources',
                'search_items' => 'Search Resource Content',
                'parent_item_colon' => 'Parent Resource Content',
                'not_found' => 'No Resource Content Found',
                'not_found_in_trash' => 'No Resource Content Found in Trash'
        );

        $args = array (
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-category',
                'query_var' => true,
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' )
        );
        register_post_type( 'resources', $args );

        // CPT: Newsroom
        $labels = array (
                'name' => 'Newsrooms',
                'singular_name' => 'Newsroom',
                'menu_name' => 'Newsrooms',
                'name_admin_bar' => 'Newsroom',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Newsroom',
                'new_item' => 'New Newsroom',
                'edit_item' => 'Edit Newsroom Content',
                'view_item' => 'View Newsroom Content',
                'all_items' => 'All Newsrooms',
                'search_items' => 'Search Newsroom Content',
                'parent_item_colon' => 'Parent NewsroomContent',
                'not_found' => 'No Newsroom Content Found',
                'not_found_in_trash' => 'No Newsroom Content Found in Trash'
        );

        $args = array (
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-layout',
                'query_var' => true,
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' )
        );
        register_post_type( 'newsrooms', $args );
    }

    add_action( 'init', 'create_custom_postypes' );

// Taxonomy for Portfolio
    function create_taxonomies() {

            // for categories
            $labels = array(
                    'name' => 'Event Tags',
                    'singular_name' => 'Event Tag',
                    'search_items' => 'Search Event Tags',
                    'all_items' => 'All Event Tags',
                    'parent_item' => 'Parent Event Tag',
                    'parent_item_colon' => 'Parent Event Tag:',
                    'edit_item' => 'Edit Event Tag',
                    'update_item' => 'Update Event Tag',
                    'add_new_item' => 'Add Event Tag',
                    'new_item_name' => 'New Event Tag Name',
                    'menu_name' => 'Event Tag'
            );

            $args = array (
                    'hierarchical' => true,
                    'labels' => $labels,
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => 'Event-group' )
            );

            register_taxonomy( 'event-group', array( 'events' ), $args );

            $labels = array(
                    'name' => 'Resource Tags',
                    'singular_name' => 'Resource Tag',
                    'search_items' => 'Search Resource Tags',
                    'all_items' => 'All Resource Tags',
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edit Resource Tag',
                    'update_item' => 'Update Resource Tag',
                    'add_new_item' => 'Add Resource Tag',
                    'new_item_name' => 'New Resource Tag Name',
                    'menu_name' => 'Resource Tag'
            );

            $args = array (
                    'hierarchical' => true,
                    'labels' => $labels,
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => 'Resource-group' )
            );

            register_taxonomy( 'resource-tag', array( 'resources' ), $args );

            $labels = array(
                    'name' => 'Newsroom Tags',
                    'singular_name' => 'Newsroom Tag',
                    'search_items' => 'Search Newsroom Tags',
                    'all_items' => 'All Newsroom Tags',
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edit Newsroom Tag',
                    'update_item' => 'Update Newsroom Tag',
                    'add_new_item' => 'Add Newsroom Tag',
                    'new_item_name' => 'New Newsroom Tag Name',
                    'menu_name' => 'Newsroom Tag'
            );

            $args = array (
                    'hierarchical' => true,
                    'labels' => $labels,
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => 'Newsroom-group' )
            );

            register_taxonomy( 'newsroom-tag', array( 'newsrooms' ), $args );

    }

    add_action( 'init', 'create_taxonomies' );
?>