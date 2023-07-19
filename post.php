<?php include('inc/header.php'); ?>

<?php
$post_id = mysqli_real_escape_string($db->link, $_GET['post_id']);
if (!isset($post_id) || $post_id == NULL) {
	header("Location: 404.php");
} else {
	$id = $post_id;
}
?>


<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			$query = "select * from tbl_post where id = $id";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			?>
					<h2><?php echo $result['title']; ?></h2>
					<h4><?php echo $fm->formateDate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
					<img src="admin/<?php echo $result['image']; ?>" />
					<?php echo $result['body']; ?>



					<div class="relatedpost clear">
						<h2>Related articles</h2>
						<?php
						$catid = $result['cat'];
						$queryrelated = "select * from tbl_post where cat='$catid' order by rand() limit 6";
						$relatedpost = $db->select($queryrelated);

						if ($relatedpost) {
							$count = mysqli_num_rows($relatedpost);
							if ($count < 2) {
								echo "No Related Post Available !!";
							}
							while ($rresult = $relatedpost->fetch_assoc()) {
								$post_id = $rresult['id'];
								if ($id == $post_id) {
									continue;
								}


						?>

								<a href="post.php?id=<?php echo $rresult['id']; ?>"><img src="admin/<?php echo $rresult['image']; ?>" /></a>




						<?php }
						} else {
							echo "No Related Post Available !!";
						}
						?>
					</div>
			<?php }
			} else {
				header("Location:404.php");
			} ?>

		</div>

	</div>
	<?php include('inc/sidebar.php'); ?>

</div>

<?php include('inc/footer.php'); ?>