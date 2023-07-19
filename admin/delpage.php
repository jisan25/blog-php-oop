<?php
include('../lib/Session.php');
Session::checkSession();
?>
<?php include('../config/config.php'); ?>
<?php include('../lib/Database.php'); ?>
<?php
$db = new Database();
?>

<?php
if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
    echo "<script>window.location='index.php';</script>";
} else {
    $id = $_GET['delpage'];

    $delquery = "DELETE FROM tbl_page WHERE id = '$id'";
    $data = $db->delete($delquery);
    if ($data) {
        echo "<script>alert('Data deleted Successfully.');</script>";
        echo "<script>window.location='index.php';</script>";
    } else {
        echo "<script>alert('Data Not deleted.');</script>";
        echo "<script>window.location='index.php';</script>";
    }
}
?>