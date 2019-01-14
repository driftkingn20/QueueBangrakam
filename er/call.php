<?php
require "../db.php";

$sql = "SELECT
q.depq,q.fullname,q.dep_level,d.name er
FROM
ovst_queue_server q
left join er_regist e on e.vn = q.vn
left join er_dch_type d on d.er_dch_type = e.er_dch_type
where
 q.dep = '011' and mod(q.status,2) = 1
 AND q.date_visit = CURDATE()
 and q.stationno is not null order by q.dep_level desc, q.time_visit asc limit 6";

$query = mysqli_query($objCon, $sql);
?>


    <?php
while ($result2 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $level = $result2["dep_level"];
    //echo $level;
    ?>

    <tr>
            <td width="20%"><?=$result2["depq"];?></td>
            <td width="75%" style="text-align: left;"><?=$result2["fullname"];?></td>
            <td  width="5%"><?php
if ($level == 0) {
        echo "<i class='far fa-circle' aria-hidden='true' style='color:green'></i>";
    } else
    if ($level == 1) {
        echo "<i class='fas fa-circle' aria-hidden='true' style='color:#35f735'></i>";
    } else
    if ($level == 2) {
        echo "<i class='fas fa-circle' aria-hidden='true' style='color:#f7cd36'></i>";
    } else
    if ($level == 3) {
        echo "<i class='fas fa-circle' aria-hidden='true' style='color:pink'></i>";
    } else
    if ($level == 4) {
        echo "<i class='fas fa-circle' aria-hidden='true' style='color:#ff2b2b'></i>";
    }

    ?></td>
        </tr>
        <tr><td colspan="3" id="vertical" style="font-size:30px;">
        <?php
        if (empty($result2["er"])){
            echo "-";
        }else{
            echo $result2["er"];
        }
        ?>
        
        </td></tr>


        <?php
}
?>





<?php mysqli_close($objCon);?>