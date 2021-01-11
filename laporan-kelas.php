<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>laporan absensi perkelas</title>
    <link rel="shortcut icon" href="assets/logo-wb.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/userslog.css">
    <script>
        $(window).on("load resize ", function() {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({
                'padding-right': scrollWidth
            });
        }).resize();
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/user_log.js"></script>
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
            <h1 class="slideInDown animated">Laporan Absensi Kelas</h1>
            <div class="form-style-5 slideInDown animated">
                <form method="POST" action="Export_Excel.php">
                    <div class="box">
                        <select name="student_class" id="student_class">
                            <option selected>pilih kelas</option>
                            <option value="7A">7A</option>
                            <option value="7B">7B</option>
                            <option value="7C">7C</option>
                            <option value="8A">8A</option>
                            <option value="8B">8B</option>
                            <option value="8C">8C</option>
                            <option value="9A">9A</option>
                            <option value="9B">9B</option>
                            <option value="9C">9C</option>
                        </select>
                    </div>
                    <input type="date" name="tanggal" id="tanggal">

                    <button type="button" name="user_log_class" id="user_log_class">Cari kelas</button>
                    <input type="submit" name="To_Excel_Class" value="Export to Excel">
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
                            <th>Nomor Orang tua</th>
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