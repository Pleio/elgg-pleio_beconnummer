<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	
	elgg_register_event_handler("init", "system", "pleio_beconnummer_init");
	
	function pleio_beconnummer_init(){
		// register custom profile type
		$profile_options = array(
			"show_on_register" => true,
			"mandatory" => true,
			"user_editable" => true,
			"output_as_tags" => true,
			"admin_only" => true,
			"count_for_completeness" => true
		);
		
		add_custom_field_type("custom_profile_field_types", "beconnummer", elgg_echo("pleio_beconnummer:profile_field:beconnummer"), $profile_options);
		
		// register plugin hooks
		elgg_register_plugin_hook_handler("action", "register", "pleio_beconnummer_action_handler", 400);
		elgg_register_plugin_hook_handler("action", "profile/edit", "pleio_beconnummer_action_handler", 400);
		
		elgg_register_plugin_hook_handler("action", "profile_manager/complete", "pleio_beconnummer_action_handler", 400);
		elgg_register_plugin_hook_handler("action", "subsites/join/request_approval", "pleio_beconnummer_action_handler", 400);
		elgg_register_plugin_hook_handler("action", "subsites/join/validate_domain", "pleio_beconnummer_action_handler", 400);
		elgg_register_plugin_hook_handler("action", "subsites/join/missing_fields", "pleio_beconnummer_action_handler", 400);
		
		// register actions
		elgg_register_action("pleio_beconnummer/settings/save", dirname(__FILE__) . "/actions/settings/save.php", "admin");
	}