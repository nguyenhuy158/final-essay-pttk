<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
include_once('./configDB.php');

//var_dump($_GET);
$id_films = $_GET['id_films'];

$query = "DELETE FROM film WHERE `film`.`id` = '$id_films'";

$response = execute($query);
echo "<a class='' href='../editFilm.php' target=''>Home</a>";
if ($response['response'] == 'success') {
//    die(
//    json_encode(array(
//        'response' => 'Remove film success',
//        'code' => 200
//    )));
    echo "<h1>Remove film success</h1>";
} else {
//    die(json_encode(array('response' => 'Remove film fail', 'code' => 400)));
    echo "<h1>Remove film fail</h1>";
}
?>
</body>
</html>