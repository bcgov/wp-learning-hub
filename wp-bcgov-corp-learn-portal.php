<?php
/*
Plugin Name: BC Gov Corporate Learning Hub
Plugin URI: https://github.com/allanhaggett/wp-bcgov-learning-hub/
Description: A gateway to everything that BC Gov has to offer for learning opportunities.
Author: Allan Haggett <allan.haggett@gov.bc.ca>
Version: 2.0
Author URI: https://learningcenter.gww.gov.bc.ca/learninghub/
*/


/**
 * Start by defining the course content type, then start tacking on our taxonomies
 */
function my_custom_post_course() {
    $labels = array(
        'name'               => _x( 'Courses', 'post type general name' ),
        'singular_name'      => _x( 'Course', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'course' ),
        'add_new_item'       => __( 'Add New Course' ),
        'edit_item'          => __( 'Edit Course' ),
        'new_item'           => __( 'New Course' ),
        'all_items'          => __( 'All Courses' ),
        'view_item'          => __( 'View Course' ),
        'search_items'       => __( 'Search Courses' ),
        'not_found'          => __( 'No courses found' ),
        'not_found_in_trash' => __( 'No courses found in the Trash' ), 
        'parent_item_colon'  => __( 'Parent courses: ' ), 
        'menu_name'          => 'Courses'
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Holds courses and course specific data',
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'capability_type'     => 'page',
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'          => 'dashicons-book',
        'supports'            => array( 'title', 
                                        'editor', 
                                        'thumbnail',
                                        'author',
                                        'page-attributes',
                                        'custom-fields')
        // , 'custom-fields'        
    );
    register_post_type( 'course', $args ); 
}
add_action( 'init', 'my_custom_post_course' );


/**
 * Start applying various taxonomies; start with the methods, 
 * then init them all in one place
 */

/**
 * Courses can synchronize from multiple different Systems; 
 * e.g. PSA Learning System We use this taxonomy to keep things fresh with that system, 
 * so we can update/add/remove courses within each system separately.
 */
function my_taxonomies_system() {
    $labels = array(
        'name'              => _x( 'Systems', 'taxonomy general name' ),
        'singular_name'     => _x( 'System', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Systems' ),
        'all_items'         => __( 'All Systems' ),
        'parent_item'       => __( 'Parent System' ),
        'parent_item_colon' => __( 'Parent System:' ),
        'edit_item'         => __( 'Edit System' ), 
        'update_item'       => __( 'Update System' ),
        'add_new_item'      => __( 'Add New System' ),
        'new_item_name'     => __( 'New System' ),
        'menu_name'         => __( 'External Systems' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'external_system', 'course', $args );
}

 /**
 * Learning Partner. Courses can synchronize from multiple different Learning Partners; 
 * e.g. PSA Learning System We use this taxonomy to keep things fresh with that system, 
 * so we can update/add/remove courses within each system separately.
 */
function my_taxonomies_learning_partner() {
    $labels = array(
        'name'              => _x( 'Learning Partners', 'taxonomy general name' ),
        'singular_name'     => _x( 'Learning Partners', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Learning Partners' ),
        'all_items'         => __( 'All Learning Partners' ),
        'parent_item'       => __( 'Parent Learning Partner' ),
        'parent_item_colon' => __( 'Parent Learning Partner:' ),
        'edit_item'         => __( 'Edit Learning Partner' ), 
        'update_item'       => __( 'Update Learning Partner' ),
        'add_new_item'      => __( 'Add New Learning Partner' ),
        'new_item_name'     => __( 'New Learning Partner' ),
        'menu_name'         => __( 'Learning Partners' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );  
    register_taxonomy( 'learning_partner', 'course', $args );
}

/**
 * Course Categories
 */
// function my_taxonomies_course_category() {
//     $labels = array(
//         'name'              => _x( 'Course Categories', 'taxonomy general name' ),
//         'singular_name'     => _x( 'Course Category', 'taxonomy singular name' ),
//         'search_items'      => __( 'Search Course Categories' ),
//         'all_items'         => __( 'All Course Categories' ),
//         'parent_item'       => __( 'Parent Course Category' ),
//         'parent_item_colon' => __( 'Parent Course Category:' ),
//         'edit_item'         => __( 'Edit Course Category' ), 
//         'update_item'       => __( 'Update Course Category' ),
//         'add_new_item'      => __( 'Add New Course Category' ),
//         'new_item_name'     => __( 'New Course Category' ),
//         'menu_name'         => __( 'Course Categories' ),
//     );
//     $args = array(
//         'labels' => $labels,
//         'hierarchical' => true,
//         'show_in_rest' => true,
//     );
//     register_taxonomy( 'course_category', 'course', $args );
// }

/**
 * Delivery Methods
 */
function my_taxonomies_course_delivery_method() {
    $labels = array(
        'name'              => _x( 'Delivery Methods', 'taxonomy general name' ),
        'singular_name'     => _x( 'Delivery Method', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Delivery Methods' ),
        'all_items'         => __( 'All Delivery Methods' ),
        'parent_item'       => __( 'Parent Delivery Method' ),
        'parent_item_colon' => __( 'Parent Delivery Method:' ),
        'edit_item'         => __( 'Edit Delivery Method' ), 
        'update_item'       => __( 'Update Delivery Method' ),
        'add_new_item'      => __( 'Add New Delivery Method' ),
        'new_item_name'     => __( 'New Delivery Method' ),
        'menu_name'         => __( 'Delivery Methods' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'delivery_method', 'course', $args );
}


/** 
 * Course keywords for more targeted searches
 */
function my_taxonomies_course_keywords() {
    $labels = array(
        'name'              => _x( 'Keywords', 'taxonomy general name' ),
        'singular_name'     => _x( 'Keyword', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Keywords' ),
        'all_items'         => __( 'All Keywords' ),
        'parent_item'       => __( 'Parent Keyword' ),
        'parent_item_colon' => __( 'Parent Keyword:' ),
        'edit_item'         => __( 'Edit Keyword' ), 
        'update_item'       => __( 'Update Keyword' ),
        'add_new_item'      => __( 'Add New Keyword' ),
        'new_item_name'     => __( 'New Keyword' ),
        'menu_name'         => __( 'Keywords' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'keywords', 'course', $args );
}

/** 
 * Course topics aligning with Corporate Learning Framework
 */
function my_taxonomies_course_topics() {
    $labels = array(
        'name'              => _x( 'Topics', 'taxonomy general name' ),
        'singular_name'     => _x( 'Topic', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Topics' ),
        'all_items'         => __( 'All Topics' ),
        'parent_item'       => __( 'Parent Topic' ),
        'parent_item_colon' => __( 'Parent Topic' ),
        'edit_item'         => __( 'Edit Topic' ), 
        'update_item'       => __( 'Update Topic' ),
        'add_new_item'      => __( 'Add New Topic' ),
        'new_item_name'     => __( 'New Topic' ),
        'menu_name'         => __( 'Topics' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'topics', 'course', $args );
}
/** 
 * Course groups aligning with Corporate Learning Framework
 */
function my_taxonomies_course_groups() {
    $labels = array(
        'name'              => _x( 'Groups', 'taxonomy general name' ),
        'singular_name'     => _x( 'Group', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Groups' ),
        'all_items'         => __( 'All Groups' ),
        'parent_item'       => __( 'Parent Group' ),
        'parent_item_colon' => __( 'Parent Group' ),
        'edit_item'         => __( 'Edit Group' ), 
        'update_item'       => __( 'Update Group' ),
        'add_new_item'      => __( 'Add New Group' ),
        'new_item_name'     => __( 'New Group' ),
        'menu_name'         => __( 'Groups' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'groups', 'course', $args );
}
/** 
 * Course audience aligning with Corporate Learning Framework
 */
function my_taxonomies_course_audience() {
    $labels = array(
        'name'              => _x( 'Audiences', 'taxonomy general name' ),
        'singular_name'     => _x( 'Audience', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Audiences' ),
        'all_items'         => __( 'All Audiences' ),
        'parent_item'       => __( 'Parent Audience' ),
        'parent_item_colon' => __( 'Parent Audience' ),
        'edit_item'         => __( 'Edit Audience' ), 
        'update_item'       => __( 'Update Audience' ),
        'add_new_item'      => __( 'Add New Audience' ),
        'new_item_name'     => __( 'New Audiences' ),
        'menu_name'         => __( 'Audiences' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'audience', 'course', $args );
}

/** 
 * Course journeys
 */
function my_taxonomies_course_journey() {
    $labels = array(
        'name'              => _x( 'Journeys', 'taxonomy general name' ),
        'singular_name'     => _x( 'Journey', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Journeys' ),
        'all_items'         => __( 'All Journeys' ),
        'parent_item'       => __( 'Parent Journey' ),
        'parent_item_colon' => __( 'Parent Journey' ),
        'edit_item'         => __( 'Edit Journey' ), 
        'update_item'       => __( 'Update Journey' ),
        'add_new_item'      => __( 'Add New Journey' ),
        'new_item_name'     => __( 'New Journey' ),
        'menu_name'         => __( 'Journeys' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
          'manage_terms' => 'edit_posts',
          'edit_terms' => 'manage_options',
          'delete_terms' => 'manage_options',
          'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy( 'journey', 'course', $args );
}

/** 
 * Now let's initiate all of those awesome taxonomies!
 */

add_action( 'init', 'my_taxonomies_course_journey', 0 );
add_action( 'init', 'my_taxonomies_course_audience', 0 );
add_action( 'init', 'my_taxonomies_course_groups', 0 );
add_action( 'init', 'my_taxonomies_course_topics', 0 );
// add_action( 'init', 'my_taxonomies_course_category', 0 );
add_action( 'init', 'my_taxonomies_course_delivery_method', 0 );
add_action( 'init', 'my_taxonomies_course_keywords', 0 );
add_action( 'init', 'my_taxonomies_learning_partner', 0 );
add_action( 'init', 'my_taxonomies_system', 0 );



// search all taxonomies, based on: http://projects.jesseheap.com/all-projects/wordpress-plugin-tag-search-in-wordpress-23

function lzone_search_where($where){
    global $wpdb;
    if (is_search())
      $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
    return $where;
  }
  
  function lzone_search_join($join){
    global $wpdb;
    if (is_search())
      $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
    return $join;
  }
  
  function lzone_search_groupby($groupby){
    global $wpdb;
  
    // we need to group on post ID
    $groupby_id = "{$wpdb->posts}.ID";
    if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;
  
    // groupby was empty, use ours
    if(!strlen(trim($groupby))) return $groupby_id;
  
    // wasn't empty, append ours
    return $groupby.", ".$groupby_id;
  }
  
  add_filter('posts_where','lzone_search_where');
  add_filter('posts_join', 'lzone_search_join');
  add_filter('posts_groupby', 'lzone_search_groupby');


function course_tax_template( $tax_template ) {
  global $post;
  $tax_template = dirname( __FILE__ ) . '/taxonomy.php';
  if ( is_tax ( 'learning_partner' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy-learning_partner.php';
  }
  if ( is_tax ( 'external_system' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy-external_system.php';
  }
  if ( is_tax ( 'audience' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy.php';
  }
  if ( is_tax ( 'groups' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy.php';
  }
  if ( is_tax ( 'topics' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy.php';
  }
  if ( is_tax ( 'delivery_method' ) ) {
    $tax_template = get_stylesheet_directory() . '/taxonomy.php';
  }
  return $tax_template;
}

add_filter( 'taxonomy_template', 'course_tax_template');


function course_menu() {
	add_submenu_page(
		'edit.php?post_type=course',
		__( 'External Systems Sync', 'ext-sys-sync' ),
		__( 'Systems Sync', 'systems-sync' ),
		'edit_posts',
		'systems-sync',
		'systems_sync'
	);
	add_submenu_page(
		null,
		null,
		null,
		'edit_posts',
		'course_mark_all_private',
		'course_mark_all_private'
	);
	add_submenu_page(
		null,
		null,
		null,
		'edit_posts',
		'course_elm_sync',
		'course_elm_sync'
	);
	add_submenu_page(
		null,
		null,
		null,
		'edit_posts',
		'curator_sync',
		'curator_sync'
	);
	add_submenu_page(
		null,
		null,
		null,
		'edit_posts',
		'expired_courses',
		'expired_courses'
	);

}
add_action( 'admin_menu', 'course_menu' );

/**
 * Create an index jumping off point to the system sync processes.
 * Currently both PSA Learning System (ELM) and LearningHUB are being 
 * supported.
 */
function systems_sync() {

	if ( !current_user_can( 'edit_posts' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    echo '<h1>External Systems Synchronization</h1>';
    echo '<p>The LearningHUB synchronizes with other systems, currently including the ';
    echo '<a href="https://learning.gov.bc.ca/CHIPSPLM/signon.html" target="_blank">PSA Learning System</a> and the ';
    echo '<a href="https://learningcurator.gww.gov.bc.ca/" target="_blank">Learning Curator</a>.</p>';
    echo '<p>Additionally, running this sync process will examine courses that aren\'t in a sync system which have an ';
    echo 'expiration date set. If the date is older than today, the course is marked private.</p>';
    $psalslink = admin_url('edit.php?noheader=true&post_type=course&page=course_elm_sync');
    echo '<div style="margin-bottom: 1em;">';
    echo '<a href="'.$psalslink.'" ';
    echo 'style="background-color: #222; border-radius: 5px; color: #FFF; display: inline-block; padding: .75em 2em; text-decoration: none;">';
    echo 'Start Systems Sync';
    echo '</a>';
    echo '</div>';

    // echo '<div>';
    // $curatorlink = admin_url('edit.php?noheader=true&post_type=course&page=curator_sync');
    // echo '<a href="'.$curatorlink.'" ';
    // echo 'style="background-color: #222; color: #FFF; display: inline-block; padding: .75em 2em;">';
    // echo 'Start synchronization with Learning Curator';
    // echo '</a>';
    // echo '</div>';

}

/**
 * Synchronize with the public feed for the PSA Learning System (ELM)
 */
function course_elm_sync () {

  if ( !current_user_can( 'edit_posts' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  // Get the feed and parse it into an array.
  // The following JSON end point is created as part of the ETL process 
  // of LSApp https://gww.bcpublicservice.gov.bc.ca/lsapp/course-feed/
  // Which takes two separate ELM queries and merges the output into this
  // JSON feed.
  $f = file_get_contents('https://learn.bcpublicservice.gov.bc.ca/learning-hub/learning-partner-courses.json');
  $feed = json_decode($f);
  
  // Create a hashmap of course IDs that are in the feed
  // so that we can easily use in_array to compare against while
  // we loop through all the published courses.
  $feedindex = [];
  foreach($feed->items as $feedcourse) {
    if(!empty($feedcourse->_course_id)) {
      array_push($feedindex, $feedcourse->_course_id);
    }
  }
  
  // Now we can loop through each of the exisiting published courses
  // and check each against the feedindex array.
  //
  // If we find a match, then we can look to getting the info from the feed 
  // and updating anything that needs updating e.g., add/remove keywords/topics.
  // 
  // If there isn't a match, then the course isn't in the feed and needs to 
  // be made private if it doesn't have the "Concurrent" keyword applied to it.
  // If it does have "Concurrent" keyword, then we add "tbscheduled" as a keyword
  // so that we can filter them out of the search results while keeping them public
  // with additional messaging that 
  // "this course may not have any current offerings but check back soon..."
  //
  // This loop through published courses only covers updates to exisiting 
  // courses and marking private (removing) courses that aren't in the feed.
  // After this loop is complete we do another run through the individual 
  // courses in the feed to cover adding any new courses that don't exist yet.
  // 

  //
  // Start by getting all the courses that are listed as being in the 
  // PSA Learning System, whatever the status (we even want existing private 
  // courses so that we can simply update and set back to published instead
  // of creating a whole new one.)
  //
  $courses = get_posts(array(
      'post_type' => 'course',
      'numberposts' => -1,
      'post_status'    => 'any',
      'tax_query' => array(
          array(
          'taxonomy' => 'external_system',
          'field' => 'slug',
          'terms' => 'psa-learning-system')
      ))
    );

  //
  // Create the array to array_push the existing course titles into
  $courseindex = [];
  // Loop though all the PSALS courses in the system.
  foreach ($courses as $course) {
    
      // Start by adding all the course IDs to the courseindex array so that
      // after this loop runs through, we can loop through the feed again
      // and find the courses that are new and need to be created from scratch.
      array_push($courseindex, $course->elm_course_id);

      // Does the course ID match an ID that's in the feed?
      if(in_array($course->elm_course_id, $feedindex)) {

          // Get the details for the feedcourse so we can compare
          foreach($feed->items as $f) {
            if(!empty($f->_course_id)) {
              if($f->_course_id == $course->elm_course_id) {
                $feedcourse = $f;
              }
            }
          }
        
          // Set a flag to determine if the course has been updated
          // so that we can not touch the database if we don't need to.
          $courseupdated = 0;

          // Compare more throughly for any updates.
          // If everything is the same then we're not actually touching the 
          // database at all in this process.
          if($feedcourse->title != $course->post_title) {
            $course->post_title = $feedcourse->title;
          }
          
          if($feedcourse->summary != $course->post_content) {
              // update post content
              $course->post_content = $feedcourse->summary;
              $course->post_excerpt = $feedcourse->summary;
              // Something changed, so we need to update the database.
              $courseupdated = 1;
          }

          // Make sure it's published just in case we're matching against a 
          // course that is currently private.
          if($course->post_status == 'private') {
            $course->post_status = 'publish';
            // Something changed, so we need to update the database.
            $courseupdated = 1;
          }

          // That's it for core details, so let's update the post if we need to.
          // After this we're updating the taxonomies & meta which happens with 
          // separate functions.
          if($courseupdated) {
            wp_update_post($course);
          }

          // The link directly to the course page on the external system.
          if($feedcourse->url != $course->course_link) {
            update_post_meta( $course->ID, 'course_link', $feedcourse->url );
          }
          // ELM course code e.g., ITEM-2089
          if($feedcourse->id != $course->elm_course_code) {
            update_post_meta( $course->ID, 'elm_course_code', $feedcourse->id );
          }
          // ELM course ID e.g., 29916
          // This should be commented out when the match index is set to 
          // this field instead of the name/title.
          // if($feedcourse->_course_id != $course->elm_course_id) {
          //   update_post_meta( $course->ID, 'elm_course_id', $feedcourse->_course_id );
          // }



          // Repeat the process above but for keywords instead of categories.
          // Get the keywords for this course from the feed.
          $feedkeys = explode(',', $feedcourse->_keywords);
          // Load up the categories currently associated with the course.
          $coursekeys = get_the_terms($course->ID,'keywords');
          if(!empty($feedkeys)) {
            // Update the course with the feed topics.
            // Testing if there are new terms and only add new ones. 
            // Passing an array of new terms rather than having a new 
            // wp_set_object_terms for each one. So, let's run through
            // the feed terms, compare with the existing terms and create a new 
            // array of only new terms, then run wp_set_object_terms with that.
            //
            // Create an index of the existing ones to 
            // match against.
            $ckindex = [];
            if(!empty($coursekeys)) {
              foreach($coursekeys as $ck) {
                array_push($ckindex,trim($ck->name));
              }
            }
            // echo '<pre>'; print_r($ctindex); exit;
            // Store any new cats in here
            $newkeys = [];
            // Run through each cat in the feed and check it
            foreach($feedkeys as $fk) {
              // Does this term NOT exist in the existing cats?
              if(!in_array($fk,$ckindex)) {
                // Add it to the array
                array_push($newkeys,$fk);
              }
            }
            
            // If the newcats array isn't empty, run wp_set_object_terms against
            // the new terms all in one go
            if(!empty($newkeys)) {
              wp_set_object_terms( $course->ID, $feedkeys, 'keywords', false);
            }

            // But now we also need to account for keywords that have been 
            // removed, so we quickly create an index of the existing ones to 
            // match against.
            $ckindex = [];
            foreach($coursekeys as $kc) {
              array_push($ckindex,$kc->name);
            }
            // Loop through each of the existing keywords so as to remove terms 
            // which don't exist in the terms in the feed
            foreach($coursekeys as $ck) {
                if(!in_array($ck->name, $feedkeys)) {
                    // The name of this course key isn't in the feed keys
                    // Delete the old keyword!
                    wp_remove_object_terms( $course->ID, $ck->name, 'keywords' );
                }
            }
          }

          $group = get_the_terms($course->ID,'groups');
          // There's only ever one 
          if(!empty($feedcourse->_group)) {
            if($group[0]->name != $feedcourse->_group) {
              wp_set_object_terms( $course->ID, sanitize_text_field($feedcourse->_group), 'groups', false);
            }
          }
          
          $audience = get_the_terms($course->ID,'audience');
          // There's only ever one 
          if(!empty($feedcourse->_audience)) {
            if($audience[0]->name != $feedcourse->_audience) {
              wp_set_object_terms( $course->ID, sanitize_text_field($feedcourse->_audience), 'audience', false);
            }
          }
          
          $topic = get_the_terms($course->ID,'topics');
          // There's only ever one 
          if(!empty($feedcourse->_topic)) {
            if($topic[0]->name != $feedcourse->_topic) {
              wp_set_object_terms( $course->ID, sanitize_text_field($feedcourse->_topic), 'topics', false);
            }
          }

          $coursepartner = get_the_terms($course->ID,'learning_partner');
          // There's only ever one partner #TODO support multiple partners?
          if($coursepartner[0]->name != $feedcourse->_learning_partner) {
              wp_set_object_terms( $course->ID, sanitize_text_field($feedcourse->_learning_partner), 'learning_partner', false);
          }

          // There's only ever one delivery method
          $coursemethod = get_the_terms($course->ID,'delivery_method');
          if($coursemethod[0]->name != $feedcourse->delivery_method) {
              wp_set_object_terms( $course->ID, sanitize_text_field($feedcourse->delivery_method), 'delivery_method', false);
          }

      } else { // The course ID doesn't match an ID that's in the feed:

        // First check to see if this course has a "Recurrent" keyword applied.
        // If it is recurrent we don't want to make it private as it is just
        // in between scheduled offerings.
        // If it is recurrent, simply add "tbscheduled" as a keyword and this
        // way we can filter them out of normal search results but still present
        // them as existing.

        //$coursekeys = get_the_terms($course->ID,'keywords');
        // We already got $coursekeys above so we just reuse that right?
        if(!empty($coursekeys)) {
          foreach($coursekeys as $ck) {
            if($ck->name == 'Recurrent') {
              // add "tbscheduled" so that we can filter them out

            }
          }
        }
        //... insert code here


        // If it's not recurrent and it's not in the feed anymore, make it PRIVATE.
        $course->post_status = 'private';
        wp_update_post( $course );

      }
  } // endforeach ($courses as $course)

  // Next, let's loop through the feed again, this time looking at the newly created
  // $courseindex array with just the published course names in it for easy lookup
  //
  // If the course doesn't exist within the catalog yet, then we create it!
  //
  foreach($feed->items as $feedcourse) {
    if(!empty($feedcourse->_course_id)) {
      if(!in_array($feedcourse->_course_id, $courseindex) && !empty($feedcourse->title)) {

          // This course isn't in the list of published courses
          // so it is new, so we need to create this course from scratch.
          // Set up the new course with basic settings in place
          $new_course = array(
              'post_title' => sanitize_text_field($feedcourse->title),
              'post_type' => 'course',
              'post_status' => 'publish', 
              'post_content' => sanitize_text_field($feedcourse->summary),
              'post_excerpt' => substr(sanitize_text_field($feedcourse->summary), 0, 100),
              'meta_input'   => array(
                  'course_link' => esc_url_raw($feedcourse->url),
                  'elm_course_code' => $feedcourse->id,
                  'elm_course_id' => $feedcourse->_course_id
              )
          );
          // Actually create the new post so that we can move on 
          // to updating it with taxonomy etc
          $post_id = wp_insert_post( $new_course );

          wp_set_object_terms( $post_id, sanitize_text_field($feedcourse->delivery_method), 'delivery_method', false);
          wp_set_object_terms( $post_id, sanitize_text_field($feedcourse->_learning_partner), 'learning_partner', false);
          wp_set_object_terms( $post_id, 'PSA Learning System', 'external_system', false);

          if(!empty($feedcourse->_keywords)) {
            $keywords = explode(',', $feedcourse->_keywords);
            wp_set_object_terms( $post_id, $keywords, 'keywords', true);
          }
          if(!empty($feedcourse->tags)) {
            $topics = explode(',', $feedcourse->tags);
            wp_set_object_terms( $post_id, $topics, 'topics', true);
          }

          // $to = 'allan.haggett@gov.bc.ca';
          // $subject = 'LearningHUB new course:' . $feedcourse->title;
          // $body = 'A new course was added from PSA Learning System to the LearningHUB "'  . $feedcourse->title . '"';
          // $headers = array('Content-Type: text/html; charset=UTF-8');
          // wp_mail( $to, $subject, $body, $headers );

      } 
      // otherwise, we've already dealt with things in the previous loop 
      // so do nothing else
    }
  }

  // $now = date('Y-m-d/TH:i:s');
  // $message = 'External Systems Sync run ' . $now;
  // following would depend on the wp action log plugin being installed...
  // do_action( ‘wp_log_info’, $label, $message );
  
  // header('Location: /learninghub/wp-admin/edit.php?post_type=course');
  header('Location: edit.php?noheader=true&post_type=course&page=curator_sync');
}

/**
 * Synchronize with the public feed for the Learning Curator.
 * https://learningcurator.gww.gov.bc.ca/
 * 
 * This is functionally almost identical to the PSALS sync above,
 * but some field-mapping is different and some taxes aren't needed.
 * If we have more than one more system that we want to sync with we 
 * should look to abstracting this into a single method to be DRY.
 */
function curator_sync () {

  if ( !current_user_can( 'edit_posts' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  // Get the feed and parse it into an array.
  // $f = file_get_contents('https://learningcurator.ca/pathways/jsonfeed');
  $f = file_get_contents('https://learningcurator.gww.gov.bc.ca/pathways/jsonfeed');
  $feed = json_decode($f);
  
  // Create a simple index of course names that are in the feed
  // so that we can easily use in_array to compare against while
  // we loop through all the published courses.
  $feedindex = [];
  foreach($feed->pathways as $feedcourse) {
    array_push($feedindex, trim($feedcourse->id));
  }

  // Now we can loop through each of the exisiting published courses
  // and check each against the feedindex array.
  //
  // If we find a match, then we can look to getting the info from the feed 
  // and updating anything that needs updating e.g., add/remove keywords/topics.
  // 
  // If there isn't a match, then the course isn't in the feed and needs to 
  // be made private.
  //
  // This loop through published courses only covers updates to exisiting 
  // courses and marking private (removing) courses that aren't in the feed.
  // After this loop is complete we do another run through the individual 
  // courses in the feed to cover adding any new courses that don't exist yet.
  // 

  //
  // Start by getting all the courses that are listed as being in the 
  // PSA Learning Curator, whatever the status (we even want existing private 
  // courses so that we can simply update and set back to published instead
  // of creating a whole new one.)
  //
  $courses = get_posts(array(
      'post_type' => 'course',
      'numberposts' => -1,
      'post_status'    => 'any',
      'tax_query' => array(
          array(
          'taxonomy' => 'external_system',
          'field' => 'slug',
          'terms' => 'psa-learning-curator')
      ))
    );

  //
  // Create the array to array_push the existing course titles into
  $courseindex = [];
  // Loop though all the PSALS courses in the system.
  foreach ($courses as $course) {
    
      // Start by adding all the course titles to the courseindex array so that
      // after this loop runs through, we can loop through the feed again
      // and find the courses that are new and need to be created from scratch.
      array_push($courseindex, htmlentities(trim($course->pathway_id)));

      // Does the course title match a title that's in the feed?
      if(in_array(trim($course->pathway_id), $feedindex)) {

          // Get the details for the feedcourse so we can compare
          foreach($feed->pathways as $f) {
              if(trim($f->id) == trim($course->pathway_id)) {
                $feedcourse = $f;
              }
          }
            // Set a flag to determine if the course has been updated
          // so that we can not touch the database if we don't need to.
          $courseupdated = 0;
          
          // Compare more throughly for any updates.
          // If everything is the same then we're not actually touching the 
          // database at all in this process.
          if($feedcourse->name != $course->post_title) {
              // update post title
              $course->post_title = $feedcourse->name;
              $courseupdated = 1;
          }
          if($feedcourse->objective != $course->post_content) {
              // update post content
              $course->post_content = $feedcourse->objective;
              $course->post_excerpt = $feedcourse->objective;
              $courseupdated = 1;
          }
          
          // Make sure it's published just in case we're matching against a 
          // course that is currently private.
          if($course->post_status == 'private') {
            $course->post_status = 'publish';
            // Something changed, so we need to update the database.
            $courseupdated = 1;
          }

          // That's it for core details, so let's update the post if we need to.
          // After this we're updating the taxonomies & meta which happens with 
          // separate functions.
          if($courseupdated) {
            wp_update_post($course);
          }


          $fcurl = 'https://learningcurator.gww.gov.bc.ca/p/' . $feedcourse->slug;
          if($fcurl != $course->course_link) {
              update_post_meta( $course->ID, 'course_link', $fcurl );
          }


          // Get the keywords for this course from the feed.
          $feedkeys = explode(',', $feedcourse->keywords);
          // Load up the categories currently associated with the course.
          $coursekeys = get_the_terms($course->ID,'keywords');
          if(!empty($feedkeys)) {
            // Update the course with the feed topics.
            // Testing if there are new terms and only add new ones. 
            // Passing an array of new terms rather than having a new 
            // wp_set_object_terms for each one. So, let's run through
            // the feed terms, compare with the existing terms and create a new 
            // array of only new terms, then run wp_set_object_terms with that.
            //
            // Create an index of the existing ones to 
            // match against.
            $ckindex = [];
            if(!empty($coursekeys)) {
              foreach($coursekeys as $ck) {
                array_push($ckindex,trim($ck->name));
              }
            }
            // echo '<pre>'; print_r($ctindex); exit;
            // Store any new cats in here
            $newkeys = [];
            // Run through each cat in the feed and check it
            foreach($feedkeys as $fk) {
              // Does this term NOT exist in the existing cats?
              if(!in_array($fk,$ckindex)) {
                // Add it to the array
                array_push($newkeys,$fk);
              }
            }
            
            // If the newcats array isn't empty, run wp_set_object_terms against
            // the new terms all in one go
            if(!empty($newkeys)) {
              wp_set_object_terms( $course->ID, $feedkeys, 'keywords', false);
            }

            // But now we also need to account for keywords that have been 
            // removed, so we quickly create an index of the existing ones to 
            // match against.
            $ckindex = [];
            foreach($coursekeys as $kc) {
              array_push($ckindex,$kc->name);
            }
            // Loop through each of the existing keywords so as to remove terms 
            // which don't exist in the terms in the feed
            foreach($coursekeys as $ck) {
                if(!in_array($ck->name, $feedkeys)) {
                    // The name of this course key isn't in the feed keys
                    // Delete the old keyword!
                    wp_remove_object_terms( $course->ID, $ck->name, 'keywords' );
                }
            }
          }

          #TODO update topics and maybe keywords too?
          $coursetop = get_the_terms($course->ID,'topics');
          if($coursetop[0]->name != $feedcourse->topic->name) {
            $tname = $coursetop[0]->name;
            if($feedcourse->topic->name == 'House of Indigenous Learning') {
              $tname = 'Indigenous Learning';
            }
            wp_set_object_terms( $course->ID, sanitize_text_field($tname), 'topics', false);
          }

          // Coming into the home stretch updating the partner and delivery method.
          $coursepartner = get_the_terms($course->ID,'learning_partner');
          // There's only ever one partner #TODO support multiple partners?
          if($coursepartner[0]->name != 'Learning Centre') {
              wp_set_object_terms( $course->ID, 'Learning Centre', 'learning_partner', false);
          }


      } else { // Does the course title match a title that's in the feed?

          // This course is not in the feed anymore.
          // Make it PRIVATE.
          $course->post_status = 'private';
          wp_update_post( $course );

      }
  }

  // Next, let's loop through the feed again, this time looking at the newly created
  // $courseindex array with just the published course names in it for easy lookup
  //
  // If the course doesn't exist within the catalog yet, then we create it!
  //
  foreach($feed->pathways as $feedcourse) {

      if(!in_array($feedcourse->id, $courseindex) && !empty($feedcourse->id)) {

          // This course isn't in the list of published courses
          // so it is new, so we need to create this course from scratch.
          // Set up the new course with basic settings in place
          $fcurl = 'https://learningcurator.gww.gov.bc.ca/p/' . $feedcourse->slug;
          $new_course = array(
              'post_title' => trim($feedcourse->name),
              'post_type' => 'course',
              'post_status' => 'publish', 
              'post_content' => sanitize_text_field($feedcourse->objective),
              'post_excerpt' => substr(sanitize_text_field($feedcourse->objective), 0, 100),
              'meta_input'   => array(
                  'course_link' => esc_url_raw($fcurl),
                  'pathway_id' => $feedcourse->id
              )
          );
          // Actually create the new post so that we can move on 
          // to updating it with taxonomy etc
          $post_id = wp_insert_post( $new_course );

          wp_set_object_terms( $post_id, 'Curated Pathway', 'delivery_method', false);
          // wp_set_object_terms( $post_id, sanitize_text_field($feedcourse->_learning_partner), 'learning_partner', false);
          wp_set_object_terms( $post_id, sanitize_text_field($feedcourse->topic->name), 'topics', false);
          wp_set_object_terms( $post_id, 'Complementary', 'groups', false);
          wp_set_object_terms( $post_id, 'Learning Centre', 'learning_partner', false);
          wp_set_object_terms( $post_id, 'PSA Learning Curator', 'external_system', false);
          if(!empty($feedcourse->keywords)) {
            $keywords = explode(',', $feedcourse->keywords);
            wp_set_object_terms( $post_id, $keywords, 'keywords', true);
          }


      } 
      // otherwise, we've already dealt with things in the previous loop 
      // so do nothing else
  }
  
  header('Location: edit.php?noheader=true&post_type=course&page=expired_courses');
}


/**
 * Look through published courses not in the PSALS and check the expiry date
 * and make private if it's past today.
 * 
 */
function expired_courses () {

  if ( !current_user_can( 'edit_posts' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  // Start by getting all the published courses that are NOT listed as being in the 
  // PSA Learning Curator, or the PSA Learning System.
  //
  $courses = get_posts(array(
      'post_type' => 'course',
      'numberposts' => -1,
      'post_status'    => 'published',
      'tax_query' => array(
          array(
          'taxonomy' => 'external_system',
          'field' => 'slug',
          'terms' => ['psa-learning-system','psa-learning-curator'],
          'operator' => 'NOT IN'
          )
      ))
    );
    $today = date('Y-m-d');
    foreach ($courses as $course) {

      // Does the course have a expiration date set?
      $cuskeys = get_post_custom_keys( $course->ID );
      if(is_array($cuskeys)) {
        if( in_array( 'course_expire', $cuskeys ) ) {

          if($today > $course->course_expire) {
            
            $course->post_status = 'private';
            wp_update_post( $course );
          }
        }
      }
    }
    header('Location: /learninghub/wp-admin/edit.php?post_type=course');
}


/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'courses_meta_boxes_setup' );
add_action( 'load-post-new.php', 'courses_meta_boxes_setup' );

/* Meta box setup function. */
function courses_meta_boxes_setup() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'courses_add_post_meta_boxes' );
    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'course_save_course_link_meta', 10, 2 );
    add_action( 'save_post', 'course_save_course_expire_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function courses_add_post_meta_boxes() {

    add_meta_box(
        'course-link',      // Unique ID
        esc_html__( 'Course Link', 'course-link' ),    // Title
        'course_link_meta_box',   // Callback function
        'course',         // Admin page (or post type)
        'side',         // Context
        'default'         // Priority
    );
    add_meta_box(
        'course-expire',      // Unique ID
        esc_html__( 'Course Expiration', 'course-expire' ),    // Title
        'course_expire_meta_box',   // Callback function
        'course',         // Admin page (or post type)
        'side',         // Context
        'high'         // Priority
    );
}

/* Display the post meta box. */
function course_link_meta_box( $post ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'course_link_nonce' ); ?>
    <div>
        <label for="course-link">
        <?php _e( "A hyperlink to the session registration page for this course.", 'course-link' ); ?></label>
        <br />
        <input class="widefat" 
                type="text" 
                name="course-link" 
                id="course-link" 
                value="<?php echo esc_attr( get_post_meta( $post->ID, 'course_link', true ) ); ?>" 
                size="30" />
    </div>
<?php }
/* Display the post meta box. */
function course_expire_meta_box( $post ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'course_expire_nonce' ); ?>
    <div>
        <label for="course-expire">
        <?php _e( "The date after which this course should be removed from public view. ") ?>
        <?php _e("Only courses not being sync'ed pay attention to this. <br>(e.g., Curator and PSALS)", 'course-expire' ); ?>
        </label>
        <br />
        <input class="widefat" 
                type="date" 
                name="course-expire" 
                id="course-expire" 
                value="<?php echo esc_attr( get_post_meta( $post->ID, 'course_expire', true ) ); ?>" 
                size="30" />
    </div>
<?php }

/* Save a meta box’s post metadata. */
function course_save_course_link_meta ( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['course_link_nonce'] ) || !wp_verify_nonce( $_POST['course_link_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

    /* Get the posted data */
    $new_meta_value = ( isset( $_POST['course-link'] ) ? $_POST['course-link'] : ’ );

    /* Get the meta key. */
    $meta_key = 'course_link';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && !$meta_value ) {
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    /* If the new meta value does not match the old value, update it. */
    } elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
        update_post_meta( $post_id, $meta_key, $new_meta_value );
    /* If there is no new meta value but an old value exists, delete it. */
    } elseif ( !$new_meta_value && $meta_value ) {
        delete_post_meta( $post_id, $meta_key, $meta_value );
    }
}
/* Save a meta box’s post metadata. */
function course_save_course_expire_meta ( $post_id, $post ) {

  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['course_expire_nonce'] ) || !wp_verify_nonce( $_POST['course_expire_nonce'], basename( __FILE__ ) ) ) {
      return $post_id;
  }
  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
  return $post_id;

  /* Get the posted data */
  $new_meta_value = ( isset( $_POST['course-expire'] ) ? $_POST['course-expire'] : ’ );

  /* Get the meta key. */
  $meta_key = 'course_expire';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta( $post_id, $meta_key, true );

  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && !$meta_value ) {
      add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  /* If the new meta value does not match the old value, update it. */
  } elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
      update_post_meta( $post_id, $meta_key, $new_meta_value );
  /* If there is no new meta value but an old value exists, delete it. */
  } elseif ( !$new_meta_value && $meta_value ) {
      delete_post_meta( $post_id, $meta_key, $meta_value );
  }
}







/**
 * Plugin class
 **/
if ( ! class_exists( 'CT_TAX_META' ) ) {

    class CT_TAX_META {
    
      public function __construct() {
        //
      }
    
     /*
      * Initialize the class and start calling our hooks and filters
      * @since 1.0.0
     */
     public function init() {
       add_action( 'learning_partner_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
       add_action( 'created_learning_partner', array ( $this, 'save_category_image' ), 10, 2 );
       add_action( 'learning_partner_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
       add_action( 'edited_learning_partner', array ( $this, 'updated_category_image' ), 10, 2 );
       add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
       add_action( 'admin_footer', array ( $this, 'add_script' ) );
     }
    
    public function load_media() {
     wp_enqueue_media();
    }
    
     /*
      * Add a form field in the new category page
      * @since 1.0.0
     */
     public function add_category_image ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="category-image-id"><?php _e('Partner Logo', 'twentytwentyone-learning-hub-theme'); ?></label>
         <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
         <div id="category-image-wrapper"></div>
         <p>
           <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
           <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
        </p>
        </div>
        <div class="form-field term-group">
          <label for="partner-url">Partner URL</label>
           <input type="text" id="partner-url" name="partner-url" class="" value="">
        </div>
        <div class="form-field term-group">
          <label for="partner-contact">Partner Contact</label>
           <input type="text" id="partner-contact" name="partner-contact" class="" value="">
        </div>
     <?php
     }
    
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
         $image = $_POST['category-image-id'];
         add_term_meta( $term_id, 'category-image-id', $image, true );
       }
       if( isset( $_POST['partner-url'] ) && '' !== $_POST['partner-url'] ){
        $url = $_POST['partner-url'];
        add_term_meta( $term_id, 'partner-url', $url, true );
      }
       if( isset( $_POST['partner-contact'] ) && '' !== $_POST['partner-contact'] ){
        $url = $_POST['partner-contact'];
        add_term_meta( $term_id, 'partner-contact', $url, true );
      }
     }
    
     /*
      * Edit the form field
      * @since 1.0.0
     */
     public function update_category_image ( $term, $taxonomy ) { ?>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for="category-image-id"><?php _e('Partner Logo', 'twentytwentyone-learning-hub-theme'); ?></label>
         </th>
         <td>
           <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
           <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
           <div id="category-image-wrapper">
             <?php if ( $image_id ) { ?>
               <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
             <?php } ?>
           </div>
           <p>
             <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
             <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
           </p>

         </td>
       </tr>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for="category-image-id"><?php _e('Partner URL', 'twentytwentyone-learning-hub-theme'); ?></label>
         </th>
         <td>
         <div class="form-field term-group">
              <?php $url = get_term_meta ( $term -> term_id, 'partner-url', true ); ?>
              <input type="text" id="partner-url" name="partner-url" class="" value="<?= $url ?>">
            </div>
        </td>
        </tr>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for=""><?php _e('Partner Contact', 'twentytwentyone-learning-hub-theme'); ?></label>
         </th>
         <td>
         <div class="form-field term-group">
              <?php $pcontactinfo = get_term_meta ( $term -> term_id, 'partner-contact', true ); ?>
              <input type="text" id="partner-contact" name="partner-contact" class="" value="<?= $pcontactinfo ?>">
            </div>
        </td>
        </tr>
     <?php
     }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
         $image = $_POST['category-image-id'];
         update_term_meta ( $term_id, 'category-image-id', $image );
       } else {
         update_term_meta ( $term_id, 'category-image-id', '' );
       }
       if( isset( $_POST['partner-url'] ) && '' !== $_POST['partner-url'] ){
        $url = $_POST['partner-url'];
        update_term_meta ( $term_id, 'partner-url', $url );
      } else {
        update_term_meta ( $term_id, 'partner-url', '' );
      }
       if( isset( $_POST['partner-contact'] ) && '' !== $_POST['partner-contact'] ){
        $pcinfo = $_POST['partner-contact'];
        update_term_meta ( $term_id, 'partner-contact', $pcinfo );
      } else {
        update_term_meta ( $term_id, 'partner-contact', '' );
      }
     }
    
    /*
     * Add script
     * @since 1.0.0
     */
     public function add_script() { ?>
       <script>
         jQuery(document).ready( function($) {
           function ct_media_upload(button_class) {
             var _custom_media = true,
             _orig_send_attachment = wp.media.editor.send.attachment;
             $('body').on('click', button_class, function(e) {
               var button_id = '#'+$(this).attr('id');
               var send_attachment_bkp = wp.media.editor.send.attachment;
               var button = $(button_id);
               _custom_media = true;
               wp.media.editor.send.attachment = function(props, attachment){
                 if ( _custom_media ) {
                   $('#category-image-id').val(attachment.id);
                   $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                   $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                 } else {
                   return _orig_send_attachment.apply( button_id, [props, attachment] );
                 }
                }
             wp.media.editor.open(button);
             return false;
           });
         }
         ct_media_upload('.ct_tax_media_button.button'); 
         $('body').on('click','.ct_tax_media_remove',function(){
           $('#category-image-id').val('');
           $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
         });
         // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
         $(document).ajaxComplete(function(event, xhr, settings) {
           var queryStringArr = settings.data.split('&');
           if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
             var xml = xhr.responseXML;
             $response = $(xml).find('term_id').text();
             if($response!=""){
               // Clear the thumb image
               $('#category-image-wrapper').html('');
             }
           }
         });
       });
     </script>
     <?php }
    
      }
    
    $CT_TAX_META = new CT_TAX_META();
    $CT_TAX_META -> init();
    
    }
