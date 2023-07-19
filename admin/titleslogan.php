<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<style>
    .leftside {
        float: left;
        width: 70%;
    }

    .rightside {
        float: left;
        width: 20%;
    }

    .rightside img {
        height: 160x;
        width: 170px;
    }
</style>




<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $slogan = mysqli_real_escape_string($db->link, $_POST['slogan']);


            $permited  = array('png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $same_image = "logo" . '.' . $file_ext;
            $uploaded_image = "uploads/" . $same_image;



            if ($title == "" || $slogan == "") {
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
                        $query = "UPDATE tbl_title_slogan SET
                         title = '$title',
                         slogan = '$slogan',
                         logo = '$uploaded_image'
                         WHERE id = '1'";
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Data Updated Successfully.
                        </span>";
                        } else {
                            echo "<span class='error'>Data is not Updated !</span>";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_title_slogan SET
                    title = '$title',
                    slogan = '$slogan'
                    WHERE id = '1'";
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
        <?php
        $query = "select * from tbl_title_slogan where id = '1'";
        $data = $db->select($query);
        if ($data) {
            while ($result = $data->fetch_assoc()) { ?>
                <div class="block sloginblock">



                    <div class="leftside">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Website Title</label>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Enter Website Title..." name="title" class="medium" value="<?php echo $result['title']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Slogan</label>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Enter Website Slogan..." name="slogan" class="medium" value="<?php echo $result['slogan']; ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Upload Image</label>
                                    </td>
                                    <td>
                                        <input type="file" name="image" />
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="rightside">
                        <img src="<?php echo $result['logo']; ?>">
                    </div>


                </div>
        <?php }
        }

        ?>
    </div>
</div>

<?php include('inc/footer.php'); ?>