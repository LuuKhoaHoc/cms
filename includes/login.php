<?php
include "db.php";
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    // Check if username and password are not empty
    if (!empty($username) && !empty($password)) {

        // SQL Injection
        $username = mysqli_escape_string($conn, $username);
        $password = mysqli_escape_string($conn, $password);
        // QUERY 
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($conn, $query);
        if (!$select_user_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        // Fetch information to check 
        while ($row = mysqli_fetch_array($select_user_query)) {
            $user = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
        }
        $password_hash = password_hash($user_password, PASSWORD_DEFAULT);

        // Check if the entered password matches the password stored in the database for the given user
        if (password_verify($password, $password_hash)) {
            // Passwords match, set session variables and redirect to dashboard
            $_SESSION['username'] = $user;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_role'] = $user_role;
            header("Location: ../admin"); // Redirect to dashboard
        } else {
            // Passwords do not match, show error message
            header("Location: ../index.php"); 
        }
    } else {
        // Show error message if either username or password is empty
        echo "Please enter both username and password";
    }
}
?>