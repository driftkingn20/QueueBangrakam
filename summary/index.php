<?php
require "../db.php";

date_default_timezone_set("Asia/Bangkok");

function DateThai($strDate)
{
    if (empty($strDate)) {
        return "";
    } else {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>หน้าจอสถิติประจำวัน</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../dist/bootstrap3/bootstrap.min.css">
  <link rel="stylesheet" href="asset/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/FontAwesome/css/all.css">
  <link rel="stylesheet" href="style.css">

</head>

<body>


  <div width="100%">
    <h1 class="text-center" style="font-size:50px;">SMART QUEUE SUMMARY ประจำวันที่ <?=DateThai(date("Y/m/d"))?></h1>
  </div>
  <div class="container" style="width:100%;">

    <div class="row">

      <div class="col-md-5">
        <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-id-card"></i></span>
<?php
$s = "SELECT count(*) cc from ovst where  vstdate = curdate();";
$res = mysqli_query($objCon, $s);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size:40px;">จำนวนผู้เข้ารับบริการ</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-number" style="font-size:30px;">ทั้งหมด <?=$row['cc'];?> คน</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-navy">
              <span class="info-box-icon"><i class="fa fa-h-square"></i></span>
<?php
$s = "SELECT count(*) cc from ovst where  vstdate = curdate() and main_dep = '001';";
$res = mysqli_query($objCon, $s);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size:40px;">แผนก OPD</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-number" style="font-size:30px;">ทั้งหมด <?=$row['cc'];?> คน</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-blue">
              <span class="info-box-icon"><i class="fa fa-user-md"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-size:40px;">แผนก ER</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-number" style="font-size:30px;">ทั้งหมด 29 คน</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-md-12">
            <div class="info-box bg-maroon">
              <span class="info-box-icon"><i class="fa fa-hospital-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-size:40px;">แผนกทันตกรรม</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-number" style="font-size:30px;">ทั้งหมด 21 คน</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-universal-access"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-size:40px;">คลินิกพิเศษ</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="info-box-number" style="font-size:30px;">ทั้งหมด 195 คน</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

        </div>


      </div>

      <div class="col-md-7">
        <div class="row">
          <div class="col-md-6">
            <div class="panel  panel-primary" style="border-color: #d81b60 ;">
              <div class="panel-heading" style="font-size:40px;color:white;background-color:#d81b60 ;border-color: #d81b60 ;"><i
                  class="fa fa-comment-o"></i> จุดรอซักประวัติ</div>
              <div class="panel-body" style="font-size:30px;">
                <p>
                  รอนานเฉลี่ย 1ชม. 20 นาที
                </p>
                <p>
                  รอนานสูงสุด 1ชม. 55 นาที
                </p>
                <p>
                  รอนานต่ำสุด 0ชม. 45 นาที
                </p>
                <p>
                  หนาแน่นสูงสุด 267 คน <i class="fa fa-clock-o"></i> 09.00-10.00 น.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-success" style="border-color: #00a65a ;">
              <div class="panel-heading" style="font-size:40px;color:white;background-color:#00a65a ;border-color: #00a65a ;"><i
                  class="fa fa-stethoscope"></i> จุดรอเข้าพบแพทย์</div>
              <div class="panel-body" style="font-size:30px;">
                <p>
                  รอนานเฉลี่ย 1ชม. 45 นาที
                </p>
                <p>
                  รอนานสูงสุด 2ชม. 05 นาที
                </p>
                <p>
                  รอนานต่ำสุด 0ชม. 47 นาที
                </p>
                <p>
                  หนาแน่นสูงสุด 329 คน <i class="fa fa-clock-o"></i> 09.00-10.00 น.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-info" style="border-color: #0073b7 ;">
              <div class="panel-heading" style="font-size:40px;color:white;background-color:#0073b7 ;border-color: #0073b7;"><i
                  class="fa fa-suitcase"></i> จุดรอรับยา</div>
              <div class="panel-body" style="font-size:30px;">
                <p>
                  รอนานเฉลี่ย 1ชม. 49 นาที
                </p>
                <p>
                  รอนานสูงสุด 2ชม. 30 นาที
                </p>
                <p>
                  รอนานต่ำสุด 0ชม. 43 นาที
                </p>
                <p>
                  หนาแน่นสูงสุด 345 คน <i class="fa fa-clock-o"></i> 11.00-12.00 น.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-success" style="border-color: #f39c12  ;">
              <div class="panel-heading" style="font-size:40px;color:white;background-color:#f39c12  ;border-color: #f39c12  ;"><i
                  class="fa fa-h-square"></i> ข้อมูลวันถัดไป</div>
              <div class="panel-body" style="font-size:30px;">
                <p>
                  นัดตรวจโรคทั่วไป 27 คน
                </p>
                <p>
                  นัดทันตกรรม 15 คน
                </p>
                <p>
                  นัดคลินิกพิเศษ 60 คน
                </p>
              </div>
            </div>
          </div>

        </div>


      </div>

    </div>

  </div>










  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="..\dist\jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Latest compiled and minified JavaScript -->
  <script src="..\dist\bootstrap.min.js"></script>
  <script src="..\dist\socket.io.js"></script>
  <script>
    var timerloadwaitlist, timerloadwaitcalled;

    function loadWaitList() {
      //$('#wait-list').html('Loafing.....');
      $.get('waitscreen_waitlist.php', function (data) {
        $('#wait-list').html(data);
        console.log("loadWaitList");
      });
    } //จบฟังก์ชั่น

    function loadTotal() {
      $.get('total.php', function (data) {
        $('#wait-total').html(data);
        console.log("loadTotal");
      });
    }

    function loadWaitCalled() {
      $('#wait-called').load('waitscreen_called.php');
      console.log("loadWaitCalled");
    } //จบฟังก์ชั่น



    $(document).ready(function () {
      loadWaitList();
      loadTotal();
      loadWaitCalled();
      timerloadwaitlist = setInterval(loadWaitList, 10 * 1000);
      timerloadtotal = setInterval(loadTotal, 10 * 1000);
      timerloadwaitcalled = setInterval(loadWaitCalled, 5 * 1000);

    });

    $(window).on('unload', function () {
      clearInterval(timerloadwaitlist, timerloadwaitcalled, timerloadtotal);
    });
  </script>
</body>

</html>