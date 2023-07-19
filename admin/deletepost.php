<?php
include('../lib/Session.php');
Session::checkSession();
?>
<?php include('../config/config.php'); ?>
<?php include('../lib/Database.php'); ?>
<?php include('../helpers/Format.php'); ?>
<?php
$db = new Database();
?>

<?php
if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
    echo "<script>window.location='postlist.php';</script>";
} else {
    $id = $_GET['delid'];
    $query = "SELECT * FROM tbl_post WHERE id = '$id'";
    $getData = $db->select($query);
    if ($getData) {
        while ($delimg = $getData->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }
    $delquery = "DELETE FROM tbl_post WHERE id = '$id'";
    $data = $db->delete($delquery);
    if ($data) {
        echo "<script>alert('Data deleted Successfully.');</script>";
        echo "<script>window.location='postlist.php';</script>";
    } else {
        echo "<script>alert('Data Not deleted.');</script>";
        echo "<script>window.location='postlist.php';</script>";
    }
}
?>