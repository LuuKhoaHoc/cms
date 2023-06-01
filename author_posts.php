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
        $the_post_author = $_GET['author'];


        $query = "SELECT * FROM `posts` WHERE post_author = '{$the_post_author}'";
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
            <p class="lead">
              All posts by
              <?= $post_author ?>
            </p>
          </h2>
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

        <?php } ?>
      </div>
    <?php } ?>
    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
  </div>
  <!-- /.row -->
  <hr>

  <?php include "includes/footer.php" ?>