<?php
/**
 * Columns fields have multiple columns with individual backgrounds, 
 * and then the entire columns section can have a background.
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$backgroundSettings = new FieldsBuilder('background_settings');
$backgroundSettings
    ->addImage('background_image')
    ->addTrueFalse('background_image_fixed')
    ->addColorPicker('background_color');

/**
 * Columns fields have multiple columns with individual backgrounds, 
 * and then the entire columns section can have a background.
 */
$columns = new FieldsBuilder('columns');
$columns
    ->addTab('Columns')
        ->addRepeater('columns', ['min' => 1, 'max' => 3, 'layout' => 'block'])
            ->addTab('Content')
                ->addWysiwyg('content')
            ->addTab('Background')
                ->addFields($backgroundSettings)
            ->endRepeater()

     ->addTab('Background')
         ->addFields($backgroundSettings);

/**
 * A Banner on top of every page 
 */
$banner = new FieldsBuilder('banner');
$banner
    ->addRepeater('slides', ['min' => 1, 'layout' => 'block'])
        ->addFields($columns)
    ->setLocation('post_type', '==', 'page');

/**
 * Sections go below a banner, additional banners can be added as a section.
 * Columns can also be added as a section. These layouts can be used on the
 * default template.
 */
$sections = new FieldsBuilder('sections');
$sections
    ->addFlexibleContent('sections')
       ->addLayout($banner)
       ->addLayout($columns)
    ->setLocation('page_template', '==', 'default');

/**
 * About template has a special Team Members sections only for the about page. 
 * It will list all the team members. It has an intro section and has a
 * configurable background.
 */
$aboutSections = new FieldsBuilder('about_sections');
$aboutSections
    ->addFlexibleContent('sections')
       ->addLayout($banner)
       ->addLayout($columns)
       ->addLayout('team_members')
           ->addTab('Intro')
               ->addText('title')
               ->addWysiwyg('intro')
           ->addTab('Background')
               ->addFields($background_settings)
    ->setLocation('post_type', '==', 'page');