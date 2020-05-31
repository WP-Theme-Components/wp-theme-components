<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div>
		<h2 class="heading-size-3 entry-title"><?php the_title(); ?></h2>
	</div>

	<div class="post-inner">
		<?php the_content(); ?>
	</div>

	<div class="">
		<p>
			<?php
			echo do_shortcode( '[purchase_link]' );
			$repo = get_field( 'git_repo' );
			if ( ! empty( $repo ) ) {
				printf(
					'<a href="https://github.com/%1$s" class="edd-github">GitHub</a>',
					esc_attr( $repo )
				);
			}
			?>
		</p>
	</div>

</article><!-- .post -->
