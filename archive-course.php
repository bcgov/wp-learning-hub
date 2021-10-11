<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_args=array(
    'post_type'                => 'course',
    'post_status'              => 'publish',
    'posts_per_page'           => 300,
    'paged'                    => $paged, 
    'ignore_sticky_posts'      => 0,
    'child_of'                 => 0,
    'parent'                   => 0,
    'orderby'                  => 'name', 
    'order'                    => 'ASC',
    'hide_empty'               => 0,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'pad_counts'               => true, 
);
$post_my_query = null;
$post_my_query = new WP_Query($post_args);
$categories = get_terms( 
    'course_category', 
    array('parent' => 0)
);
?>




    <div class="alphabet">
        <a href="#A">A</a>
        <a href="#B">B</a>
        <a href="#C">C</a>
        <a href="#D">D</a>
        <a href="#E">E</a>
        <a href="#F">F</a>
        <a href="#G">G</a>
        <a href="#H">H</a>
        <a href="#I">I</a>
        <a href="#J">J</a>
        <a href="#K">K</a>
        <a href="#L">L</a>
        <a href="#M">M</a>
        <a href="#N">N</a>
        <a href="#O">O</a>
        <a href="#P">P</a>
        <a href="#Q">Q</a>
        <a href="#R">R</a>
        <a href="#S">S</a>
        <a href="#T">T</a>
        <a href="#U">U</a>
        <a href="#V">V</a>
        <a href="#W">W</a>
        <a href="#X">X</a>
        <a href="#Y">Y</a>
        <a href="#Z">Z</a>
    </div> <!-- /.alphabet -->




<div class="entry-content" id="courselist">
<div class="searchbox">

<div style="text-align: center; margin-bottom: 1em;">
    <a href="https://lc.virtuallearn.ca/portal/foundational-courses/">Foundational Courses</a> | 
    <a href="https://lc.virtuallearn.ca/portal/supervisors-and-managers/">Supervisors and Managers</a> | 
    <a href="https://lc.virtuallearn.ca/portal/leadership/">Leadership</a>
</div>

<input class="search form-control mb-3" placeholder="Type to filter courses below">


</div>
<?php if( $post_my_query->have_posts() ) : ?>

<div class="entry-content">
<div class="list">
<?php
$lastletter = '';
while ($post_my_query->have_posts()) : $post_my_query->the_post(); 

$title = get_the_title();
$firstletter = substr($title, 0, 1);
$secondletter = substr($title, 0, 2);

if($firstletter != '{' && $firstletter != '(') {            
    if($firstletter != $lastletter) {
        // not sure what to do here as list.js is counting these headers as courses :(
            // As it turns out, this is more important than a counter update, so we're
            // implementing it and removing the live count update onfilter
        echo '<h2 id="' . $firstletter . '">' . $firstletter . '</h2>';
    }
}

get_template_part( 'template-parts/course/single-course' );

$lastletter = $firstletter;

endwhile;
?>
</div>
</div>
</div>
<?php
else :      
    echo '<p>No Courses Found!</p>';   
endif;
wp_reset_query($post_my_query);

?>



<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script>

var courseoptions = {
    valueNames: [ 'coursename', 'coursedesc', 'coursecats', 'coursekeys' ]
};
var courses = new List('courselist', courseoptions);
// document.getElementById('coursecount').innerHTML = courses.update().matchingItems.length;
// courses.on('searchComplete', function(){
//     //console.log(upcomingClasses.update().matchingItems.length);
//     //console.log(courses.update().matchingItems.length);
//     document.getElementById('coursecount').innerHTML = courses.update().matchingItems.length;
// });

</script>
<?php get_footer(); ?>