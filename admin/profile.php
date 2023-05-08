<?php include "includes/admin_header.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }


}

if (isset($_POST['update_profile'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image']['tmp_name'];

    // move_uploaded_file($user_image_temp, "../images/$user_image");

    // if (empty($user_image)) {
    //     $query = "SELECT * FROM users WHERE user_id = $user_id";
    //     $select_image = mysqli_query($conn, $query);
    //     while ($row = mysqli_fetch_array($select_image)) {
    //         $user_image = $row['user_image'];
    //     }
    // }

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$user_id}";
    // $query .= "user_image = '{$user_image}' ";

    $update_user_query = mysqli_query($conn, $query);

    if (!$update_user_query) {
        die("QUERY FAILED" . mysqli_error($conn));
    }

}
?>


?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">Firstname
                            </label>
                            <input type="text" name="user_firstname" class="form-control"
                                value="<?= $user_firstname ?>">
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
                            <input type="password" name="user_password" class="form-control"
                                value="<?= $user_password ?>">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                        </div>
                    </form>
                    <?php if (isset($update_user_query)) {
                        if ($update_user_query)
                            echo "<div class='alert alert-success' role='alert' >User Updated. <a href='users.php'>View Users</a></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>