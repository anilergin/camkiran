<?php
global $wp_registered_sidebars;
$footer = &G5Plus_Global::get_footer_var();
$footer_matrix = array(
	'footer-1' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-2' => array('col-md-6 col-sm-12', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-3' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-6 col-sm-12'),
	'footer-4' => array('col-md-6 col-sm-12', 'col-md-6 col-sm-12'),
	'footer-5' => array('col-md-4 col-sm-12', 'col-md-4 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-6' => array('col-md-8 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-7' => array('col-md-4 col-sm-12', 'col-md-8 col-sm-12'),
	'footer-8' => array('col-md-3 col-sm-12', 'col-md-6 col-sm-12', 'col-md-3 col-sm-12'),
	'footer-9' => array('col-sm-12'),
);
$footer_sidebar = array();
$sidebar_count = 0;
for ($i = 0; $i < count($footer_matrix[$footer['footer_layout']]); $i++) {
	$footer_sidebar[$i] = $footer['footer_sidebar_' . ($i + 1)];
	if (is_active_sidebar($footer_sidebar[$i])) {
        $sidebar_count++;
    }
}
$footer_class = array('main-footer');

if ($footer['footer_border_top'] !== 'none') {
	$footer_class[] = esc_attr($footer['footer_border_top']);
}

?>
<?php if ($footer['footer_show_hide'] && $sidebar_count > 0): ?>
	<div class="<?php echo join(' ', $footer_class); ?>">
		<div class="<?php echo esc_attr($footer['footer_container_layout']); ?>">
			<div class="footer-inner">
				<div class="row">
					<?php for ($i = 0; $i < count($footer_sidebar); $i++): ?>
						<div class="sidebar <?php echo esc_attr($footer_matrix[$footer['footer_layout']][$i]); ?>">
							<?php if(is_active_sidebar($footer_sidebar[$i])): ?>
								<?php dynamic_sidebar($footer_sidebar[$i]); ?>
							<?php elseif (isset($wp_registered_sidebars[$footer_sidebar[$i]]['name'])): ?>
								<div class="no-widget-content"> <?php printf(wp_kses_post(__('Please insert widget into sidebar <b>%s</b> in Appearance > <a class="text-color-accent" title="manage widgets" href="%s">Widgets</a> ','g5plus-orson')),$wp_registered_sidebars[$footer_sidebar[$i]]['name'],admin_url( 'widgets.php' )); ?></div>
							<?php endif; ?>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>
<?php g5plus_get_template('footer/bottom-bar'); ?>