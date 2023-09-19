<?php
// Create Database `101223031`
$conn = mysqli_connect("localhost", "root", "")
    or die("Failed to connect to the server");

$query = "CREATE DATABASE `101223031`;";

$result = mysqli_query($conn, $query)
    or die("Failed to create database");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="My Friend System" />
    <meta name="keywords" content="friend, system" />
    <meta name="author" content="Vernon Chai" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Database</title>
</head>
<body>
    <h2>This web page is only used to create the database `101223031`.</h2>
</body>
</html>
