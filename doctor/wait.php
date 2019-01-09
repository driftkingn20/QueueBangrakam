<?php
require "../db.php";

$depcode = '002';

$sql = "SELECT

(
SELECT
if(count(t2.vn) > 0,1,0) called
FROM
ovst_queue_server_time t2
LEFT JOIN ovst_queue_server q2 ON q2.vn = t2.vn
WHERE
q2.date_visit = CURDATE()
AND q2.dep = '$depcode'
AND MOD ( t2.STATUS, 2 ) = 1  AND t2.stationno IS not NULL
) called,q.*

FROM
ovst_queue_server q
WHERE
mod(q.status,2) = 1
AND q.date_visit = CURDATE()
AND q.stationno IS NULL
and q.dep = '$depcode'
ORDER BY
q.dep_level desc, q.time_visit asc
	LIMIT 7";

$query2 = mysqli_query($objCon, $sql);
while ($result2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
    ?>
<tr>
                    <td width="30%"><?=$result2['depq']?></td>
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
                    <td width="65%"><?=$result2['fullname']?></td>

                </tr>

                <?php
}
?>