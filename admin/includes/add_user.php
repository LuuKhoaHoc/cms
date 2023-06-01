<?php
if (isset($_POST['create_user'])) {
    // $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost', 10]);

    $query = "INSERT INTO users ( user_firstname, user_lastname, user_role, username, user_email, user_password) 
    VALUES ('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";
    /** @var $conn */
    $create_user_query = mysqli_query($conn, $query);

    confirmQuery($create_user_query);
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname
        </label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname
        </label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role" id="user_role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image" class="form-control">
  </div> -->
    <div class="form-group">
        <label for="username">Username
        </label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email
        </label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password
        </label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>