<?php
$language = array(
    'pleio_beconnummer:profile_field:beconnummer' => 'BECONnummer',
    'pleio_beconnummer:settings:file_upload' => 'Upload een BECON CSV-bestand',
    'pleio_beconnummer:settings:file_upload:description' => 'Het bestand moet een CSV-bestand zijn met slechts één kolom (het BECONnummer) en geen kopregel',
    'pleio_beconnummer:settings:toggle_listing' => 'Toon / verberg de huidige BECONnummers',
    'pleio_beconnummer:input:description' => 'Het opgegeven BECONnummer zal worden gevalideerd nadat het formulier is opgestuurd',
    'pleio_beconnummer:profile_field:error:invalid_number' => 'Het opgegeven BECONnummer is ongeldig',
    'pleio_beconnummer:request_overview' => 'Download overzicht',
    'pleio_beconnummer:error:not_a_becon_manager' => 'Je bent been BECONnummer beheerder',
	'pleio_beconnummer:create_manager' => 'Voeg toe als BECONbeheerder',
    'pleio_beconnummer:delete_manager' => 'Verwijder als BECONbeheerder',
	'pleio_beconnummer:manager:created' => 'De gebruiker is nu BECONbeheerder',
	'pleio_beconnummer:manager:deleted' => 'De gebruiker is geen BECONbeheerder meer',
    'pleio_beconnummer:sure' => 'Weet je het zeker?',
    'pleio_beconnummer:request_overview:requested' => 'Een link om het overzicht te downloaden is per mail verstuurd.',
	'pleio_beconnummer:request_overview:subject' => 'Overzicht van gebruikers voor jouw organisatie',
	'pleio_beconnummer:request_overview:body' => 'Beste %s,

	Volg de onderstaande link om een overzicht te downloaden van alle gebruikers die het BECONnummer van jouw organisatie gebruiken:

	%s
    ',
	'pleio_beconnummer:login_required' => 'Inloggen voor deze pagina is vereist',
	'pleio_beconnummer:invalid_link' => 'Deze link is ongeldig of verlopen',
	'pleio_beconnummer:link_not_corresponding' => 'De ingelogde gebruiker correspondeert niet met de gebruiker die de link heeft aangevraagd',
	'pleio_beconnummer:no_beconfield' => 'De site heeft geen BECONnummer veld ingesteld',
	'pleio_beconnummer:user_has_no_beconnummer' => 'De gebruiker heeft geen BECONnummer'
);

add_translation("nl", $language);
