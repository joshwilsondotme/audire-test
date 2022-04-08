<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
  if ( have_rows ( 'header_options', 'themes-options' ) ) :
    while ( have_rows ( 'header_options', 'themes-options' ) ) : the_row(); 
      $navStyle = get_sub_field( 'navigation_style' );
    endwhile;
  endif;

  $gtm_id = get_field( 'gtm_id',  'themes-options' );
?>
<!DOCTYPE html><html <?php language_attributes(); ?> class="no-js">
<head>
  <?php
    get_template_part( 'template-parts/header/head/head' );
    wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <?php if ( !empty($gtm_id) ) : ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $gtm_id; ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  <?php endif; ?>

  <div class="site-wrapper">

    <a class="skip-link sr-only" href="#content">Skip to Content</a>

    <?php
      if ( $navStyle == 'default' ) {
        get_template_part('template-parts/header/header-default');
      } else {
        get_template_part('template-parts/header/header-stacked');
      }
    ?>

    <main id="content" class="site-content" role="main">
