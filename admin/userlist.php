<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        if (isset($_GET['deluser'])) {
            $delid = $_GET['deluser'];
            $deleteQuery = "DELETE FROM tbl_user WHERE id='$delid'";
            $deleteData = $db->delete($deleteQuery);
            if ($deleteData) {
                echo "<span class='success'>User deleted Successfully.</span>";
            } else {
                echo "<span class='error'>User not deleted.</span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email Name</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_user order by id desc";
                    $data = $db->select($query);
                    if ($data) {
                        $i = 0;
                        while ($result = $data->fetch_assoc()) {
                            $i++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textShorten($result['details'], 30); ?></td>
                                <td><?php

                                    switch ($result['role']) {
                                        case '0':
                                            echo "Admin";
                                            break;
                                        case '1':
                                            echo "Author";
                                            break;
                                        case '2':
                                            echo "Editor";
                                            break;
                                        default:
                                            break;
                                    }

                                    ?></td>
                                <td>
                                    <a href="viewuser.php?id=<?php echo $result['id']; ?>">View</a>
                                    <?php if (Session::get('userRole') == '0') { ?>
                                        ||
                                        <a onclick="return confirm('Are you sure to delete?');" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php  }
                    } ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
<?php include('inc/footer.php'); ?>