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
        or die("Database is not available");

    // Insert data into myfriends table if submit button is clicked
    if (isset($_POST['addFriend'])) {
        $friendID = $_POST['userID'];

        $query = "INSERT INTO myfriends (user_id, friend_id)
            VALUES ('$id', '$friendID');";

        $result = mysqli_query($conn, $query)
            or die("Unable to execute the query");

        // Increase the number of friends in the users table
        $query = "UPDATE users SET num_of_friends=num_of_friends+1
            WHERE user_id='$id';";

        $result = mysqli_query($conn, $query)
            or die("Unable to execute the query");

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
    <title>Add Friend</title>
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
            // Get current page
            if (isset($_GET['pageNum'])) {
                $pageNum = $_GET['pageNum'];
            } else {
                $pageNum = 1;
            }

            // Pagination variables
            $noPerPage = 5;
            $offset = ($pageNum - 1) * $noPerPage;

            // Get the number of pages
            $totalPagesQuery = "SELECT COUNT(*) FROM users WHERE NOT user_id='$id'";

            // Select users who are friends
            $query = "SELECT * FROM myfriends WHERE user_id='$id';";

            $result = mysqli_query($conn, $query)
                or die("Unable to execute the query");

            $row = mysqli_fetch_assoc($result);

            // Display users who are not friends
            $query = "SELECT * FROM users WHERE NOT user_id='$id'";

            // Append the query criteria
            while ($row) {
                $friend = $row['friend_id'];
                $query .= " AND NOT user_id='$friend'";

                // Pagination
                $totalPagesQuery .= " AND NOT user_id='$friend'";
                
                // Move to the next associated value
                $row = mysqli_fetch_assoc($result);
            }

            // Pagination
            $query .= " LIMIT $offset, $noPerPage";

            $result = mysqli_query($conn, $totalPagesQuery)
                or die("Unable to execute the query");

            // Get the number of pages
            $totalRows = mysqli_fetch_array($result)[0];
            $totalPages = ceil($totalRows / $noPerPage);

            $result = mysqli_query($conn, $query)
                or die("Unable to execute the query");

            $row = mysqli_fetch_assoc($result);

            while ($row) {
                echo "<tr><td>{$row['profile_name']}</td>";
            ?>
            <form method="POST">
                <input type="hidden" value="<?php echo $row['user_id']; ?>" name="userID" />
                <td><input type="submit" name="addFriend" value="Add Friend" /></td></tr>
            </form>
            <?php
                // Move to the next associated value
                $row = mysqli_fetch_assoc($result);
            }
            mysqli_close($conn);
            ?>
            
        </table>
        <div class="navigation">
            <ul>
                <li class="<?php if($pageNum <=1) { echo 'disabled'; } ?>">
                    <a href="<?php if($pageNum <= 1) { echo '#'; } else { echo "?pageNum=" . ($pageNum - 1); } ?>"><?php if ($pageNum <= 1) { echo ""; } else { echo "Previous"; } ?></a>
                </li>
                <li class="<?php if ($pageNum >= $totalPages) { echo 'disabled'; } ?>">
                    <a href="<?php if ($pageNum >= $totalPages) { echo '#'; } else { echo "?pageNum=" . ($pageNum + 1); } ?>"><?php if ($pageNum >= $totalPages) { echo ""; } else { echo "Next"; } ?></a>
                </li>
            </ul>
        </div>
        <p class="center">
            <a href="friendlist.php">Friend List | </a>
            <a href="logout.php">Log out</a>
        </p>
    </article>
</body>
</html>
