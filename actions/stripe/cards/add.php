<?php

$token       = get_input('stripe-token');
$guid        = get_input('guid');
$email       = get_input('email');
$customer_id = get_input('customer_id');

if ($guid) {
	$attr = $guid;
} else if ($email) {
	$attr = $email;
} else if ($customer_id) {
	$attr = $customer_id;
} else {
	$attr = elgg_get_logged_in_user_guid();
}

$stripe = new StripeClient($attr);
$card   = $stripe->createCard($token, true);

if ($card) {
	if (elgg_is_xhr()) {
		echo json_encode(array(
			'label' => "{$card->brand}-{$card->last4} ({$card->exp_month} / {$card->exp_year})",
			'id' => $card->id,
			'view' => elgg_view('stripe/objects/card', array(
				'object' => $card
			)),
		));
	}
	return elgg_ok_response('', elgg_echo('stripe:cards:add:success'), REFERER);
} else {
	$stripe->showErrors();
	return elgg_error_response(elgg_echo('stripe:cards:add:error'));
}

forward(REFERER);
