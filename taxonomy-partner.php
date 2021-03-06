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
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_args = array(
    'post_type'                => 'course',
    'post_status'              => 'publish',
    'posts_per_page'           => 500,
    'paged'                    => $paged, 
    'ignore_sticky_posts'      => 0,
    'tax_query' => array(
        array (
            'taxonomy' => 'learning_partner',
            'field' => 'slug',
            'terms' => $term,
        )
    ),
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

$partnerurl = '';
$partnerlogo = '';
$term_vals = get_term_meta($term->term_id);
foreach($term_vals as $key=>$val){
    //echo $val[0] . '<br>';
    if($key == 'partner-url') {
        $partnerurl = $val[0];
    }
    if($key == 'category-image-id') {
        $partnerlogo = $val[0];
    }
    
} 


?>

<?php if( $post_my_query->have_posts() ) : ?>
	
<div class="white-wrap">
<div class="wp-block-columns alignwide" id="partnertop">
<div class="wp-block-column" style="flex-basis:33.33%">
	<?php if(!empty($partnerlogo)): ?>
    <?php $image_attributes = wp_get_attachment_image_src( $attachment_id = $partnerlogo, $size = 'large' ) ?>
    <?php if ( $image_attributes ) : ?>
    <div style="margin-top: 2em; text-align:center;">
    <img src="<?php echo $image_attributes[0]; ?>" 
            width="<?php echo $image_attributes[1]; ?>" 
            height="<?php echo $image_attributes[2]; ?>">
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
<div class="wp-block-column">
	<div><a class="allpartnerslink" href="/learninghub/corporate-learning-partners/">All Partners</a></div>
	<h1><?php echo $term->name ?></h1>
		<?php //the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<div class=""><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
		<?php if(!empty($partnerurl)): ?>
    <div>
        <a class="partner-url" 
            target="_blank" 
            rel="noopener" 
            href="<?= $partnerurl ?>">
                View Partner Website
        </a>
    </div>
    <?php endif ?>

</div>
</div>
</div>


<?php 
// Get a list of all sub-categories and output them as simple links
$catlist = get_categories(
						array(
							'taxonomy' => 'course_category',
							'child_of' => $term->term_id,
							'orderby' => 'id',
							'order' => 'DESC',
							'hide_empty' => '0'
						));

foreach($catlist as $childcat) {
	echo '<a href="/learninghub/course_category/'. $childcat->slug . '">' . $childcat->name . '</a> | ';
}

//print_r($catlist);
?>
</div>
<div class="entry-content">
    <div id="courselist">
    <div class="searchbox">
    <input class="search form-control mb-3" placeholder="Type to filter courses">
	</div>
	<div class="list">
	<?php while ($post_my_query->have_posts()) : $post_my_query->the_post(); ?>
		
		<?php get_template_part( 'template-parts/course/single-course' ) ?>
	<?php endwhile; ?>
</div>
</div>
</div>
<div style="clear: both">
	<?php twenty_twenty_one_the_posts_navigation(); ?>
</div>
<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script>

var courseoptions = {
    valueNames: [ 'coursename', 'coursedesc', 'coursecats', 'coursekeys' ]
};
var courses = new List('courselist', courseoptions);


</script>
<?php get_footer(); ?>
