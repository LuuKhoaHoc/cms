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

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM `posts` WHERE `post_tags` LIKE '%$search%'";
                /** @var $conn */
                $search_query = mysqli_query($conn, $query);
                if (!$search_query) {
                    die("QUERY ERROR" . mysqli_error($conn));
                }
                if (mysqli_num_rows($search_query) == 0) {
                    echo "No results";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,30) . '...';
                        ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?= $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?= $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?= $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?= $post_image ?>" alt="hinh-anh-yeu-thuong">
                        <hr>
                        <p><?= $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>

                    <?php }
                }
            } ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->
    <hr>

<?php include "includes/footer.php" ?>