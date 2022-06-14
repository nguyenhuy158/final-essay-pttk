<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once ('./admin/configDB.php');
if (!isset($_SESSION['username'])) {
    die(json_encode(array('response' => 'Please login (or sign up) first', 'code' => 400)));
}
$username = $_SESSION['username'];
$user_id = getUserIdByUsername($username);
$id_film = $_POST['id_films'];
$space= $_POST['space'];


if (getMoneyByUsername($username) < getPriceById($id_film)) {
    die(json_encode(array('response' => 'Not enough money', 'code' => 400)));
}

$query = "INSERT INTO history(user_id, film_id, space) VALUES ('$user_id', '$id_film', '$space')";
//var_dump($query);

execute($query);

$price = getPriceById($id_film);
$query = "UPDATE users SET money = money - $price WHERE username = '$username'";
execute($query);
die(json_encode(array('response' => 'Success', 'code' => 200)));
