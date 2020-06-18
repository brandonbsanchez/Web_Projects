<?php

//Database handler/connector

$server_name = 'localhost';
$username = 'root';
$password = '42069';
$database_name = 'surveyengine';

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if(!$conn) {
    die('Connection Failed' . mysqli_connect_error());
}