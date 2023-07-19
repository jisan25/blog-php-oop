<?php include('inc/header.php'); ?>

<?php
$page_id = mysqli_real_escape_string($db->link, $_GET['id']);
if (!isset($page_id) || $page_id == NULL) {
	echo "<script>window.location='404.php';</script>";
} else {
	$id = $page_id;
}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			$query = "SELECT * FROM tbl_page WHERE id = '$id'";
			$data = $db->select($query);

			while ($result = $data->fetch_assoc()) {
			?>
				<h2><?php echo $result['name']; ?></h2>
				<?php echo $result['body']; ?>

			<?php }  ?>

		</div>

	</div>
	<?php include('inc/sidebar.php'); ?>

</div>

<?php include('inc/footer.php'); ?>