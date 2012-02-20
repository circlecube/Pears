<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<style id="s" type="text/css">
<?php $key="css"; echo get_post_meta($post->ID, $key, true); ?>
</style>


		<?php if($post->post_content != "") {?>
		<div id="pattern-notes" class="mod">
			<h3 class="label">Notes</h3>
			<?php the_content(); ?>
		</div>
		<?php } ?>


<div id="pattern" class="mod group">
			<h3 class="label"><?php the_title(); ?></h3> 
			<h4><?php edit_post_link('Edit ' .  get_the_title(), '<span class="edit-link">', '</span>'); ?></h4>			
			<div id="pattern-wrap" class="group">
<?php $key="html"; echo get_post_meta($post->ID, $key, true); ?>
			</div>
		</div>
		
		<div class="group">
			
<?php if( get_post_meta($post->ID, "less", true) != ""){?>
			<div id="prestyle" class="mod">
				<h3 class="label">LESS</h3>
				<a href="#" class="clip" title="select code for copying"><img src="/wp-content/themes/pears/images/icon-copy.png" alt="copy" /></a>
				<textarea id="less-code" class="mod-ta">
<?php $key="less"; echo get_post_meta($post->ID, $key, true); ?>
				</textarea>
			</div>
	<?php if( get_post_meta($post->ID, "css", true) != ""){?>
			<div id="style" class="mod">
				<h3 class="label">CSS</h3>
				<a href="#" class="clip" title="select code for copying"><img src="/wp-content/themes/pears/images/icon-copy.png" alt="copy" /></a>
				<textarea id="css-code" class="mod-ta"></textarea>
			</div>
		</div>
	<?php } ?>
<?php } ?>

<?php if( get_post_meta($post->ID, "html", true) != ""){?>
		<div id="markup" class="mod">
				<h3 class="label">HTML</h3>
				<a href="#" class="clip" title="select code for copying"><img src="/wp-content/themes/pears/images/icon-copy.png" alt="copy" /></a>
				<textarea id="html-code" class="mod-ta">
<?php $key="html"; echo get_post_meta($post->ID, $key, true); ?>			
				</textarea>
			</div>
<?php } ?>
				


<?php endwhile; // end of the loop. ?>