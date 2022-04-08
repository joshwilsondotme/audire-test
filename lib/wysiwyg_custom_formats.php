<?php

/*
 * adds custom css styles for wysiwyg editor
 */
function add_custom_wysiwyg_styles() {
  // add_editor_style( 'https://cloud.typography.com/6585932/7825412/css/fonts.css' );
  add_editor_style( 'dist/assets/css/wysiwyg-admin-style.css' );
}
add_action( 'admin_init', 'add_custom_wysiwyg_styles' );


/*
 * adds Formats dropdown to basic and full wysiwyg toolbars
 */
function custom_toolbar($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'custom_toolbar');


/*
 * defines custom format options
 */
function custom_format_styles($config) {
  $temp_array = array(
    array(
      'title' => 'Text Sizes',
      'items' => array(
        array(
          'title' => 'X-Small',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-xs'
        ),
        array(
          'title' => 'Small',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-sm'
        ),
        array(
          'title' => 'Medium',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-md'
        ),
        array(
          'title' => 'Large',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-lg'
        ),
        array(
          'title' => 'X-Large',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-xl'
        ),
        array(
          'title' => 'XX-Large',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-xxl'
        ),
        array(
          'title' => 'XXX-Large',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li',
          'inline' => 'span',
          'classes' => 'text-xxxl'
        ),
      ),
    ),
    array(
      'title' => 'Text Colors',
      'items' => array(
        array(
          'title' => 'Primary',
          'items' => array(
            array(
              'title' => '100',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-100'
            ),
            array(
              'title' => '200',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-200'
            ),
            array(
              'title' => '300',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-300'
            ),
            array(
              'title' => '400',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-400'
            ),
            array(
              'title' => '500',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-500'
            ),
            array(
              'title' => '600',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-600'
            ),
            array(
              'title' => '700',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-700'
            ),
            array(
              'title' => '800',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-800'
            ),
            array(
              'title' => '900',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-primary-900'
            ),
          )
        ),
        array(
          'title' => 'Secondary',
          'items' => array(
            array(
              'title' => '100',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-100'
            ),
            array(
              'title' => '200',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-200'
            ),
            array(
              'title' => '300',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-300'
            ),
            array(
              'title' => '400',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-400'
            ),
            array(
              'title' => '500',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-500'
            ),
            array(
              'title' => '600',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-600'
            ),
            array(
              'title' => '700',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-700'
            ),
            array(
              'title' => '800',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-800'
            ),
            array(
              'title' => '900',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-secondary-900'
            ),
          )
        ),
        array(
          'title' => 'Tertiary',
          'items' => array(
            array(
              'title' => '100',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-100'
            ),
            array(
              'title' => '200',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-200'
            ),
            array(
              'title' => '300',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-300'
            ),
            array(
              'title' => '400',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-400'
            ),
            array(
              'title' => '500',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-500'
            ),
            array(
              'title' => '600',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-600'
            ),
            array(
              'title' => '700',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-700'
            ),
            array(
              'title' => '800',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-800'
            ),
            array(
              'title' => '900',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-tertiary-900'
            ),
          )
        ),
        array(
          'title' => 'Quaternary',
          'items' => array(
            array(
              'title' => '100',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-100'
            ),
            array(
              'title' => '200',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-200'
            ),
            array(
              'title' => '300',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-300'
            ),
            array(
              'title' => '400',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-400'
            ),
            array(
              'title' => '500',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-500'
            ),
            array(
              'title' => '600',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-600'
            ),
            array(
              'title' => '700',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-700'
            ),
            array(
              'title' => '800',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-800'
            ),
            array(
              'title' => '900',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-quaternary-900'
            ),
          )
        ),
        array(
          'title' => 'Neutral',
          'items' => array(
            array(
              'title' => 'White Text',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-white'
            ),
            array(
              'title' => 'Ultra-Light',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-200'
            ),
            array(
              'title' => 'Lighter',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-300'
            ),
            array(
              'title' => 'Light',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-400'
            ),
            array(
              'title' => 'Default',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-500'
            ),
            array(
              'title' => 'Dark',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-600'
            ),
            array(
              'title' => 'Darker',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-700'
            ),
            array(
              'title' => 'Darkest',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-800'
            ),
            array(
              'title' => 'Ultra-Dark',
              'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
              'inline' => 'span',
              'classes' => 'color-neutral-900'
            ),
          )
        ),
      )
    ),
    array(
      'title' => 'Text Weights',
      'items' => array(
        array(
          'title' => 'Light (300)',
          'inline' => 'span',
          'classes' => 'text-weight-300'
          ),
        array(
          'title' => 'Regular (400)',
          'inline' => 'span',
          'classes' => 'text-weight-400'
          ),
        array(
          'title' => 'Medium (500)',
          'inline' => 'span',
          'classes' => 'text-weight-500'
          ),
        array(
          'title' => 'Semi-Bold (600)',
          'inline' => 'span',
          'classes' => 'text-weight-600'
          ),
        )
      ),
    array(
      'title' => 'Text Transform',
      'items' => array(
        array(
          'title' => 'Uppercase',
          'selector' => 'p, h1, h2, h3, h4, h5, h6, li',
          'classes' => 'text-uppercase letter-spacing-1'
          ),
        array(
          'title' => 'Capitalize',
          'selector' => 'p, h1, h2, h3, h4, h5, h6, li',
          'classes' => 'text-capitalize'
          ),
        )
      ),
    array(
      'title' => 'Font Family',
      'items' => array(
        array(
          'title' => 'Body Copy',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
          'classes' => 'font-primary'
          ),
        array(
          'title' => 'Headline',
          'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
          'classes' => 'font-headline'
          ),
        )
      ),
    array(
      'title' => 'Lists',
      'items' => array(
        array(
          'title' => 'Icon Bullets',
          'items' => array(
            array(
              'title' => 'Double Checkmark Icon',
              'selector' => 'ul, ol',
              'classes' => 'icon-list icon-list--check'
              ),
            array(
              'title' => 'Circle Check Icon',
              'selector' => 'ul, ol',
              'classes' => 'icon-list icon-list--circle-check'
              ),
            array(
              'title' => 'Long Arrow Icon',
              'selector' => 'ul, ol',
              'classes' => 'icon-list icon-list--long-arrow'
              ),
            array(
              'title' => 'Soundwave Icon',
              'selector' => 'ul, ol',
              'classes' => 'icon-list icon-list--soundwave'
              ),
            )
          ),
        array(
          'title' => 'Icon Colors',
          'items' => array(
            array(
              'title' => 'Primary icons',
              'selector' => 'ul, ol',
              'classes' => 'icon-list--color-primary'
              ),
            array(
              'title' => 'Secondary icons',
              'selector' => 'ul, ol',
              'classes' => 'icon-list--color-secondary'
              ),
            array(
              'title' => 'Tertiary icons',
              'selector' => 'ul, ol',
              'classes' => 'icon-list--color-tertiary'
              ),
            array(
              'title' => 'Quaternary icons',
              'selector' => 'ul, ol',
              'classes' => 'icon-list--color-quaternary'
              ),
            array(
              'title' => 'White icons',
              'selector' => 'ul, ol',
              'classes' => 'icon-list--color-white'
              ),
            )
          ),
          array(
            'title' => 'Column Layout',
            'items' => array(
              array(
                'title' => '2-column',
                'selector' => 'ul',
                'classes' => 'two-column-flex-list'
              ),
              array(
                'title' => '3-column',
                'selector' => 'ul',
                'classes' => 'three-column-flex-list'
              )
            )
              ),
          array(
            'title' => 'Inline List',
            'items' => array(
              array(
                'title' => 'Inline List',
                'selector' => 'ul',
                'classes' => 'list-inline'
              ),
              array(
                'title' => 'Spacing',
                'items' => array(
                  array(
                    'title' => 'Small',
                    'selector' => 'ul',
                    'classes' => 'list-inline--space-sm'
                  ),
                  array(
                    'title' => 'Medium',
                    'selector' => 'ul',
                    'classes' => 'list-inline--space-md'
                  ),
                  array(
                    'title' => 'Large',
                    'selector' => 'ul',
                    'classes' => 'list-inline--space-lg'
                  ),
                )
              ),
              array(
                'title' => 'Logo List',
                'selector' => 'ul',
                'classes' => 'list-inline__logo-list'
              )
            )
          )
        ),
      ),
    array(
      'title' => 'Buttons',
      'items' => array(
        array(
          'title' => 'Primary Button',
          'items' => array(
            array(
              'title' => 'Solid',
              'selector' => 'a, p',
              'classes' => 'btn btn--primary'
            ),
            array(
              'title' => 'Bordered',
              'selector' => 'a, p',
              'classes' => 'btn btn--primary--bordered'
            ),
            array(
              'title' => 'White',
              'selector' => 'a, p',
              'classes' => 'btn btn--primary--white'
            ),

          ),
        ),
        array(
          'title' => 'Secondary Button',
          'items' => array(
            array(
              'title' => 'Solid',
              'selector' => 'a, p',
              'classes' => 'btn btn--secondary'
            ),
            array(
              'title' => 'Bordered',
              'selector' => 'a, p',
              'classes' => 'btn btn--secondary--bordered'
            ),
            array(
              'title' => 'White',
              'selector' => 'a, p',
              'classes' => 'btn btn--secondary--white'
            ),

          ),
        ),
        array(
          'title' => 'Tertiary Button',
          'items' => array(
            array(
              'title' => 'Solid',
              'selector' => 'a, p',
              'classes' => 'btn btn--tertiary'
            ),
            array(
              'title' => 'Bordered',
              'selector' => 'a, p',
              'classes' => 'btn btn--tertiary--bordered'
            ),
            array(
              'title' => 'White',
              'selector' => 'a, p',
              'classes' => 'btn btn--tertiary--white'
            ),

          ),
        ),
        array(
          'title' => 'Quaternary Button',
          'items' => array(
            array(
              'title' => 'Solid',
              'selector' => 'a, p',
              'classes' => 'btn btn--quaternary'
            ),
            array(
              'title' => 'Bordered',
              'selector' => 'a, p',
              'classes' => 'btn btn--quaternary--bordered'
            ),
            array(
              'title' => 'White',
              'selector' => 'a, p',
              'classes' => 'btn btn--quaternary--white'
            ),

          ),
        ),
        array(
          'title' => 'Link',
          'items' => array(
            array(
              'title' => 'Link Primary Color',
              'selector' => 'a, p',
              'classes' => 'btn--link btn--icon-arrow text-uppercase'
            ),
            array(
              'title' => 'Link Secondary Color',
              'selector' => 'a, p',
              'classes' => 'btn--link btn--link--secondary btn--icon-arrow text-uppercase'
            ),
            array(
              'title' => 'Link Tertiary Color',
              'selector' => 'a, p',
              'classes' => 'btn--link btn--link--tertiary btn--icon-arrow text-uppercase'
            ),
            array(
              'title' => 'Link No Color',
              'selector' => 'a, p',
              'classes' => 'btn--link btn--link--default btn--icon-arrow text-uppercase'
            ),
            array(
              'title' => 'Link White',
              'selector' => 'a, p',
              'classes' => 'btn--link btn--link--white btn--icon-arrow text-uppercase'
            )
          )
          ),
        array(
          'title' => 'Button Icons',
          'items' => array(
            array(
              'title' => 'Arrow icon',
              'selector' => 'a, p',
              'classes' => 'btn--icon-arrow'
              ),
            array(
              'title' => 'External icon',
              'selector' => 'a, p',
              'classes' => 'btn--icon-external'
              ),
            )
          ),
        array(
          'title' => 'Button Sizes',
          'items' => array(
            array(
              'title' => 'Small',
              'selector' => 'a, p',
              'classes' => 'btn--sm'
              ),
            array(
              'title' => 'Medium',
              'selector' => 'a, p',
              'classes' => 'btn--md'
              ),
            array(
              'title' => 'Large',
              'selector' => 'a, p',
              'classes' => 'btn--lg'
              ),
            )
          ),
        )
      ),
      array(
        'title' => 'Quotes',
        'items' => array(
          array(
            'title' => 'Border Quote',
            'items' => array(
              array(
                'title' => 'Primary',
                'selector' => 'blockquote',
                'classes' => 'border-quote__primary'
              ),
              array(
                'title' => 'Secondary',
                'selector' => 'blockquote',
                'classes' => 'border-quote__secondary'
              ),
              array(
                'title' => 'Tertiary',
                'selector' => 'blockquote',
                'classes' => 'border-quote__tertiary'
              ),
              array(
                'title' => 'Quaternary',
                'selector' => 'blockquote',
                'classes' => 'border-quote__quaternary'
              ),
            ),
          ),
          )
        ),
      array(
        'title' => 'MISC',
        'items' => array(
          array(
            'title' => 'Section Title',
            'selector' => 'p',
            'classes' => 'section-title'
          ),
          array(
            'title' => 'Superscript',
            'inline' => 'sup',
          ),
          array(
            'title' => 'Notice',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'inline' => 'span',
            'classes' => 'notice'
          ),
        )
      ),
      array(
        'title' => 'Image Styles',
        'items' => array(
          array(
            'title' => 'Shadows',
            'items' => array(
              array(
                'title' => 'XSmall',
                'selector' => 'img',
                'classes' => 'shadow-xs'
              ),
              array(
                'title' => 'Small',
                'selector' => 'img',
                'classes' => 'shadow-sm'
              ),
              array(
                'title' => 'Medium',
                'selector' => 'img',
                'classes' => 'shadow-md'
              ),
              array(
                'title' => 'Large',
                'selector' => 'img',
                'classes' => 'shadow-lg'
              ),
              array(
                'title' => 'XLarge',
                'selector' => 'img',
                'classes' => 'shadow-xl'
              ),
            ),
          ),
          array(
            'title' => 'Radius',
            'items' => array(
              array(
                'title' => 'XSmall',
                'selector' => 'img',
                'classes' => 'radius-xs'
              ),
              array(
                'title' => 'Small',
                'selector' => 'img',
                'classes' => 'radius-sm'
              ),
              array(
                'title' => 'Medium',
                'selector' => 'img',
                'classes' => 'radius-md'
              ),
              array(
                'title' => 'Large',
                'selector' => 'img',
                'classes' => 'radius-lg'
              ),
              array(
                'title' => 'XLarge',
                'selector' => 'img',
                'classes' => 'radius-xl'
              ),
            ),
          ),
          )
        ),
    );

  $config['style_formats'] = json_encode( $temp_array );
  return $config;
}
add_filter('tiny_mce_before_init', 'custom_format_styles');


/**
 * Removes buttons from the first row of the tiny mce editor
 */
// function remove_tiny_mce_buttons_from_editor( $buttons ) {
//   $remove_buttons = array(
//     'bold',
//     'italic',
//     'strikethrough',
//     'bullist',
//     'numlist',
//     'blockquote',
//     'hr',
//     'alignleft',
//     'aligncenter',
//     'alignright',
//     'link',
//     'unlink',
//     'wp_more', // read more link
//     'spellchecker',
//     'dfw', // distraction free writing mode
//     'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
//   );
//   foreach ( $buttons as $button_key => $button_value ) {
//     if ( in_array( $button_value, $remove_buttons ) ) {
//       unset( $buttons[ $button_key ] );
//     }
//   }
//   return $buttons;
// }
// add_filter( 'mce_buttons', 'remove_tiny_mce_buttons_from_editor');


/**
 * Removes buttons from the second row (kitchen sink) of the tiny mce editor
 */
function remove_tiny_mce_buttons_from_kitchen_sink( $buttons ) {
    $remove_buttons = array(
        // 'formatselect', // format dropdown menu for <p>, headings, etc
        // 'underline',
        // 'alignjustify',
        'forecolor', // text color
        // 'pastetext', // paste as text
        // 'removeformat', // clear formatting
        // 'charmap', // special characters
        // 'outdent',
        // 'indent',
        // 'undo',
        // 'redo',
        // 'wp_help', // keyboard shortcuts
    );
    foreach ( $buttons as $button_key => $button_value ) {
        if ( in_array( $button_value, $remove_buttons ) ) {
            unset( $buttons[ $button_key ] );
        }
    }
    return $buttons;
}
add_filter( 'mce_buttons_2', 'remove_tiny_mce_buttons_from_kitchen_sink');
