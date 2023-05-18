<div class="table-responsive">
  <table style="overflow: hidden;" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response To</th>
        <th>Date</th>
        <th>Approve</th>
        <th>UnApprove</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM `comments`";
        /** @var $conn */
        $row = mysqli_query($conn, $query);
        while ($result = mysqli_fetch_assoc($row)) {
            $comment_id = $result['comment_id'];
            $comment_post_id = $result['comment_post_id'];
            $comment_author = $result['comment_author'];
            $comment_content = $result['comment_content'];
            $comment_email = $result['comment_email'];
            $comment_status = $result['comment_status'];
            $comment_date = date_format(date_create($result['comment_date']), 'd-m-Y');
            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";

            //        $cat_query = "SELECT * FROM `categories` WHERE cat_id = {$post_category}";
            //        $slt_cat = mysqli_query($conn, $cat_query);
            //        while ($result = mysqli_fetch_assoc($slt_cat)) {
            //            $cat_id = $result["cat_id"];
            //            $cat_title = $result["cat_title"];
            //            echo "<td>{$cat_title}</td>";
            //        }

            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $query = "SELECT `post_id`, `post_title` FROM `posts` WHERE post_id = {$comment_post_id}";
            $select_post_id_query = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $result['post_id'];
                $post_title = $result['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>$comment_date</td>";

            echo "<td><a href='comments.php?approved={$comment_id}'>Approved</a></td>";
            echo "<td><a href='comments.php?unapproved={$comment_id}'>Unapproved</a></td>";
            echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?');\" href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>
    </tbody>
  </table>
</div>
<?php
if (isset($_GET['approved'])) {
    $the_comment_id = $_GET['approved'];
    $query = "UPDATE `comments` SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $approve_comment_query = mysqli_query($conn, $query);
    header("Location: comments.php");
}
if (isset($_GET['unapproved'])) {
    $the_comment_id = $_GET['unapproved'];
    $query = "UPDATE `comments` SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    $unapproved_comment_query = mysqli_query($conn, $query);
    header("Location: comments.php");
}
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM `comments` WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($conn, $query);
    header("Location: comments.php");
}


?>