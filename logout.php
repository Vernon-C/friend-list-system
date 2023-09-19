<?php
// Resume the session
session_start();

// Destroy session if it is set
if (isset($_SESSION['pname'])) {
    session_unset();
    session_destroy();

    // Redirect to home page
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="My Friend System" />
    <meta name="keywords" content="friend, system" />
    <meta name="author" content="Vernon Chai" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Log Out</title>
</head>
<body>
</body>
</html>
