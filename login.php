<?php
$displayEmail = $msg = "";

// Connect to the database
$conn = mysqli_connect("localhost", "root", "")
    or die("Failed to connect to the server");

mysqli_select_db($conn, "101223031")
    or die("Database is not available");

if (isset($_POST['email'], $_POST['password'])) {
    // Fill in the email field
    $displayEmail = $_POST['email'];

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Sanitize input data
        $email = mysqli_escape_string($conn, $_POST['email']);
        $pass = mysqli_escape_string($conn, $_POST['password']);

        // Execute query using prepared statement method
        $sql_string = "SELECT * FROM users WHERE user_email=?;";  // May be an error here

        $prepared_stmt = mysqli_prepare($conn, $sql_string);

        mysqli_stmt_bind_param($prepared_stmt, "s", $email);

        mysqli_stmt_execute($prepared_stmt);

        $query_result = mysqli_stmt_get_result($prepared_stmt)
            or die("Unable to execute the query");

        mysqli_stmt_close($prepared_stmt);

        $numRows = mysqli_num_rows($query_result);

        if ($numRows > 0) {
            $row = mysqli_fetch_assoc($query_result);

            mysqli_free_result($query_result);

            // Hash the input password using SHA256
            $pass = hash('sha256', $pass);

            // Get the first 20 characters in the string only
            $pass = substr($pass, 0, 20);

            // Check whether the password matches the one in the database
            if ($pass == $row["password"]) {
                // Start the session
                session_start();

                // Set the session variables
                $_SESSION["pname"] = $row["profile_name"];
                $_SESSION["numFriends"] = $row["num_of_friends"];
                $_SESSION["id"] = $row["user_id"];

                // Redirect to Friend List page
                header("Location: friendlist.php");
                die();
            } else {
                $msg = "<p>Incorrect password. Please try again.</p>";
            }
        } else {
            $msg = "<p>Email is not registered. Please try again.</p>";
        }
    } else {
        $msg = "<p>Incomplete input. Please try again.</p>";
    }
}
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
    <link rel="stylesheet" href="style.css" />
    <title>Log In</title>
</head>
<body>
    <header>
        <h2>My Friend System</h2>
        <h2>Log in Page</h2>
    </header>
    <article>
        <form action="login.php" method="POST">
            <p>Email <input type="text" name="email" value="<?php echo $displayEmail ?>" /></p>
            <p>Password <input type="password" name="password" /></p>
            <p>
                <input type="submit" value="Log in" />
                <input type="reset" value="Clear" />
            </p>
        </form>
        <?php echo $msg; ?>
        <p><a href="index.php">Home</a></p>
    </article>
</body>
</html>
