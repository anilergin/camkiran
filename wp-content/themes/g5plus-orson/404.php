<?php
get_header();
$background_image_404 = G5Plus_Global::get_option('background_image_404');
$custom_style = '';
if (isset($background_image_404['url']) && $background_image_404['url']) {
	$custom_style = 'style="background-image: url(' . esc_url($background_image_404['url']) . ')"';
}
?>
<div class="page404">
	<div class="bg-404" <?php echo wp_kses_post($custom_style); ?>></div>
    <div class="container">
        <div class=" content-wrap">
            <h2 class="title"><?php esc_html_e('404 PAGE','g5plus-orson'); ?></h2>
            <h4  class="subtitle"><?php esc_html_e('The page you are looking for does not exist.','g5plus-orson'); ?></h4>
            <div class="return">
				<p class="description"><?php esc_html_e('Return to the','g5plus-orson'); ?> <a href="<?php echo esc_url(home_url('/')) ?>"><?php esc_html_e('home page','g5plus-orson'); ?> </a></p>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();