<?php
$site = elgg_get_site_entity();

$guid = get_input("user_guid");
$user = get_entity($guid);

if (!$user) {
    register_error(elgg_echo("pleio_beconnummer:user_not_found"));
    forward(REFERER);
}

if (pleio_beconnummer_is_manager($user)) {
    remove_entity_relationship($user->guid, "becon_manager", $site->guid);
    system_message(elgg_echo("pleio_beconnummer:manager:deleted"));
} else {
    add_entity_relationship($user->guid, "becon_manager", $site->guid);
    system_message(elgg_echo("pleio_beconnummer:manager:created"));
}