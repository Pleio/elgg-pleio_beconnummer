<?php
$english = array(
	'pleio_beconnummer:profile_field:beconnummer' => "BECONnumber",
	'pleio_beconnummer:settings:file_upload' => "Upload a BECON csv-file",
	'pleio_beconnummer:settings:file_upload:description' => "The file must be a CSV-file with only one column (the BECONnumber) and no column header.",
	'pleio_beconnummer:settings:toggle_listing' => "Show / hide the current BECONnumbers",
	'pleio_beconnummer:input:description' => "The supplied BECONnumber will be validated after you submit the form",
	'pleio_beconnummer:profile_field:error:invalid_number' => "The supplied BECONnumber is invalid",
	'pleio_beconnummer:request_overview' => 'Download overview',
	'pleio_beconnummer:error:not_a_becon_manager' => 'You are not a BECONnumber manager',
	'pleio_beconnummer:create_manager' => 'Add as BECON manager',
	'pleio_beconnummer:delete_manager' => 'Remove as BECON manager',
	'pleio_beconnummer:sure' => 'Are you sure?',
	'pleio_beconnummer:request_overview:requested' => 'A link to the overview has been send to your e-mail.',
	'pleio_beconnummer:request_overview:subject' => 'Overview of users for your organization',
	'pleio_beconnummer:request_overview:body' => 'Dear %s,

	Follow this link to get an overview of users in your organization:

	%s
	',
	'pleio_beconnummer:login_required' => 'Login for this page is required',
	'pleio_beconnummer:invalid_link' => 'The link you provided is invalid or expired',
	'pleio_beconnummer:link_not_corresponding' => 'The link you provided is not corresponding with the user who requested the overview',
	'pleio_beconnummer:no_beconfield' => 'The site has no BECON number field provided',
	'pleio_beconnummer:user_has_no_beconnummer' => 'You have no BECON number attached to your profile'
);

add_translation("en", $english);