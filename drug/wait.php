<?php
require "../db.php";

$depcode = '013';

$sql = "SELECT

(
    SELECT
IF
	( count( t2.vn ) > 0, 1, 0 ) called
FROM
	ovst_queue_server_dep t2
WHERE
	t2.date_visit = CURDATE( )
	AND t2.stationno IS not NULL
	and t2.dep_visit = 'drug'
	and t2.status = '1'
) called,q.*

FROM
ovst_queue_server_dep q
WHERE
q.date_visit = CURDATE()
AND q.stationno IS NULL
and q.dep_visit = 'drug'
ORDER BY
 q.time_visit asc
	LIMIT 10";

$query2 = mysqli_query($objCon, $sql);

?>

<?php
$sqlminute = "SELECT time_wait,time_start,dep_station from kskdepartment where depcode = '$depcode'";
$queryminute = mysqli_query($objCon, $sqlminute);
$resultminute = mysqli_fetch_array($queryminute, MYSQLI_ASSOC);
$time = $resultminute["time_wait"];
$workstart = $resultminute["time_start"];
date_default_timezone_set("Asia/Bangkok");
$now = date("H:i:s");
$dep = $resultminute["dep_station"];

$dateDiff = intval((strtotime($workstart) - strtotime($now)) / 60);

if ($dateDiff < 0) {
    $dateDiff = 0;
}

function convertToHoursMins($sumtime)
{
    if ($sumtime < 1) {
        return "-";
    }
    $hours = floor($sumtime / 60);
    $minutes = ($sumtime % 60);
    $mod = fmod($sumtime, 60);

    if ($hours >= 1 && $mod == 0) {
        return $hours . " ช.ม.";
    }
    if ($hours >= 1) {
        return "<h2> " . $hours . " ชม. " . $minutes . " น.</h2>";
    } else {
        return $minutes . " นาที";
    }

    return "-";
}

$counter = 0;
while ($result2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
    $called = $result2["called"];

    $div = $counter / $dep;
    $x = floor($div);

    $sumtime = ((round($x) + $called)) * $time + $dateDiff;

    $vn = $result2["vn"];
    $sqlupdate = "UPDATE ovst_queue_server
  SET wait_dep='$sumtime'
  WHERE vn='$vn'";
    $queryupdate = mysqli_query($objCon, $sqlupdate);
    ?>
      <tr>
<td width="15%"> <?php echo date("H:i", strtotime($result2["time_visit"])); ?></td>
<td width="10%" style="text-align: center;color:blue;font-weight: 900;"><b>
        <?=$result2["depq"];
    ?></b></td>
  <td width="50%"><?=$result2["fullname"];?></td>
<td width="25%" style="text-align: center;">
    <?php //echo $sumtime;
    echo convertToHoursMins($sumtime);

    ?>
</td>
</tr>
      <?php
$counter++;
}
?>
