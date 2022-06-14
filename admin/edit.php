<?php
header('Content-Type: application/json; charset=utf-8');

include_once('./configDB.php');
//var_dump($_POST);

$id_films = $_POST['id_films'];
$name_film = $_POST['name_film'];
$cover = $_FILES['cover'];
$description = $_POST['description'];
$price = $_POST['price'];
$space = $_POST['space'];

if ($cover['size'] != 0) {

//var_dump($cover['size']);
    $path = '../images/';

    $ext = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));

    $filename = tempnam($path, 'cover');
//echo $filename . '.' . $ext;
    move_uploaded_file($cover['tmp_name'], $filename . '.' . $ext);
    unlink($filename);

    $cover = basename($filename . '.' . $ext);
} else {
    $cover = getCoverById($id_films);
}

$query = "UPDATE
    `film` 
    SET name = '$name_film', 
        description = '$description',
        space = '$space',
        cover = '$cover',
        price = '$price'
    WHERE id = '$id_films'";

$response = execute($query);
if ($response['response'] == 'success') {
    die(
    json_encode(array(
        'response' => 'Edit film success',
        'code' => 200
    )));
} else {
    die(json_encode(array('response' => 'Edit film fail', 'code' => 400)));
}
