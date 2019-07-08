<?php
/**
 * Elgg Stripe plugin
 * @package stripe
 */

$entity = elgg_extract('entity', $vars);

echo elgg_format_element('h3', [], elgg_echo('stripe:settings:environment'));

echo elgg_view_field([
    '#type' => 'dropdown',
    'name' => 'params[environment]',
	'value' => ($entity->environment) ? $entity->environment : StripeClientFactory::ENV_SANDBOX,
	'#label' => elgg_echo('stripe:settings:environment:select'),
    'options_values' => array(
		StripeClientFactory::ENV_SANDBOX => elgg_echo('stripe:settings:environment:sandbox'),
		StripeClientFactory::ENV_PRODUCTION => elgg_echo('stripe:settings:environment:production'),
	),
]);


echo elgg_format_element('h3', [], elgg_echo('stripe:settings:sandbox:api_keys'));

echo elgg_view_field([
    '#type' => 'text',
    'name' => 'params[stripe_test_secret_key]',
	'value' => $entity->stripe_test_secret_key,
	'#label' => elgg_echo('stripe:settings:sandbox:secret_key'),
]);

echo elgg_view_field([
    '#type' => 'text',
    'name' => 'params[stripe_test_publishable_key]',
	'value' => $entity->stripe_test_publishable_key,
	'#label' => elgg_echo('stripe:settings:sandbox:publishable_key'),
]);


echo elgg_format_element('h3', [], elgg_echo('stripe:settings:production:api_keys'));

echo elgg_view_field([
    '#type' => 'text',
    'name' => 'params[stripe_production_secret_key]',
	'value' => $entity->stripe_production_secret_key,
	'#label' => elgg_echo('stripe:settings:production:secret_key'),
]);

echo elgg_view_field([
    '#type' => 'text',
    'name' => 'params[stripe_production_publishable_key]',
	'value' => $entity->stripe_production_publishable_key,
	'#label' => elgg_echo('stripe:settings:production:publishable_key'),
]);
