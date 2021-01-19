<?php
session_start();

$api_url = 'https://api.telegram.org/bot1569053999:AAGHDZmMTcSiKeJPsMBDnCWSS0Gw-U8944M/getUpdates';
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data);
$user_data = $response_data->result;
$array = json_decode(json_encode($user_data[count($user_data) - 1]), true);
var_dump($array);
$id_chat = $array["message"]["from"]["id"];
$user_message = $array["message"]["chat"]["text"];
$nama = $array['message']['from']['first_name'] . " ";
$nama .= $array['message']['from']['last_name'];

define('BOT_TOKEN', '1569053999:AAGHDZmMTcSiKeJPsMBDnCWSS0Gw-U8944M');
define('CHAT_ID', $id_chat);

function kirimTelegram($pesan)
{
  $pesan = json_encode($pesan);
  $API = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendmessage?chat_id=" . CHAT_ID . "&text=" . $pesan;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, $API);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

kirimTelegram("test");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Absensi | Biometric</title>
  <link rel="shortcut icon" href="assets/logo-wb.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/userslog.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
  </script>
  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="js/user_log.js"></script>
  <!-- <script>
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();
  </script> -->

  <script>
    $(document).ready(function() {
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
          'select_date': 1,
        }
      });
      setInterval(function() {
        $.ajax({
          url: "user_log_up.php",
          type: 'POST',
          data: {
            'select_date': 0,
          }
        }).done(function(data) {
          $('#userslog').html(data);
        });
      }, 5000);
    });
  </script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <!--User table-->
      <h1 class="slideInDown animated">Riwayat Pengguna</h1>
      <div class="form-style-5 slideInDown animated">
        <form method="POST" action="Export_Excel.php">
          <input type="date" name="date_sel" id="date_sel">
          <button type="button" name="user_log" id="user_log">Select Date</button>
          <input type="submit" name="To_Excel" value="Export to Excel">
        </form>
      </div>
      <div class="tbl-header slideInRight animated">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>NIK/NISN</th>
              <th>Fingerprint ID</th>
              <th>Telpon</th>
              <th>Nomor Siswa</th>
              <th>Date</th>
              <th>Time In</th>
              <th>Time Out</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content slideInRight animated">
        <div id="userslog"></div>
      </div>
    </section>
  </main>
</body>

</html>