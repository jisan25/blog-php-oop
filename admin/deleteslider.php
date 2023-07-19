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
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='sliderlist.php';</script>";
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
    $getData = $db->select($query);
    if ($getData) {
        while ($delimg = $getData->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }
    $delquery = "DELETE FROM tbl_slider WHERE id = '$id'";
    $data = $db->delete($delquery);
    if ($data) {
        echo "<script>alert('Data deleted Successfully.');</script>";
        echo "<script>window.location='sliderlist.php';</script>";
    } else {
        echo "<script>alert('Data Not deleted.');</script>";
        echo "<script>window.location='sliderlist.php';</script>";
    }
}
?>