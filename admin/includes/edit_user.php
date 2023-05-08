<?php
if (isset($_GET['edit_user'])) {
    /** @var $conn */
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM `users` WHERE user_id = $the_user_id";
    $row = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($row)) {
        $user_id = $result['user_id'];
        $username = $result['username'];
        $user_password = $result['user_password'];
        $user_firstname = $result['user_firstname'];
        $user_lastname = $result['user_lastname'];
        $user_email = $result['user_email'];
        $user_image = $result['user_image'];
        $user_role = $result['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    // $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/$post_image");
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
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname
        </label>
        <input type="text" name="user_firstname" class="form-control" value="<?= $user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname
        </label>
        <input type="text" name="user_lastname" class="form-control" value="<?= $user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role" id="user_role">
            <option value="<?= $user_role ?>">
                <?= $user_role ?>
            </option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }

            ?>



        </select>
    </div>

    <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image" class="form-control">
  </div> -->
    <div class="form-group">
        <label for="username">Username
        </label>
        <input type="text" name="username" class="form-control" value="<?= $username ?>">
    </div>
    <div class="form-group">
        <label for="email">Email
        </label>
        <input type="email" name="user_email" class="form-control" value="<?= $user_email ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password
        </label>
        <input type="password" name="user_password" class="form-control" value="<?= $user_password ?>">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>