<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No. </th>
						<th width="10%">Post Title</th>
						<th width="20%">Description</th>
						<th width="5%">Category</th>
						<th width="10%">Image</th>
						<th width="10%">Author</th>
						<th width="10%">Tags</th>
						<th width="15%">Date</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title DESC";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result = $post->fetch_assoc()) { ?>

							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><b><?php echo $result['title']; ?></b></td>
								<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
								<td><?php echo $result['name']; ?></td>
								<td><img height="40px" src="<?php echo $result['image']; ?>"></td>
								<td><?php echo $result['author']; ?></td>
								<td><?php echo $result['tags']; ?></td>
								<td><?php echo $fm->formateDate($result['date'])  ?></td>
								<td>
									<a href="viewpost.php?id=<?php echo $result['id']; ?>">View</a>
									<?php if (Session::get('userId') == $result['userid'] || Session::get('userRole') == '0') {  ?>
										||
										<a href="editpost.php?editid=<?php echo $result['id']; ?>">Edit</a> ||
										<a onclick="return confirm('Are you sure to Delete!');" href="deletepost.php?delid=<?php echo $result['id']; ?>">Delete</a>
									<?php } ?>
								</td>
							</tr><?php	}
							} ?>


				</tbody>
			</table>

		</div>
	</div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include('inc/footer.php'); ?>