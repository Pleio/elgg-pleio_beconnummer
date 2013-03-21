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