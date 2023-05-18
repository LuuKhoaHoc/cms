<div class="table-responsive">
    <table style="overflow: hidden;" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `users`";
            /** @var $conn */
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

                echo "<tr>";

                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";

                //        $cat_query = "SELECT * FROM `categories` WHERE cat_id = {$post_category}";
                //        $slt_cat = mysqli_query($conn, $cat_query);
                //        while ($result = mysqli_fetch_assoc($slt_cat)) {
                //            $cat_id = $result["cat_id"];
                //            $cat_title = $result["cat_title"];
                //            echo "<td>{$cat_title}</td>";
                //        }
            
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";

                // $query = "SELECT `post_id`, `post_title` FROM `posts` WHERE post_id = {$comment_post_id}";
                // $select_post_id_query = mysqli_query($conn, $query);
                // while ($result = mysqli_fetch_assoc($select_post_id_query)) {
                //     $post_id = $result['post_id'];
                //     $post_title = $result['post_title'];
            
                //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                // }
            
                echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?');\" href='users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</div>
<?php
if (isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE `users` SET user_role = 'admin' WHERE user_id = $the_user_id";
    $change_to_admin_query = mysqli_query($conn, $query);
    header("Location: users.php");
}
if (isset($_GET['change_to_sub'])) {
    $the_user_id = $_GET['change_to_sub'];
    $query = "UPDATE `users` SET user_role = 'subscriber' WHERE user_id = $the_user_id";
    $change_to_subscriber_query = mysqli_query($conn, $query);
    header("Location: users.php");
}
if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM `users` WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($conn, $query);
    header("Location: users.php");
}
?>