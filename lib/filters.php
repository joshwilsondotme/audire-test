<?php
    
/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return '&hellip;';
});

/**
 * Update Yoast SEO Content if Post
 * is subscribed to another
 */

$tags = [
    'wpseo_title' => 'title',
    'wpseo_metadesc' => 'description',
    'wpseo_canonical' => 'canonical',
    'wpseo_robots' => 'robots',
    'wpseo_twitter_card_type' => 'twitter_card',
    'wpseo_twitter_description' => 'twitter_description',
    'wpseo_twitter_image' => 'twitter_image',
    'wpseo_twitter_site' => 'twitter_site',
    'wpseo_twitter_title' => 'twitter_title',
    'wpseo_opengraph_author_facebook' => 'open_graph_fb_app_id',
    'wpseo_og_article_publisher' => 'open_graph_article_publisher',
    'wpseo_opengraph_desc' => 'open_graph_description',
    'wpseo_og_locale' => 'open_graph_locale',
    // 'wpseo_opengraph_site_name' => 'open_graph_site_name',
    'wpseo_opengraph_title' => 'open_graph_title',
    'wpseo_opengraph_type' => 'open_graph_type',
    // 'wpseo_opengraph_url' => 'open_graph_url',
    'wpseo_opengraph_image' => 'open_graph_images'
];

foreach ($tags as $key => $val) {

    add_filter($key, function ($value) use ($val) {

        if (is_singular()) {

            $parent = [
                'site' => get_field('parent_site'),
                'post' => get_field('parent_post')
            ];

            if (
                isset($parent['site']) &&
                $parent['site'] !== '' &&
                isset($parent['post']) &&
                $parent['post'] !== ''
            ) {
                switch_to_blog($parent['site']);
                $value = YoastSEO()->meta->for_post($parent['post'])->$val;
                restore_current_blog();
            }

            return $value;
        }

        return $value;
    }, 10);
}

/**
 * Add Rewrite Rule for news
 *
 * Comment this out to disable news (master kill switch)
 */
add_action('init', function () {
    add_rewrite_rule('news\/?([a-z0-9-]+)?[\/]?$', 'index.php?news&article=$matches[1]', 'top');
});

/**
 * Add Query Vars for news
 */
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'news';
    $query_vars[] = 'article';
    return $query_vars;
});

/**
 * Load the News single and archive templates
 */
add_action('template_redirect', function () {
    global $wp_query;

    // bail if the virtual endpoint was not called
    // modify this to check for whatever will identify your virtual page request (i.e., your query var)
    if (!isset($wp_query->query_vars['news']) || $wp_query->is_404) {
        return;
    }

    if (
        isset($wp_query->query_vars['article']) &&
        $wp_query->query_vars['article'] !== ''
    ) {
        $template = locate_template(["resources/views/layouts/single-news.blade.php"]);

        if ($template) {
            echo view($template)->render();
            die();
        }
    } else {
        $template = locate_template(["resources/views/layouts/archive-news.blade.php"]);

        if ($template) {
            echo view($template)->render();
            die();
        }
    }
});

/**
 * Prevent 404 and fetch news posts
 */
add_filter('the_posts', function (array $posts, WP_Query $query) {
    // modify this to check for whatever will identify your virtual page request (i.e., your query var)
    if (!isset($query->query_vars['news'])) {
        return $posts;
    }

    switch_to_blog(1);

    $args = array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => 10
    );

    if (
        isset($query->query_vars['article']) &&
        $query->query_vars['article'] !== ''
    ) {
        $args['name'] = $query->query_vars['article'];
        $args['posts_per_page'] = 1;
    }

    $posts = get_posts($args);

    restore_current_blog();

    if (count($posts) === 0) {
        $query->set_404();
        status_header(404);
        return null;
    }

    return $posts;
}, 10, 2);

/**
 * Enable unfiltered_html capability for Administrators.
 *
 * @param  array  $caps    The user's capabilities.
 * @param  string $cap     Capability name.
 * @param  int    $user_id The user ID.
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */
function km_add_unfiltered_html_capability_to_editors( $caps, $cap, $user_id ) {
    if ( 'unfiltered_html' === $cap && user_can( $user_id, 'administrator' ) ) {
        $caps = array( 'unfiltered_html' );
    }
    return $caps;
}
add_filter( 'map_meta_cap', 'km_add_unfiltered_html_capability_to_editors', 1, 3 );