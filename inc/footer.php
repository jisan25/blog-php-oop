<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>
    <?php
    $query = "select * from tbl_footer where id = '1'";
    $data = $db->select($query);
    if ($data) {
        while ($result = $data->fetch_assoc()) { ?>
            <p>&copy; <?php echo $result['note']; ?> <?php echo date('Y'); ?></p>
    <?php }
    } ?>
</div>
<div class="fixedicon clear">
    <?php
    $query = "select * from tbl_social where id = '1'";
    $data = $db->select($query);
    if ($data) {
        while ($result = $data->fetch_assoc()) { ?>
            <a target="_blank" href="<?php echo $result['fb']; ?>"><img src="images/fb.png" alt="Facebook" /></a>
            <a target="_blank" href="<?php echo $result['tw']; ?>"><img src="images/tw.png" alt="Twitter" /></a>
            <a target="_blank" href="<?php echo $result['li']; ?>"><img src="images/in.png" alt="LinkedIn" /></a>
            <a target="_blank" href="<?php echo $result['gp']; ?>"><img src="images/gl.png" alt="GooglePlus" /></a>
    <?php }
    } ?>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>