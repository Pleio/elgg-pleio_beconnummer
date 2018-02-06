<?php 

function pleio_beconnummer_get_beconnummers(){
	static $result;

	if(!isset($result)){
		$result = false;

		$site = elgg_get_site_entity();

		$fh = new ElggFile();
		$fh->owner_guid = $site->getGUID();

		$fh->setFilename("beconnummers.json");

		if($fh->exists()){
			if($nummers = $fh->grabFile()){
				if($nummers = json_decode($nummers, true)){
					$result = $nummers;
				}
			}
		}
	}

	return $result;
}

function pleio_beconnummer_set_beconnummers($nummers){
	$result = false;

	$site = elgg_get_site_entity();

	$fh = new ElggFile();
	$fh->owner_guid = $site->getGUID();

	$fh->setFilename("beconnummers.json");

	if(!empty($nummers)){
		if(!is_array($nummers)){
			$nummers = array($nummers);
		}

		$json_nummers = json_encode($nummers);

		$fh->open("write");
		$result = $fh->write($json_nummers);
		$fh->close();

	} else {
		$result = $fh->delete();
	}

	return $result;
}

function pleio_beconnummer_validate_beconnummer($beconnummer){
	$result = false;

	if(!empty($beconnummer)){
		if($valid_nummers = pleio_beconnummer_get_beconnummers()){
			$valid_nummers = array_map("strtolower", $valid_nummers);

			if(in_array(strtolower($beconnummer), $valid_nummers)){
				$result = true;
			}
		}
	}

	return $result;
}

function pleio_beconnummer_is_manager(ElggUser $user) {
	$site = elgg_get_site_entity();

	if (!$user) {
		return false;
	}

	return check_entity_relationship($user->guid, "becon_manager", $site->guid) ? true : false;
}

function pleio_beconnummer_get_profile_field_name() {
	global $CONFIG;

	$items = profile_manager_get_categorized_fields(null, false, true);
	foreach ($items['categories'] as $cat_id => $cat) {
		foreach ($items['fields'][$cat_id] as $field) {
			if ($field->metadata_type === "beconnummer") {
				return $field->metadata_name;
			}
		}
	}

	return false;
}

function pleio_beconnummer_sign_data($data) {
	$data = base64_encode(json_encode($data)) . ":" . time();
	$hash = hash_hmac("sha256", $data, get_site_secret());
	return "{$hash}:{$data}";
}

function pleio_beconnummer_load_signed_data($data) {
	list($input_hash, $data, $timestamp) = explode(":", $data);
	$verification_hash = hash_hmac("sha256", $data . ":" . $timestamp, get_site_secret());

	if ($verification_hash !== $input_hash) {
		return false;
	}
	if (time() > $timestamp + 3600*24) {
		return false;
	}
	$data = json_decode(base64_decode($data), true);
	if (!$data) {
		return false;
	}
	return $data;
}