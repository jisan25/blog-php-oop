<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No. </th>
						<th>Slider Title</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM tbl_slider";
					$data = $db->select($query);
					if ($data) {
						$i = 0;
						while ($result = $data->fetch_assoc()) { ?>

							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><b><?php echo $result['title']; ?></b></td>
								<td><img height="100px" src="<?php echo $result['image']; ?>"></td>
								<td>
									<?php if (Session::get('userRole') == '0') {  ?>
										<a href="editslider.php?id=<?php echo $result['id']; ?>">Edit</a> ||
										<a onclick="return confirm('Are you sure to Delete!');" href="deleteslider.php?id=<?php echo $result['id']; ?>">Delete</a>
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