<?php
$hash = get_input("hash");
$data = pleio_beconnummer_load_signed_data($hash);
$user = elgg_get_logged_in_user_entity();

if (!$user) {
    register_error(elgg_echo("pleio_beconnummer:login_required"));
    forward("/login");
}

if (!$data) {
    register_error(elgg_echo("pleio_beconnummer:invalid_link"));
    forward("/");
}

if ($data["guid"] !== $user->guid) {
    register_error(elgg_echo("pleio_beconnummer:link_not_corresponding"));
    forward("/");
}

$field_name = pleio_beconnummer_get_profile_field_name();

if (!$field_name) {
    register_error(elgg_echo("pleio_beconnummer:no_beconfield"));
    forward("/");
}

$user_becon = $user->$field_name;

if (!$user_becon) {
    register_error(elgg_echo("pleio_beconnummer:user_has_no_beconnummer"));
    forward("/");
}

$options = [
    "type" => "user",
    "metadata_name_value_pairs" => [
        "name" => $field_name,
        "value" => $user_becon
    ],
    "limit" => 0
];

$users = elgg_get_entities_from_metadata($options);
if (!$users) {
    $users = [];
}

$time = time();
header("Content-Type: text/csv");
header("Content-Disposition: attachment;filename=becon-export-{$time}.csv");

$out = fopen("php://output", "w");
foreach ($users as $user) {
    fputcsv($out, [
        $user->guid,
        $user->name
    ]);
}

fclose($out);
