<?php include('inc/header.php'); ?>

<?php
$id = mysqli_real_escape_string($db->link, $_GET['category']);

if (!isset($id) || $id == NULL) {
    header("Location: 404.php");
} else {
    $category = $id;
}
?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        $query = "select * from tbl_post where cat=$category";
        $post = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) { ?>

                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formateDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" /></a>
                    <?php
                    echo $fm->textShorten($result['body']); ?>
                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>
            <?php }
        } else { ?>
            <h3>No Post Available in this category</h3>
        <?php }
        ?>


    </div>
    <?php include('inc/sidebar.php'); ?>

</div>

<?php include('inc/footer.php'); ?>