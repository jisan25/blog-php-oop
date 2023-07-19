<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>

        <?php
        if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
            echo "<script>window.location='inbox.php';</script>";
        } else {
            $id = $_GET['msgid'];
        }
        ?>



        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location='inbox.php';</script>";
        }
        ?>


        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_contact WHERE id = '$id'";
            $data = $db->select($query);

            while ($result = $data->fetch_assoc()) {
            ?>
                <form action="" method="post">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input readonly type="text" name="name" value="<?php echo $result['firstname'] . ' ' . $result['lastname']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input readonly type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input readonly type="text" name="date" value="<?php echo $fm->formateDate($result['date']); ?>" class="medium" />
                            </td>
                        </tr>




                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
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