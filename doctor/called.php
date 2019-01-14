<?php
require "../db.php";

$depcode = '002';

// 1
$sql = "SELECT
q.depq,q.fullname,q.`name`,t.stationno,q.*
FROM
ovst_queue_server q
inner join ovst_queue_server_time t on t.vn = q.vn
WHERE
mod(q.status,2) = 1 and t.`status` = '1'
AND q.date_visit = CURDATE()
AND q.stationno is not null
and q.dep = '$depcode'
ORDER BY
t.time_start desc limit 7";

$query = mysqli_query($objCon, $sql);
while ($result2 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $level = $result2["dep_level"];
    ?>
<tr>
                    <td width="30%" style="text-align: center;
                  vertical-align: middle;"><?=$result2['depq']?></td>
                    <td width="5%"><?php
if ($level == '3') {
        echo '<img class="center" src="../dist/img/grand.png" height="40px" />';
    } else if ($level == '2') {
        echo '<img class="center" src="../dist/img/disabled.png" height="40px" />';
    } else if ($level == '1') {
        echo '<img class="center" src="../dist/img/calendar.png" height="40px" />';
    } else if ($level == '4') {
        echo '<img class="center" src="../dist/img/emergency.png" height="40px" />';
    } else {
        echo "";
    }

    ?></td>
                    <td width="65%" style="font-size:.8em;" style="text-align: left;"><?=$result2['fullname']?></td>
                    </tr>

<?php
}
?>