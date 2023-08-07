<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package nadobranich
 */

get_header();
?>

<main class="nf-page-main">
	<div class="nf-page-text">
		<h1 class="nf-page-title">Йой, помилка 404</h1>
		<p class="nf-page-desc">Скоріш за все, сторінка, яку ви шукаєте не існує, або вона була видалена :(</p>
	</div>

	<div class="nf-page-wrap">
		<div class="nf-page-search">
			<?php echo do_shortcode('[fibosearch]'); ?>
		</div>

		<div class="nf-to-home">
			<a class="nf-to-home__link" href="<?php echo site_url('') ?>">На головну</a>
		</div>
	</div>

	<?php echo do_shortcode('[recently_viewed_products]') ?>

</main>

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
	<?php echo do_shortcode('[modalAuth_markup]') ?>
	<?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php echo do_shortcode('[modalToCart_markup]') ?>

<?php
get_footer();