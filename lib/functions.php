<?php

/**
 * Check if user has a card on file
 * @param integer $user_guid
 * @return \Stripe\Card|boolean
 */
function stripe_has_card($user_guid = 0) {

	if (!$user_guid) {
		$user_guid = elgg_get_logged_in_user_guid();
	}

	$stripe = new StripeClient($user_guid);
	$default_card = $stripe->getDefaultCard();

	return $default_card;
}

/**
 * Create a new customer card from a Stripe token
 * @param integer $user_guid
 * @param string $token
 * @return \Stripe\Card|false
 */
function stripe_create_card($user_guid = 0, $token = '') {

	if (!$user_guid) {
		$user_guid = elgg_get_logged_in_user_guid();
	}

	if (!$token) {
		return false;
	}

	$stripe = new StripeClient($user_guid);
	$card = $stripe->createCard($token);

	return $card;
}

/**
 * Get a user from Stripe customer ID
 * @param string $customer_id
 * @return ElggUser|false
 */
function stripe_get_user_from_customer_id($customer_id = '') {
	
	if (!$customer_id) {
		return false;
	}

	$users = elgg_get_entities(array(
		'types' => 'user',
		'metadata_name_value_pairs' => array(
			'name' => 'stripe_customer_id',
			'value' => $customer_id,
		),
		'limit' => 1
	));

	return ($users) ? $users[0] : false;

}

/**
 * Get a user from Stripe account ID
 * @param string $account_id
 * @return ElggUser|false
 */
function stripe_get_user_from_account_id($account_id = '') {
	
	if (!$account_id) {
		return false;
	}

	$users = elgg_get_entities(array(
		'types' => 'user',
		'metadata_name_value_pairs' => array(
			'name' => 'stripe_account_id',
			'value' => $account_id,
		),
		'limit' => 1
	));

	return ($users) ? $users[0] : false;

}
