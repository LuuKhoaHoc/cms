<?php
include_once "includes/db.php"
  ?>
<!--Head-->
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <?php
      if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];

        $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id} ";
        $send_query = mysqli_query($conn, $query);

        $query = "SELECT * FROM `posts` WHERE post_id = {$the_post_id}";
        /** @var $conn */
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = $row['post_content'];
          ?>

          <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
          </h1>

          <!-- First Blog Post -->
          <h2>
            <a href="">
              <?= $post_title ?>
            </a>
          </h2>
          <p class="lead">
            by <a href="index.php">
              <?= $post_author ?>
            </a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span>
            <?= $post_date ?>
          </p>
          <hr>
          <img class="img-responsive" src="images/<?= $post_image ?>" alt="hinh-anh-yeu-thuong">
          <hr>
          <p>
            <?= $post_content ?>
          </p>
          <hr>

        <?php }
      } else {
        header("Location: index.php");
      }
      ?>
      <!-- Blog Comments -->
      <?php
      if (isset($_POST['create_comment'])) {
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];
        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
          $query = "INSERT INTO comments 
            (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) 
            VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now()) ";
          $row = mysqli_query($conn, $query);
          if (!$row) {
            die("QUERY ERROR : " . mysqli_error($conn));
          }
        } else {
          echo "<script>alert('Fields cannot be empty')</script>";
        }

      }
      ?>


      <!-- Comments Form -->
      <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" method="post" action="">
          <div class="form-group">
            <label for="comment_author">Author</label>
            <input class="form-control" type="text" name="comment_author" id="comment_author">
          </div>
          <div class="form-group">
            <label for="comment_email">Email</label>
            <input class="form-control" type="email" name="comment_email" id="comment_email">
          </div>
          <div class="form-group">
            <label for="comment_content">Your Comment</label>
            <textarea class="form-control" name="comment_content" id="comment_content" cols="80" rows="10"></textarea>
          </div>
          <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <hr>

      <!-- Posted Comments -->
      <?php
      $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
      $select_comment_query = mysqli_query($conn, $query);
      if (!$select_comment_query) {
        die("QUERY FAIL : " . mysqli_error($conn));
      }


      while ($row = mysqli_fetch_array($select_comment_query)) {
        $comment_date = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $comment_author = $row['comment_author'];

        ?>
        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">
              <?= $comment_author ?>
              <small>
                <?= $comment_date ?>
              </small>
            </h4>
            <?= $comment_content ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
  </div>
  <!-- /.row -->
  <hr>

  <?php include "includes/footer.php" ?>