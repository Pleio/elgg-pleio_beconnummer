<?php 

	$plugin = elgg_extract("entity", $vars);
	
	echo "<div>";
	echo "<label>" . elgg_echo("pleio_beconnummer:settings:file_upload") . "</label><br />";
	echo elgg_view("input/file", array("name" => "becon_file"));
	echo "<div class='elgg-subtext'>" . elgg_echo("pleio_beconnummer:settings:file_upload:description") . "</div>";
	echo "</div>";
	
	if($beconnummers = pleio_beconnummer_get_beconnummers()){
		echo elgg_view("output/url", array("href" => "#pleio_beconnummer_settings_listing", "rel" => "toggle", "text" => elgg_echo("pleio_beconnummer:settings:toggle_listing"), "class" => "mbs"));
		
		echo "<div id='pleio_beconnummer_settings_listing' class='hidden mbm'>";
		
		foreach($beconnummers as $nummer){
			echo $nummer . "<br />";
		}
		
		echo "</div>";
	}
?>
<script type="text/javascript">
	$('#pleio_beconnummer-settings').attr("enctype", "multipart/form-data");
</script>