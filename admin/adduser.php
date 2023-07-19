<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php
if (!Session::get('userRole') == '0') {
    echo "<script>window.location='index.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $password = mysqli_real_escape_string($db->link, $_POST['password']);
                $role = mysqli_real_escape_string($db->link, $_POST['role']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $password = md5($password);
                if (empty($username) || empty($password) || empty($email)) {
                    echo "<span class='error'>Fields must not be empty!</span>";
                } else {


                    $mailquery = "SELECT * FROM tbl_user where email = '$email' limit 1";
                    $mailcheck = $db->select($mailquery);

                    if ($mailcheck != false) {
                        echo "<span class='error'>Email Already Exist !.</span>";
                    } else {
                        $query = "INSERT INTO tbl_user(username, password, role, email) VALUES('$username', '$password', '$role', '$email')";
                        $insert = $db->insert($query);
                        if ($insert) {
                            echo "<span class='success'>User inserted Successfully.</span>";
                        } else {
                            echo "<span class='error'>User not inserted.</span>";
                        }
                    }
                }
            }

            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label for="">Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter UserName..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">User Role</label>
                        </td>
                        <td>
                            <select name="role" id="select">
                                <option>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
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
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>