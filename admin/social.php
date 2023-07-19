<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $facebook = mysqli_real_escape_string($db->link, $_POST['facebook']);
                $twitter = mysqli_real_escape_string($db->link, $_POST['twitter']);
                $linkedin = mysqli_real_escape_string($db->link, $_POST['linkedin']);
                $googleplus = mysqli_real_escape_string($db->link, $_POST['googleplus']);




                if ($facebook == "" || $twitter == "" || $linkedin == "" || $googleplus == "") {
                    echo "<span class='error'>All Fields must not be empty</span>";
                } else {
                    $query = "UPDATE tbl_social SET
                    fb = '$facebook',
                    tw = '$twitter',
                    li = '$linkedin',
                    gp = '$googleplus'
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

            ?>

            <?php
            $query = "select * from tbl_social where id = '1'";
            $data = $db->select($query);
            if ($data) {
                while ($result = $data->fetch_assoc()) { ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="facebook" placeholder="Facebook link.." class="medium" value="<?php echo $result['fb']; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="twitter" placeholder="Twitter link.." class="medium" value="<?php echo $result['tw']; ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="linkedin" placeholder="LinkedIn link.." class="medium" value="<?php echo $result['li']; ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="googleplus" placeholder="Google Plus link.." class="medium" value="<?php echo $result['gp']; ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php include('inc/footer.php'); ?>