<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<style>
    .odd td {
        text-align: center;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($_GET['seenid'])) {
            $id = $_GET['seenid'];
            $query = "UPDATE tbl_contact
        SET status = '1' WHERE id = $id";
            $update = $db->update($query);
            if ($update) {
                echo "<span class='success'>Message sent in the seen box.</span>";
                echo "<script>window.location='inbox.php';</script>";
            } else {
                echo "<span class='error'>Message not sent.</span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_contact WHERE status=0";
                    $data = $db->select($query);
                    if ($data) {
                        $i = 0;
                        while ($result = $data->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 25); ?></td>
                                <td><?php echo $fm->formateDate($result['date']); ?></td>
                                <td>
                                    <a href="viewmsg.php?msgid=<?php echo $result['id'];  ?>">View</a> ||
                                    <a href="replymsg.php?msgid=<?php echo $result['id'];  ?>">Reply</a> ||
                                    <a onclick="return confirm('Are you sure to Move msg!');" href="?seenid=<?php echo $result['id'];  ?>">Seen</a>
                                </td>
                            </tr>
                    <?php }
                    }           ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box round first grid">
        <h2>Seen Messages</h2>

        <?php
        if (isset($_GET['delid'])) {
            $id = $_GET['delid'];
            $query = "DELETE FROM tbl_contact WHERE id='$id'";
            $data = $db->delete($query);
            if ($data) {
                echo "<span class='success'>Message is deleted Successfully.</span>";
            } else {
                echo "<span class='error'>Message is not deleted.</span>";
            }
        }
        ?>

        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_contact WHERE status=1";
                    $data = $db->select($query);
                    if ($data) {
                        $i = 0;
                        while ($result = $data->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 25); ?></td>
                                <td><?php echo $fm->formateDate($result['date']); ?></td>
                                <td>
                                    <a href="viewmsg.php?msgid=<?php echo $result['id'];  ?>">View</a> ||
                                    <a onclick="return confirm('Are you sure to delete!');" href="?delid=<?php echo $result['id'];  ?>">Delete</a>
                                </td>
                            </tr>
                    <?php }
                    }     ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>