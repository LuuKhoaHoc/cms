<?php

function users_online()
{
    if (isset($_GET["onlineusers"])) {
        global $conn;
        if (!$conn) {
            session_start();
            include_once '../includes/db.php';

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 5;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($conn, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == null) {
                mysqli_query($conn, "INSERT INTO users_online (`session`, `time`) VALUES ('$session', '$time')");
            } else {
                mysqli_query($conn, "UPDATE users_online SET `time` = '$time' WHERE `session` = '$session'");
            }
            $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE `time` > '{$time_out}'");
            echo $count = mysqli_num_rows($users_online_query);
        }
    }
}

users_online();

function confirmQuery($result): void
{
    global $conn;
    if (!$result) {
        die('QUERY FAILED :' . mysqli_error($conn));
    }

}

function insert_categories()
{
    global $conn;
    if (isset($_POST["submit"])) {
        $cat_title = $_POST["cat_title"];

        if (empty($cat_title) || $cat_title == "") {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO `categories`(cat_title)  VALUES ('{$cat_title}') ";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }
}

function findAllCategories()
{
    global $conn;
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories()
{
    global $conn;
    if (isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM `categories` WHERE cat_id = {$del_cat_id}";
        $result = mysqli_query($conn, $query);
        header("location: categories.php");
    }
}
function redirect($location)
{
    return header("Location:" . $location);
}