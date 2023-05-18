<?php
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $postValueId) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_published_status = mysqli_query($conn, $query);
        break;
      case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_draft_status = mysqli_query($conn, $query);
        break;
      case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
        $update_to_draft_status = mysqli_query($conn, $query);

        break;
    }
  }
}
?>


<form action="" method="post">
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <div style="padding-left: 0;" id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
          <option value="">Select Option</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
        </select>
      </div>
      <div style="margin-bottom: 20px;" class="col-xs-4 ">
        <input type="submit" value="Apply" name="submit" class="btn btn-success">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
      </div>




      <thead>
        <tr>
          <th><input type="checkbox" name="" id="selectAllBoxes"></th>
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
          <th>View Post</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM posts";
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
          $select_comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
          $select_comment_result = mysqli_query($conn, $select_comment_query);
          $post_comment_count = mysqli_num_rows($select_comment_result);
          $post_date = date_format(date_create($result['post_date']), 'd-m-Y');
          echo "<tr>";
          ?>
          <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value="<?= $post_id ?>"></td>
          <?php
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
          echo "<td><img width='200' class='img-rounded' src='../images/$post_image' alt='image'></td>";
          echo "<td>$post_content</td>";
          echo "<td>$post_tags</td>";
          echo "<td>$post_comment_count</td>";
          echo "<td>$post_date</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
          echo "</tr>";
        }

        ?>
      </tbody>
    </table>
  </div>
</form>
<?php
if (isset($_GET['delete'])) {
  $the_post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
  $delete_query = mysqli_query($conn, $query);
  header("Location: posts.php");
}
?>