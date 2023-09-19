<?php
// Resume the session
session_start();

// Check if the session variables have not been set
if (!isset($_SESSION["pname"], $_SESSION["numFriends"])) {
    // Redirect to the home page
    header("Location: index.php");
    die();
} else {
    $pname = $_SESSION["pname"];
    $id = $_SESSION["id"];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "")
        or die("Failed to connect to the server");

    mysqli_select_db($conn, "101223031")
        or die("Databse is not available");

    // Remove data into myfriends table if submit button is clicked
    if (isset($_POST['unfriend'])) {
        $userID = $_POST['userID'];

        $query = "DELETE FROM myfriends WHERE user_id='$id' AND friend_id='$userID';";

        $result = mysqli_query($conn, $query)
            or die("Unable to execute the query");

        // Decrease the number of friends in the users table
        $query = "UPDATE users SET num_of_friends=num_of_friends-1
            WHERE user_id='$id';";

        $result = mysqli_query($conn, $query)
            or die("Unable to execute the query".mysqli_error($conn));

        // Unset POST value
        unset($_POST['unfriend']);
    }

    // Get the number of friends
    $query = "SELECT * FROM users WHERE user_id='$id';";

    $result = mysqli_query($conn, $query)
        or die("Unable to execute the query1");

    $row = mysqli_fetch_assoc($result);

    $numFriends = $row['num_of_friends'];
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
    <title>Friend List</title>
</head>
<body>
    <header>
        <h2>My Friend System</h2>
        <h2><?php echo $pname; ?>'s Friend List Page</h2>
        <h2>Total number of friends is <?php echo $numFriends; ?></h2>
    </header>
    <article>
        <table>
            <?php
            // Display users who are friends
            $query = "SELECT * FROM myfriends WHERE user_id='$id';";

            $result = mysqli_query($conn, $query)
                or die("Unable to execute the query");

            $row = mysqli_fetch_assoc($result);

            // Display users who are friends
            $query = "SELECT * FROM users WHERE (user_id!='$id' AND";

            $friend = "";

            // Append the query criteria
            while ($row) {
                $friend = $row['friend_id'];
                //$query = "SELECT * FROM users WHERE user_id!='$id' AND user_id='$friend';";
                $query .= " user_id='$friend') OR (user_id!='$id' AND";
                
                // Move to the next associated value
                $row = mysqli_fetch_assoc($result);
            }
            $query .= " user_id='$friend')";

            $result = mysqli_query($conn, $query)
                or die("Unable to execute the query1".mysqli_error($conn));

            $row = mysqli_fetch_assoc($result);

            while ($row) {
                echo "<tr><td>{$row['profile_name']}</td>";
            ?>
            <form action="friendlist.php" method="POST">
                <input type="hidden" value="<?php echo $row['user_id']; ?>" name="userID" />
                <td><input type="submit" name="unfriend" value="Unfriend" /></td></tr>
            </form>
            <?php
                // Move to the next associated value
                $row = mysqli_fetch_assoc($result);
            }
            mysqli_close($conn);
            ?>
        </table>
        <p class="center">
            <a href="friendadd.php">Add Friend | </a>
            <a href="logout.php">Log out</a>
        </p>
    </article>
</body>
</html>
