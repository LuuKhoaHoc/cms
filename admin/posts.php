<?php include "includes/admin_header.php"; ?>

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

                    <?php
                    $source = $_GET['source'] ?? '';
                    switch ($source) {
                        case "add_post":
                            include "includes/add_post.php";
                            break;
                        case "edit_post":
                            include "includes/edit_post.php";
                            break;
                        default:
                            include "includes/view_all_posts.php";
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
