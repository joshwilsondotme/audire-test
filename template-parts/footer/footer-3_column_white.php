<?php
/**
 * Display footer content
 */


$footer_name = wp_get_nav_menu_name( 'footer_nav' );

if ( have_rows( 'branding', 'themes-options' ) ) : 
	while ( have_rows ( 'branding', 'themes-options' ) ) : the_row();
		$logo = get_sub_field( 'logo' );
		$alt_logo = get_sub_field( 'alt_logo' );
	endwhile;
endif;

if ( have_rows( 'footer_options', 'themes-options' ) ) :
	while ( have_rows( 'footer_options', 'themes-options' ) ) : the_row();
        $logo_width = get_sub_field( 'logo_width' );
		$use_alt_logo = get_sub_field( 'use_alt_logo' );
		$below_logo = get_sub_field( 'below_logo' );
		$right_side = get_sub_field( 'right_side' );

		if ( have_rows( '3_column_options' ) ) : 
			while ( have_rows( '3_column_options' ) ) : the_row();

			if ( have_rows( 'border_color' ) ) : 
				while ( have_rows( 'border_color' ) ) : the_row();
					$border_color = get_sub_field( 'color_options' );
				endwhile;
			endif;

				if ( have_rows( 'main_section_settings' ) ) : 
					while ( have_rows( 'main_section_settings' ) ) : the_row();
						$main_section_bg = get_sub_field( 'color_options' );
						$main_section_text = get_sub_field( 'white_text' );	
					endwhile;
				endif;

				if ( have_rows( 'meta_section_settings' ) ) : 
					while ( have_rows( 'meta_section_settings' ) ) : the_row();
						$meta_section_bg = get_sub_field( 'color_options' );
						$meta_section_text = get_sub_field( 'white_text' );
					endwhile;
				endif;
			endwhile;
		endif;

		
	endwhile;
endif;

	// var_dump($alt_logo);
?>
<footer class="site-footer site-footer--3_column bg-<?= $main_section_bg; ?>"  role="contentinfo" style="border-top: 5px solid var(--color-<?= $border_color; ?>);">
	<div class="site-footer__main padding-y-lg <?= ($main_section_text == true) ? 'text-white' : '' ?>">
		<div class="container max-width-lg ">
			<div class="grid grid-gap-lg justify-between">

				<div class="<?php echo ( !empty($logo_width) ) ? "col-3@md" : "col-2@md"; ?> col-12 text-center">
					<?php if ($use_alt_logo == true) : ?>
						<img class="site-footer__logo site-footer__logo--white" src="<?php echo esc_url($alt_logo['url']) ;?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" style="width: <?= $logo_width; ?>;" />
						
					<?php else: ?>
						<img class="site-footer__logo" src="<?php echo esc_url($logo['url']) ;?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" style="width: <?= $logo_width; ?>;" />
					<?php endif; ?>

					<?= $below_logo; ?>
				</div>

				<div class="col-4@md col-12 text-component">
					<h3 class="text-md text-weight-500"><?= $footer_name; ?></h3>
					<?php bem_menu('footer_nav', 'footer-menu'); ?>
				</div>

				<div class="col-3@md col-12">
					<div class="site-footer__right-side">
						<?= $right_side; ?>
					</div>
					<div class="site-footer__social">
						<ul class="site-footer__social-list social-list flex items-center text-white">
							<?php get_template_part('template-parts/components/social-list--boxed'); ?>
						</ul>
					</div>
				</div>
			</div>

		</div> <!-- container -->
	</div>
	
	<div class="site-footer__meta text-center padding-y-sm bg-<?= $meta_section_bg; ?> <?= ($meta_section_text == true) ? 'text-white' : '' ?>">
		<p class="text-sm">Site Designed by <a href="https://audiologydesign.com" class="site-footer__meta-link" target="_blank" rel="noopener noreferrer">Audiology Design</a> | <?php echo date('Y'); ?> All Rights Reserved</p>
	</div>
</footer>
