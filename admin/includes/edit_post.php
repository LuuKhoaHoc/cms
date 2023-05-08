<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM `posts` WHERE post_id = '{$the_post_id}'";
    /** @var $conn */
    $row = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($row)) {
        $post_id = $result['post_id'];
        $post_title = $result['post_title'];
        $post_author = $result['post_author'];
        $post_category = $result['post_category_id'];
        $post_status = $result['post_status'];
        $post_image = $result['post_image'];
        $post_content = $result['post_content'];
        $post_tags = $result['post_tags'];
        $post_comment_count = $result['post_comment_count'];
        $post_date = $result['post_date'];

    }
    if (isset($_POST['update_post'])) {
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        move_uploaded_file($post_image_temp, "../images/$post_image");

        // fix syntax
        $post_title = mysqli_real_escape_string($conn, $post_title);
        $post_author = mysqli_real_escape_string($conn, $post_author);
        $post_content = mysqli_real_escape_string($conn, $post_content);
        $post_tags = mysqli_real_escape_string($conn, $post_tags);

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $row = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_array($row)) {
                $post_image = $result['post_image'];
            }
        }

        $query = "UPDATE `posts` 
        SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(),   
                            post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}',
                            post_content = '{$post_content}', post_image = '{$post_image}'
        WHERE post_id = {$the_post_id};
        ";
        $row = mysqli_query($conn, $query);
        confirmQuery($row);
        header("refresh: 3");
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title
        </label>
        <input type="text" name="title" class="form-control" value="<?= $post_title ?>">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category_id">
            <?php
            $query = "SELECT * FROM `categories`";
            /** @var $conn */
            $row = mysqli_query($conn, $query);

            confirmQuery($row);
            while ($result = mysqli_fetch_assoc($row)) {
                $cat_id = $result["cat_id"];
                $cat_title = $result["cat_title"];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author
        </label>
        <input type="text" name="author" class="form-control" value="<?= $post_author ?>">

    </div>
    <div class="form-group">
        <select name="post_status" id="post_status">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value = 'draft'>Draft</option>";
            } else {
                echo "<option value = 'published'>Published</option>";
            }
            ?>

        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_status">Post Status
        </label>
        <input type="text" name="post_status" class="form-control" value="<?= $post_status ?>">
    </div> -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <div class="">
            <img width="100" src="../images/<?= $post_image ?>" alt="">
        </div>
        <input type="file" name="post_image" class="form-control" value="<?= $post_image ?>">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags
        </label>
        <input type="text" name="post_tags" class="form-control" value="<?= $post_tags ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content
        </label>
        <textarea class="form-control" name="post_content" id="" cols="30"
            rows="10"><?= trim($post_content) ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>