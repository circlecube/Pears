	
	<nav id="nav" class="group">
	<a href="#" id="nav-toggle">hide</a>
		<?php
/*****************************************************************
*
* alchymyth 2011
* a hierarchical list of all categories, with linked post titles
*
******************************************************************/
// http://codex.wordpress.org/Function_Reference/get_categories
 
 foreach( get_categories('hide_empty=1','order_by=name') as $cat ) :
 if( !$cat->parent ) {
 echo '<h2><a href="#">' . $cat->name . '</a></h2><ul>';
 process_cat_tree( $cat->term_id );
 }
 endforeach;
 
 wp_reset_query(); //to reset all trouble done to the original query
//
function process_cat_tree( $cat ) {
 
 $args = array('category__in' => array( $cat ), 'numberposts' => -1, 'orderby' => title, 'order' => ASC);
 $cat_posts = get_posts( $args );
 
 if( $cat_posts ) :
 foreach( $cat_posts as $post ) :
 echo '<li>';
 echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
 echo '</li>';
 endforeach;
 endif;
 
 $next = get_categories('hide_empty=0&parent=' . $cat);
 
 if( $next ) :
 foreach( $next as $cat ) :
 echo '<ul><li><strong>' . $cat->name . '</strong></li>';
 process_cat_tree( $cat->term_id );
 endforeach;
 endif;
 
 echo '</ul>';
}
?>

<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

			<li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li>

			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>

	</nav>
