-------------user data to user table(form direct recive table)---------------
<?php
if(isset($_POST['submit'])){
 $firstname = $_POST['firstname'];
 $lastname = $_POST['lastname'];
 $mobilenumber = $_POST['mobilenumber'];
 $emailaddress = $_POST['emailaddress'];
 $password = $_POST['password'];

$userdata = array(
    'user_login' =>  $emailaddress,
    'user_pass'  =>  md5($password) // no plain password here!
); 
echo $user_id = wp_insert_user( $userdata ) ;}
?> 
---------------show all feature image post table(function.php) ------------------
add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}

------------------------menu call-------------------------
<div id="topNav" style="padding-right: 116px;"><nav class="main-nav">
		
		<?php
		wp_nav_menu( array(
    'theme_location' => 'primary',
	'menu'=>'header',
    'container' => false,
    'menu_class'=> 'mainmenu pull-left',
    'items_wrap' => '<ul class="navigation-mobileNav">%3$s</ul>',
));
		?>
	 
</nav>
---------------Mobile menu call------------------------
<nav id="mobile-navigation">
   
  <?php
		wp_nav_menu( array(
    'theme_location' => 'primary',
	'menu'=>'header',
    'container' => false,
    'menu_class'=> 'mainmenu pull-left',
    'items_wrap' => '<ul class="navigation-mobileNav">%3$s</ul>',
));
		?>
</nav>

--------------------template call------------------------
 <div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

-------------------Categories wise template call------------------------
<?php query_posts(array('posts_per_page' => -1, 'post_type' => 'drawing_gallery'));
while (have_posts()) { the_post();
$feat_img1=wp_get_attachment_url( (get_post_thumbnail_id($post->ID)) ); ?>

-----------------------------feature image size---------------------
img.attachment-list-block.size-list-block.wp-post-image.no-display.appear {
    width: 500px;
}

-------------------one template call many page-----------------------
<?php
/**
 * template name: Custom Gallery
 */

get_header(); 
 $cat_slug =  get_post_meta( get_the_ID() , 'gallery_category' , true);
?>
 <?php query_posts(array(
			  'posts_per_page' => -1,
			  'post_type' => 'gallery'  ,
			  'tax_query' => array(
				array(
					'taxonomy' => 'gallery_cat',
					'field'    => 'slug',
					'terms'    => $cat_slug
				)
			  )));
while (have_posts()) { the_post();
$feat_img1=wp_get_attachment_url( (get_post_thumbnail_id($post->ID)) ); ?>

-----------------------------
