<?php
session_start();
require_once ('./admin/configDB.php');

$username = $_SESSION['username'];
$id_film = $_POST['id_films'];

$query = "INSERT INTO history(username, film_id) VALUES ('$username', '$id_film')";
execute($query);
$query = "UPDATE film SET space = space - 1 WHERE id = '$id_film'";
execute($query);
header('location: index.php');