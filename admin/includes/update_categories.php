<form action="" method="post">
    <div class="form-group ">
        <label for="cat_title">Edit Category</label>

        <?php
        
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM `categories` WHERE cat_id = {$cat_id}";
            /** @var $conn */
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                ?>
                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" class="form-control" type="text" name="cat_title" id="cat_title">
                <?php
            }
        }
        ?>

        <?php // UPDATE CATEGORY
        if (isset($_POST['update_category'])) {
            $up_cat_title = $_POST['cat_title'];
            $query = "UPDATE `categories` SET cat_title = '{$up_cat_title}' WHERE cat_id = {$cat_id}";
            $result = mysqli_query($conn, $query);
            header("location: categories.php");
        }


        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>