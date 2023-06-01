<?php include_once "includes/db.php" ?>
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
      $per_page = 2;
      $post_query_count = "SELECT * FROM posts";
      $post_result_count = mysqli_query($conn, $post_query_count);
      $count = mysqli_num_rows($post_result_count);
      $count = ceil($count / $per_page);
      if (empty($_GET["page"])) {
        $page = "";
      } else {
        $page = $_GET["page"];
      }
      if (isset($_GET["page"])) {
        $query = "SELECT * FROM `posts` WHERE `post_status` = 'published' LIMIT $per_page OFFSET " . ($page * $per_page) - $per_page;
      } else {
        $query = "SELECT * FROM `posts` WHERE `post_status` = 'published' LIMIT $per_page";
      }
      /** @var $conn */
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) == 0) {
        echo "<h1 class='text-center'>No Post!!! SORRY</h1>";
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = substr($row['post_content'], 0, 30) . '...';
          ?>
          <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
          </h1>

          <!-- First Blog Post -->
          <h2>
            <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
          </h2>
          <p class="lead">
            by <a href="author_posts.php?author=<?= $post_author ?>&p_id=<?= $post_id ?>">
              <?= $post_author ?>
            </a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span>
            <?= $post_date ?>
          </p>
          <hr>
          <a href="post.php?p_id=<?= $post_id ?>">
            <img class="img-responsive" src="images/<?= $post_image ?>" alt="image">
          </a>
          <hr>
          <p>
            <?= $post_content ?>
          </p>
          <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span
              class="glyphicon glyphicon-chevron-right"></span></a>
          <hr>
          <?php
        }
      }
      ?>
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
  </div>
  <!-- /.row -->
  <hr>
  <ul class="pager">
    <?php
    for ($i = 1; $i <= $count; $i++) {
      if ($i == $page) {
        echo "<li><a class='active_link'  href='index.php?page={$i}'>{$i}</a></li>";
      } else {
        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
      }
    }
    ?>

  </ul>
  <?php include "includes/footer.php" ?>