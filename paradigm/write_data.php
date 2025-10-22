<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log that the script was called
file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Script called\n", FILE_APPEND);

// get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];

file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Data received: " . strlen($data) . " bytes\n", FILE_APPEND);

// generate a unique ID for the file
$file = uniqid("session-");

// the directory "data" must be writable by the server
$name = "data/{$file}.csv";

// write the file to disk
$result = file_put_contents($name, $data);

if($result !== false) {
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - File saved: $name\n", FILE_APPEND);
    echo json_encode(['success' => true, 'filename' => $name]);
} else {
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - FAILED to save file\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Could not write file']);
}
?>
