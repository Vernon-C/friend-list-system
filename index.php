<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "")
    or die("Failed to connect the server");

@mysqli_select_db($conn, "101223031")
    or die("Database is not available");

// Create the tables if they do not exist
$query = "CREATE TABLE IF NOT EXISTS users (
    user_id int NOT NULL AUTO_INCREMENT,
    user_email varchar(50) NOT NULL,
    password varchar(20) NOT NULL,
    profile_name varchar(30) NOT NULL,
    date_started date NOT NULL,
    num_of_friends int UNSIGNED,
    PRIMARY KEY(user_id)
    );";

$result = mysqli_query($conn, $query)
    or die("Unable to execute the query1");

$query = "CREATE TABLE IF NOT EXISTS `myfriends` (
    user_id int NOT NULL,
    friend_id int NOT NULL
    );";

$result = mysqli_query($conn, $query)
    or die("Unable to execute the query");

// Close the connection
mysqli_close($conn)
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
    <title>Home Page</title>
</head>
<body>
    <header>
        <h2>My Friend System</h2>
        <h2>Assignment Home Page</h2>
    </header>
    <article>
        <!-- Student Information -->
        <div class="row">
            <div class="column">
                <p>Name: Vernon Chai Chyn Yeong</p>
                <p>Email: 101223031@students.swinburne.edu.my</p>
            </div>
            <div class="column">
                <p>Student ID: 101223031</p>
            </div>
        </div>
        <br />

        <p>I declare that this assignment is my individual work. I have not worked collaboratively 
        nor have I copied from any other student’s work or from any other source.</p>
        <br />

        <!-- Links -->
        <p><a href="signup.php">Sign up</a></p>
        <p><a href="login.php">Log in</a></p>
        <p><a href="about.php">About</a></p>
    </article>
</body>
</html>
