<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = "SELECT * FROM tbl_slider";
        $data = $db->select($query);
        if ($data) {
            $i = 0;
            while ($result = $data->fetch_assoc()) { ?>
                <a href="#"><img src="admin/<?php echo $result['image'] ?>" title="<?php echo $result['title']; ?>" /></a>

        <?php }
        } ?>
    </div>

</div>