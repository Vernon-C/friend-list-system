<?php
$email = $pname = $msg = "";

// Check whether all the fields have been set
if (isset($_POST['email'], $_POST['profile_name'], $_POST['password'], $_POST['confirm_password'])) {
    $email = $_POST['email'];
    $pname = $_POST['profile_name'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];

    // Check whether any of the fields are empty
    if (!empty($email) && !empty($pname) && !empty($pass) && !empty($cpass)) {
        // Check whether the passwords match
        if ($pass == $cpass) {
            // Connect to the database
            $conn = @mysqli_connect("localhost", "root", "")
                or die("Failed to connect to the server");

            @mysqli_select_db($conn, "101223031")
                or die("Database is not available");

            // Check whether the email has already been registered
            $query = "SELECT * FROM users WHERE user_email='$email';";

            $result = mysqli_query($conn, $query)
                or die("Unable to execute the query");

            $numRows = mysqli_num_rows($result);

            if ($numRows == 0) {
                // Check whether profile name only contains letters
                if (!preg_match('/[^A-Za-z]/', $pname)) {
                    // Hash the input password using SHA256
                    $pass = hash('sha256', $pass);
                    $date = date("Y-m-d");

                    // Insert registration data into the database
                    $query = "INSERT INTO users (user_id, user_email, password, profile_name, date_started, num_of_friends)
                        VALUES (NULL, '$email', '$pass', '$pname', '$date', 0);";

                    $result = mysqli_query($conn, $query)
                        or die("Unable to execute the query");

                    // Get the user information from the database
                    $query = "SELECT * FROM users WHERE user_email='$email';";

                    $result = mysqli_query($conn, $query)
                        or die("Unable to execute the query");

                    $row = mysqli_fetch_assoc($result);

                    // Start the session
                    session_start();

                    // Set the session variables
                    $_SESSION["pname"] = $row["profile_name"];
                    $_SESSION["numFriends"] = $row["num_of_friends"];
                    $_SESSION["id"] = $row["user_id"];

                    // Redirect to the Friend add page
                    header("Location: friendadd.php");
                    die();
                } else {
                    $msg = "<p>Profile name should only contain letters. Please try again.</p>";
                }
            } else {
                $msg = "<p>This email has already been registered. Please try again.</p>";
            }
            // Close the connection
            mysqli_close($conn);
        } else {
            $msg = "<p>Both passwords do not match. Please try again.</p>";
        }
    } else {
        $msg = "<p>Incomplete input. Please try again.</p>";
    }
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
    <title>Sign Up</title>
</head>
<body>
    <header>
        <h2>My Friend System</h2>
        <h2>Registration Page</h2>
    </header>
    <article>
        <form action="signup.php" method="POST">
            <p>Email <input type="text" name="email" value="<?php echo $email ?>" /></p>
            <p>Profile Name <input type="text" name="profile_name" value="<?php echo $pname ?>" /></p>
            <p>Password <input type="password" name="password" /></p>
            <p>Confirm Password <input type="password" name="confirm_password" /></p>
            <p>
                <input type="submit" value="Register" />
                <input type="reset" value="Clear" />
            </p>
        </form>
        <?php echo $msg; ?>
        <p><a href="index.php">Home</a></p>
    </article>
</body>
</html>
