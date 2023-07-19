<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Slider</h2>

        <?php
        if (!isset($_GET['id']) || $_GET['id'] == NULL) {
            echo "<script>window.location='sliderlist.php';</script>";
        } else {
            $id = $_GET['id'];
        }
        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;

            if ($title == "") {
                echo "<span class='error'>All Fields must not be empty</span>";
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!
                        </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_slider SET
                         title = '$title',
                         image = '$uploaded_image'
                         WHERE id = '$id'";
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Data Updated Successfully.
                        </span>";
                        } else {
                            echo "<span class='error'>Data is not Updated !</span>";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_slider SET
                    title = '$title'
                    WHERE id = '$id'";
                    $updated_row = $db->update($query);

                    if ($updated_row) {
                        echo "<span class='success'>Data Updated Successfully.
                   </span>";
                    } else {
                        echo "<span class='error'>Data is not Updated !</span>";
                    }
                }
            }
        }
        ?>




        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
            $data = $db->select($query);

            while ($result = $data->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img height="100px" src="<?php echo $result['image']; ?>"> <br>
                                <input type="file" name="image" />
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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