<?php
// Insert 20 records into the "users" table
$conn = mysqli_connect("localhost", "root", "")
    or die("Failed to connect to the server");

mysqli_select_db($conn, "101223031")
    or die("Database is not available");

$pass = hash('sha256', '123');

$query = "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'adrian@email.com', '$pass', 'Adrian', '2000-01-02', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'barry@email.com', '$pass', 'Barry', '2001-02-03', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'cherry@email.com', '$pass', 'Cherry', '2002-03-04', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'denise@email.com', '$pass', 'Denise', '2002-03-04', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'ethan@email.com', '$pass', 'Ethan', '2003-04-05', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'felicia@email.com', '$pass', 'Felicia', '2004-09-14', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'geralt@email.com', '$pass', 'Geralt', '2005-04-15', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'henry@email.com', '$pass', 'Henry', '2006-11-23', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'idris@email.com', '$pass', 'Idris', '2007-01-01', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'jerry@email.com', '$pass', 'Jerry', '2008-05-21', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'karen@email.com', '$pass', 'Karen', '2009-07-07', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'lara@email.com', '$pass', 'Lara', '2010-06-28', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'marry@email.com', '$pass', 'Marry', '2011-02-09', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'nelson@email.com', '$pass', 'Nelson', '2012-04-16', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'orion@email.com', '$pass', 'Orion', '2013-11-14', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'perry@email.com', '$pass', 'Perry', '2014-02-12', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'diluc@email.com', '$pass', 'Diluc', '2015-03-01', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'jean@email.com', '$pass', 'Jean', '2016-05-30', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'kaeya@email.com', '$pass', 'Kaeya', '2020-01-02', 0);";
$query .= "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
    VALUES (NULL, 'amber@email.com', '$pass', 'Amber', '2020-06-22', 0);";

$result = mysqli_multi_query($conn, $query)
    or die("Unable to execute the query");

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
    <title></title>
</head>
<body>
    <h2>This web page is only used to insert the sample records.</h2>
</body>
</html>
