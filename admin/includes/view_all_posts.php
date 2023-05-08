<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tag</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
    $query = "SELECT * FROM `posts`";
    /** @var $conn */
    $row = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($row)) {
        $post_id = $result['post_id'];
        $post_author = $result['post_author'];
        $post_title = $result['post_title'];
        $post_category = $result['post_category_id'];
        $post_status = $result['post_status'];
        $post_image = $result['post_image'];
        $post_content = $result['post_content'];
        $post_tags = $result['post_tags'];
        $post_comment_count = $result['post_comment_count'];
        $post_date =date_format(date_create($result['post_date']), 'd-m-Y');
        echo "<tr>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";

        $cat_query = "SELECT * FROM `categories` WHERE cat_id = {$post_category}";
        $slt_cat = mysqli_query($conn, $cat_query);
        while ($result = mysqli_fetch_assoc($slt_cat)) {
            $cat_id = $result["cat_id"];
            $cat_title = $result["cat_title"];
        echo "<td>{$cat_title}</td>";
        }


        echo "<td>$post_status</td>";
        echo "<td><img width='333' class='img-rounded' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_content</td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }

    ?>
    </tbody>
  </table>
</div>
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($conn, $query);
    header("Location: posts.php");
}
    ?>