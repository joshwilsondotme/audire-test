<?php
/**
 * Head section for meta data
 */
  $ga_universal = get_field( 'google_analytics_universal_analytics', 'themes-options');
  $g4_analytics = get_field( 'g4_analytics',  'themes-options' );
  $gtm_id = get_field( 'gtm_id',  'themes-options' );
  $custom_scripts_head = get_field( 'custom_scripts_head',  'themes-options' );
?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, user-scalable=1">

<link rel="dns-prefetch" href="https://ajax.googleapis.com" />
<link rel="preconnect" href="https://ajax.googleapis.com" />

<?php if( !empty($ga_universal) ) : ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ga_universal; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?= $ga_universal; ?>');
  </script>
<?php endif; ?>

<?php if( !empty($g4_analytics) ) : ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $g4_analytics; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?= $g4_analytics; ?>');
  </script>
<?php endif; ?>

<?php if( !empty($gtm_id) ) : ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','<?= $gtm_id; ?>');</script>
  <!-- End Google Tag Manager -->
<?php endif; ?>

<?php if(isset($custom_scripts_head)) : ?>
  <?= $custom_scripts_head; ?>
<?php endif; ?>