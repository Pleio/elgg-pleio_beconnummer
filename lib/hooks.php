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
	$options = array(
			"type" => "object",
			"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE,
			"limit" => false,
			"owner_guid" => elgg_get_config("site_guid")
	);
	$profile_fields = elgg_get_entities($options);

	$check_fields = array();
	
	foreach($profile_fields as $profile_field){
		if($profile_field->metadata_type == "beconnummer"){
			$check_fields[] = $profile_field->metadata_name;
		}
	}

	if (empty($check_fields)) {
		return true;
	}
	
	foreach ($check_fields as $metadata_name) {
		$accesslevel = get_input('accesslevel');
		$accesslevel[$metadata_name] = ACCESS_PRIVATE;
		set_input('accesslevel', $accesslevel);

		if ($type == "profile/edit") {
			$value = get_input($metadata_name);
		} elseif ($type == "profile_manager/complete") {
			$fields = get_input('custom_profile_fields');
			$value = $fields[$metadata_name];
		} else {
			$value = get_input("custom_profile_fields_" . $metadata_name);
		}

		if (!$value) {
			return true;
		}

		if (!pleio_beconnummer_validate_beconnummer($value)) {
			register_error(elgg_echo("pleio_beconnummer:profile_field:error:invalid_number"));

			if ($type == "profile/edit") {
				$user = get_user(get_input("guid"));
				set_input($metadata_name, $user->$metadata_name);
			} else {
				return false;
			}
		}
	}
}