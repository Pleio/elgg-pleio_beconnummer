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
		
		if($profile_fields = elgg_get_config("profile_fields")){
			$check_fields = array();
			
			foreach($profile_fields as $metadata_name => $field_type){
				if($field_type == "beconnummer"){
					$check_fields[] = $metadata_name;
				}
			}
			
			if(!empty($check_fields)){
				foreach($check_fields as $metadata_name){
					if($type == "profile/edit") {
						if($value = get_input($metadata_name)){
							if(!pleio_beconnummer_validate_beconnummer($value)){
								// let the user know this number was invalid
								register_error(elgg_echo("pleio_beconnummer:profile_field:error:invalid_number"));
						
								$user = get_user(get_input("guid"));
								// set value to previous value
								set_input($metadata_name, $user->$metadata_name);
							}
						}
					} elseif($type == "register") {
						if($value = get_input("custom_profile_fields_" . $metadata_name)){
							if(!pleio_beconnummer_validate_beconnummer($value)){
								// let the user know this number was invalid
								register_error(elgg_echo("pleio_beconnummer:profile_field:error:invalid_number"));
								
								// set value to empty
								// because of profile_manager we have to change _POST
								unset($_POST["custom_profile_fields_" . $metadata_name]);
								unset($_REQUEST["custom_profile_fields_" . $metadata_name]);
							}
						}
					} elseif (in_array($type, array("subsites/join/request_approval", "subsites/join/validate_domain", "subsites/join/missing_fields"))) {
						if($value = get_input("custom_profile_fields_" . $metadata_name)){
							if(!pleio_beconnummer_validate_beconnummer($value)){
								// let the user know this number was invalid
								register_error(elgg_echo("pleio_beconnummer:profile_field:error:invalid_number"));
								
								// set value to empty
								// because of profile_manager we have to change _POST
								$_POST["custom_profile_fields_" . $metadata_name] = "";
								$_REQUEST["custom_profile_fields_" . $metadata_name] = "";
							}
						}
					}
				}
			}
		}
	}