<?php
/**
 * Elgg Stripe plugin
 * @package stripe
 */

gatekeeper();

// $username = elgg_extract(0, $page, false);  // OBS
$username = elgg_extract('username', $vars, false);

if ($username) {
    $user = get_user_by_username($username);
}

if (!elgg_instanceof($user) || !$user->canEdit()) {
    $user = elgg_get_logged_in_user_entity();
    forward("$handler/$user->username");
}

elgg_set_context('settings');

elgg_set_page_owner_guid($user->guid);

elgg_push_breadcrumb(elgg_echo('stripe:billing'), 'billing');

// $context = elgg_extract(1, $page, 'cards');  // OBS
$context = elgg_extract('context', $vars, 'cards');
// $action  = elgg_extract(2, $page, 'all');  // OBS
$action = elgg_extract('action', $vars, 'all');

$view = "stripe/pages/$context/$action";

if (elgg_view_exists($view)) {

    $params = array(
        'entity'  => $user,
        // 'id'      => elgg_extract(3, $page, false),  // OBS
        'id'      => elgg_extract('id', $vars, false),
        'context' => $page
    );

    $title   = elgg_echo("stripe:$context:$action");
    $content = elgg_view($view, $params);
    $sidebar = elgg_view('stripe/sidebar', $params);
    $filter  = elgg_view("stripe/filters/$context/$action", $params);
}

if ($content) {
    if (elgg_is_xhr()) {
        echo $content;
    } else {
        $layout = elgg_view_layout('content', array(
            'title'   => $title,
            'content' => $content,
            'sidebar' => $sidebar,
            'filter'  => $filter,
        ));

        echo elgg_view_page($title, $layout);
    }
}

