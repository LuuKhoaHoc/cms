<?php
if (isset($_GET['edit_user'])) {
    /** @var $conn */
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM `users` WHERE user_id = $the_user_id";
    $row = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($row)) {
        $db_user_id = $result['user_id'];
        $db_username = $result['username'];
        $db_user_password = $result['user_password'];
        $db_user_firstname = $result['user_firstname'];
        $db_user_lastname = $result['user_lastname'];
        $db_user_email = $result['user_email'];
        $db_user_image = $result['user_image'];
        $db_user_role = $result['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if (!empty($user_password)) {
        $query = "SELECT user_password FROM users WHERE user_id = {$the_user_id}";
        $get_user_query = mysqli_query($conn, $query);
        confirmQuery($get_user_query);
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];
    }

    $query = "UPDATE users SET 
    user_firstname = '{$user_firstname}', 
    user_lastname = '{$user_lastname}', 
    user_role = '{$user_role}', 
    username = '{$username}', 
    user_email = '{$user_email}', 
    user_password = '{$user_password}' 
    WHERE user_id = $the_user_id ";

    $edit_user_query = mysqli_query($conn, $query);
    confirmQuery($edit_user_query);
    echo "User Updated: " . " " . "<a href='users.php'>View Users?</a>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname
        </label>
        <input type="text" name="user_firstname" class="form-control" value="<?= $db_user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname
        </label>
        <input type="text" name="user_lastname" class="form-control" value="<?= $db_user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role" id="user_role">
            <option value="<?= $db_user_role ?>">
                <?= $db_user_role ?>
            </option>
            <?php
            if ($db_user_role == 'admin') {
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username
        </label>
        <input type="text" name="username" class="form-control" value="<?= $db_username ?>">
    </div>
    <div class="form-group">
        <label for="email">Email
        </label>
        <input type="email" name="user_email" class="form-control" value="<?= $db_user_email ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password
        </label>
        <input type="user_password" name="user_password" class="form-control"
            value="<?php echo substr($db_user_password, 0, 20) ?>">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>