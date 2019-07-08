<?php

$card_id = get_input('card_id');
$customer_id = get_input('customer_id');

$user = stripe_get_user_from_customer_id($customer_id);

if (!elgg_instanceof($user) || !$user->canEdit()) {
	return elgg_error_response(elgg_echo('stripe:access_error'));
}

$stripe = new StripeClient($user->guid);
if ($stripe->setDefaultCard($card_id)) {
	return elgg_ok_response('', elgg_echo('stripe:cards:make_default:success'), REFERER);
} else {
	$stripe->showErrors();
	return elgg_error_response(elgg_echo('stripe:cards:make_default:error'));
}

forward(REFERER);
