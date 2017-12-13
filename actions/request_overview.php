<?php
$site = elgg_get_site_entity();
$user = elgg_get_logged_in_user_entity();

if (!$user || !pleio_beconnummer_is_manager($user)) {
    register_error(elgg_echo("pleio_beconnummer:error:not_a_becon_manager"));
    forward(REFERER);
}

$from = $site->email ?: "noreply@" . get_site_domain($site->guid);

$hash = pleio_beconnummer_sign_data([
    "guid" => $user->guid
]);

$link = "{$site->url}becon/overview?hash={$hash}";

elgg_send_email(
    $from,
    $user->email,
    elgg_echo("pleio_beconnummer:request_overview:subject"),
    elgg_echo("pleio_beconnummer:request_overview:body", [
        $user->name,
        $link
    ])
);

system_log($user, "requested_beconnummer_overview");
system_message(elgg_echo("pleio_beconnummer:request_overview:requested"));
