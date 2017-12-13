<?php 

	$params = get_input('params');
	$plugin_id = get_input('plugin_id');
	$plugin = elgg_get_plugin_from_id($plugin_id);
	
	if (!($plugin instanceof ElggPlugin)) {
		register_error(elgg_echo('plugins:settings:save:fail', array($plugin_id)));
		forward(REFERER);
	}
	
	$plugin_name = $plugin->getManifest()->getName();

	/**
	 * overrule the default plugin settings save action to do our own stuff
	 */
	
	if(get_uploaded_file("becon_file")){
		$uploaded_file = $_FILES["becon_file"];
		
		if($fh = fopen($uploaded_file["tmp_name"], "r")){
			$beconnummers = array();
			
			while(($data = fgetcsv($fh)) !== false){
				$beconnummers[] = $data[0];
			}
			
			pleio_beconnummer_set_beconnummers($beconnummers);
		}
	}
	
	/**
	 * Saves global plugin settings.
	 *
	 * This action can be overriden for a specific plugin by creating the
	 * settings/<plugin_id>/save action in that plugin.
	 *
	 * @uses array $_REQUEST['params']    A set of key/value pairs to save to the ElggPlugin entity
	 * @uses int   $_REQUEST['plugin_id'] The ID of the plugin
	 *
	 * @package Elgg.Core
	 * @subpackage Plugins.Settings
	 */
	
	$result = false;
	
	// default actions
	if(!empty($params)){
		foreach ($params as $k => $v) {
			$result = $plugin->setSetting($k, $v);
			if (!$result) {
				register_error(elgg_echo('plugins:settings:save:fail', array($plugin_name)));
				forward(REFERER);
				exit;
			}
		}
	}
	
	system_message(elgg_echo('plugins:settings:save:ok', array($plugin_name)));
	forward(REFERER);