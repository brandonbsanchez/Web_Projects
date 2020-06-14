<?php

//Database handler/connector

$server_name = '209.129.8.7';
$username = 'RCCCSCCIS17B';
$password = '4050240368';
$database_name = 'RCCCSCCIS17B';

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if(!$conn) {
    die('Connection Failed' . mysqli_connect_error());
}