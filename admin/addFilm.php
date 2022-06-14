<?php
header('Content-Type: application/json; charset=utf-8');

include_once('./configDB.php');
//var_dump($_POST);

$name_film = $_POST['name_film'];
$cover = $_FILES['cover'];
$description = $_POST['description'];
$price = $_POST['price'];
$space = $_POST['space'];

//var_dump($cover);
$path = '../images/';

$ext = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));

$filename = tempnam($path, 'cover');
//echo $filename . '.' . $ext;
move_uploaded_file($cover['tmp_name'], $filename . '.' . $ext);
unlink($filename);

$cover = basename($filename . '.' . $ext);


$query = "INSERT INTO
    `film` (`name`, `description`, `space`, `cover`, `price`) 
    VALUES ('$name_film', '$description', '$space', '$cover', '$price')";

$response = execute($query);
if ($response['response'] == 'success') {
    die(
    json_encode(array(
        'response' => 'Add film success',
        'code' => 200
    )));
} else {
    die(json_encode(array('response' => 'Add film fail', 'code' => 400)));
}
