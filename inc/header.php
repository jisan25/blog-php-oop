<?php include('config/config.php'); ?>
<?php include('lib/Database.php'); ?>
<?php include('helpers/Format.php'); ?>
<?php
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>

<head>

    <?php include('scripts/meta.php'); ?>
    <?php include('scripts/css.php'); ?>
    <?php include('scripts/js.php'); ?>

</head>

<body>
    <div class="headersection templete clear">
        <a href="#">
            <div class="logo">
                <?php
                $query = "select * from tbl_title_slogan where id = '1'";
                $data = $db->select($query);
                if ($data) {
                    while ($result = $data->fetch_assoc()) { ?>
                        <img src="admin/<?php echo $result['logo']; ?>" alt="Logo" />
                        <h2><?php echo $result['title']; ?></h2>
                        <p><?php echo $result['slogan']; ?></p>
                <?php }
                } ?>
            </div>
        </a>
        <div class="social clear">
            <div class="icon clear">
                <?php
                $query = "select * from tbl_social where id = '1'";
                $data = $db->select($query);
                if ($data) {
                    while ($result = $data->fetch_assoc()) { ?>
                        <a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo $result['li']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>

                <?php }
                } ?>
            </div>
            <div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..." />
                    <input type="submit" name="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <div class="navsection templete">
        <?php
        $path = $_SERVER['SCRIPT_FILENAME'];
        $currentPage = basename($path, '.php');
        ?>
        <ul>
            <li><a <?php
                    if ($currentPage == 'index') {
                        echo 'id="active"';
                    }
                    ?> href="index.php">Home</a></li>
            <?php
            $query = "select * from tbl_page";
            $data = $db->select($query);
            if ($data) {
                while ($result = $data->fetch_assoc()) { ?>

                    <li><a <?php
                            if (isset($_GET['id']) && $_GET['id'] == $result['id']) {
                                echo 'id="active"';
                            }
                            ?> href="page.php?id=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
            <?php }
            }
            ?>
            <li><a <?php
                    if ($currentPage == 'contact') {
                        echo 'id="active"';
                    }
                    ?> href="contact.php">Contact</a></li>
        </ul>
    </div>