<?php
/**
 * Elgg Stripe plugin
 * @package stripe
 */

return [
    'actions' => [
        'stripe/customers/sync' => ['access' => 'admin'],
        'stripe/cards/add' => ['access' => 'public'],
        'stripe/cards/remove' => [],
        'stripe/cards/set_default' => [],
        'stripe/subscriptions/cancel' => [],
    ],
    'routes' => [
        'default:stripe:billing' => [
            'path' => '/billing/username/context/action/{id?}',
            'resource' => 'stripe/billing',
        ],
    ],
    'widgets' => [],
    'views' => [],
    'upgrades' => [],
    'settings' => [],
	
];
