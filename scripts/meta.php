<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_page WHERE id = '$id'";
    $pages = $db->select($query);
    if ($pages) {
        while ($result = $pages->fetch_assoc()) { ?>
            <title><?php echo $result['name'] . ' - ' . TITLE; ?></title>

        <?php }
    }
} elseif (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    $query = "SELECT title FROM tbl_post WHERE id = '$id'";
    $data = $db->select($query);
    if ($data) {
        while ($result = $data->fetch_assoc()) { ?>
            <title><?php echo $result['title'] . ' - ' . TITLE; ?></title>
    <?php }
    }
} else { ?>
    <title><?php echo $fm->title() . ' - ' . TITLE; ?></title>

<?php } ?>
<title><?php echo TITLE; ?></title>
<meta name="language" content="English">
<meta name="description" content="It is a website about education">

<?php

if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    $query = "SELECT tags FROM tbl_post WHERE id = '$id'";
    $data = $db->select($query);
    if ($data) {
        while ($result = $data->fetch_assoc()) { ?>
            <meta name="keywords" content="<?php echo $result['tags']; ?>">
    <?php  }
    }  ?>
<?php
} else { ?>
    <meta name="keywords" content="<?php echo KEYWORDS; ?>">
<?php } ?>

<meta name="author" content="Delowar">