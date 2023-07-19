<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Post</h2>

        <?php
        if (!isset($_GET['id']) || $_GET['id'] == NULL) {
            echo "<script>window.location='postlist.php';</script>";
        } else {
            $id = $_GET['id'];
        }
        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location='postlist.php';</script>";
        }
        ?>




        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_post WHERE id = '$id'";
            $post = $db->select($query);

            while ($result = $post->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input readonly type="text" name="title" value="<?php echo $result['title']; ?>" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                    <?php
                                    $query2 = "SELECT * FROM tbl_category";
                                    $category = $db->select($query2);
                                    if ($category) {
                                        while ($result3 = $category->fetch_assoc()) { ?>
                                            <option <?php if ($result3['id'] == $result['cat']) {
                                                        echo 'selected';
                                                    } ?> value="<?php echo $result3['id']; ?>"><?php echo $result3['name']; ?></option>

                                    <?php  }
                                    }
                                    ?>

                                </select>

                            </td>
                        </tr>



                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img width="100px" src="<?php echo $result['image']; ?>"> <br>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input readonly type="text" name="tags" value="<?php echo $result['tags']; ?>" placeholder="Enter Tags..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input readonly type="text" name="author" value="<?php echo $result['author']; ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } ?>

        </div>

    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<!-- /TinyMCE -->
<?php include('inc/footer.php'); ?>