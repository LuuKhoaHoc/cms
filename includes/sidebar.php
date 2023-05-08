<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="/../../PHP-for-Beginners/cms/search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    
        </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="/../../PHP-for-Beginners/cms/includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control">
                <span class="input-group-btn">
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
                </span>
            </div>
        </form>

    </div>
    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = "SELECT * FROM `categories`";
        /** @var $conn */
        $select_categories_sidebar = mysqli_query($conn,$query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>