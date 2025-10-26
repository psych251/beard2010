<?php
// get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];
$filename = $post_data['filename'];

if (!empty($filename)) {
    $file = $filename . '_' . date("Ymd_His");
} else {
    $file = uniqid("session-");
}

$data_dir = __DIR__;
$name = $data_dir . '/data/' . $file . '.csv';
file_put_contents($name, $data);
echo "Data saved successfully as: $name";
?>