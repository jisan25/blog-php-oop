<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2> Dashbord</h2>
        <div class="block">
            Welcome admin panel
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