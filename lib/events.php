<?php

function pleio_beconnummer_leave_site($event, $type, $relationship) {
    $user = get_user($relationship->guid_one);
    $site = elgg_get_site_entity($relationship->guid_two);

    if (!$user || !$site) {
        return;
    }

    $field_name = pleio_beconnummer_get_profile_field_name();

    // Remove BECON from user field when leaving the site.
    unset($user->$field_name);
    $user->save();
}
