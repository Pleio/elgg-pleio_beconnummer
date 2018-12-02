<?php 
/**
 * Validate any beconnumber profile field if the content is valid
 * 
 * @param string $hook
 * @param string $type
 * @param mixed $return_value
 * @param mixed $params
 */

function pleio_beconnummer_action_handler($hook, $type, $return_value, $params){
	$metadata_name = pleio_beconnummer_get_profile_field_name();
	if (!$metadata_name) {
		return true;
	}

	$accesslevel = get_input('accesslevel');
	$accesslevel[$metadata_name] = ACCESS_PRIVATE;
	set_input('accesslevel', $accesslevel);

	if ($type == "profile/edit") {
		$user = get_user(get_input("guid"));
		$value = get_input($metadata_name);
	} elseif ($type == "profile_manager/complete") {
		$user = elgg_get_logged_in_user_entity();
		$fields = get_input('custom_profile_fields');
		$value = $fields[$metadata_name];
	} else {
		$value = get_input("custom_profile_fields_" . $metadata_name);
	}

	if (!$value && $user) {
		$value = $user->$metadata_name;
	}

	if (!pleio_beconnummer_validate_beconnummer($value)) {
		register_error(elgg_echo("pleio_beconnummer:profile_field:error:invalid_number"));

		if ($type == "profile/edit") {
			set_input($metadata_name, $user->$metadata_name);
		} else {
			forward(REFERER);
			return false;
		}
	}
}

function pleio_beconnummer_user_hover_menu_handler($hook, $type, $returnvalue, $params) {
	$result = $returnvalue;

	if (!elgg_is_admin_logged_in()) {
		return $result;
	}

	$user = elgg_extract("entity", $params);
	if (!$user) {
		return $result;
	}

	if (pleio_beconnummer_is_manager($user)) {
		$text = elgg_echo("pleio_beconnummer:delete_manager");
	} else {
		$text = elgg_echo("pleio_beconnummer:create_manager");
	}

	$result[] = ElggMenuItem::factory(array(
		"name" => "pleio_beconnummer_manager",
		"text" => $text,
		"href" => "action/pleio_beconnummer/toggle_manager?user_guid={$user->guid}",
		"confirm" => elgg_echo("pleio_beconnummer:sure")
	));

	return $result;
}