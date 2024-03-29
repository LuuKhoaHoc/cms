<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // $post_comment_count = 4;
    move_uploaded_file($post_image_temp, "../images/$post_image");

    // fix syntax
    $post_title = mysqli_real_escape_string($conn, $post_title);
    $post_author = mysqli_real_escape_string($conn, $post_author);
    $post_content = mysqli_real_escape_string($conn, $post_content);
    $post_tags = mysqli_real_escape_string($conn, $post_tags);



    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
    VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}' ,'{$post_status}')";
    /** @var $conn */
    $create_post_query = mysqli_query($conn, $query);

    confirmQuery($create_post_query);
    $the_post_id = mysqli_insert_id($conn);
    echo "<p class = 'bg-success'>Post Created. <a href ='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title
        </label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select class="form-control" name="post_category_id" id="post_category_id">
            <?php
            $query = "SELECT * FROM `categories`";
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
        <input type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status
        </label>
        <select class="form-control" name="post_status" id="">
            <option value="draft">Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags
        </label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="summernote">Post Content
        </label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>