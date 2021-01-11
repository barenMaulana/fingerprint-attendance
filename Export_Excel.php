<?php
//Connect to database
require 'connectDB.php';
$output = '';

if (isset($_POST["To_Excel"])) {

    if (empty($_POST['date_sel'])) {

        $Log_date = date("Y-m-d");
    } else if (!empty($_POST['date_sel'])) {

        $Log_date = $_POST['date_sel'];
    }
    $sql = "SELECT * FROM users_logs WHERE checkindate='$Log_date' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $output .= '
                        <table class="table" bordered="1">  
                          <TR>
                            <TH>ID</TH>
                            <TH>Name</TH>
                            <TH>Serial Number</TH>
                            <TH>Fingerprint ID</TH>
                            <TH>Parent Number</TH>
                            <TH>Date log</TH>
                            <TH>Time In</TH>
                            <TH>Time Out</TH>
                          </TR>';
        while ($row = $result->fetch_assoc()) {
            $output .= '
                              <TR> 
                                  <TD> ' . $row['id'] . '</TD>
                                  <TD> ' . $row['username'] . '</TD>
                                  <TD> ' . $row['serialnumber'] . '</TD>
                                  <TD> ' . $row['fingerprint_id'] . '</TD>
                                  <TD> ' . $row['parent_number'] . '</TD>
                                  <TD> ' . $row['checkindate'] . '</TD>
                                  <TD> ' . $row['timein'] . '</TD>
                                  <TD> ' . $row['timeout'] . '</TD>
                              </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log' . $Log_date . '.xls');

        echo $output;
        exit();
    } else {
        header("location: UsersLog.php");
        exit();
    }
}

if (isset($_POST["To_Excel_Class"]) && isset($_POST['tanggal'])) {

    if (empty($_POST['student_class'])) {
        $student_class = "";
        $tanggal = "";
    } else if (!empty($_POST['student_class'])) {
        $student_class = $_POST['student_class'];
        $tanggal = $_POST['tanggal'];
    }

    $sql = "SELECT * FROM users_logs WHERE checkindate='$tanggal' AND student_class='$student_class' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $output .= '
                        <table class="table" bordered="1">
                          <TR>
                            <TH>ID</TH>
                            <TH>Name</TH>
                            <TH>Serial Number</TH>
                            <TH>Fingerprint ID</TH>
                            <TH>Parent Number</TH>
                            <TH>Student Number</TH>
                            <TH>Email</TH>
                            <TH>Student Class</TH>
                            <TH>Status</TH>
                            <TH>Date log</TH>
                            <TH>Time In</TH>
                            <TH>Time Out</TH>
                          </TR>';
        while ($row = $result->fetch_assoc()) {
            $output .= '
                              <TR> 
                                  <TD> ' . $row['id'] . '</TD>
                                  <TD> ' . $row['username'] . '</TD>
                                  <TD> ' . $row['serialnumber'] . '</TD>
                                  <TD> ' . $row['fingerprint_id'] . '</TD>
                                  <TD> ' . $row['parent_number'] . '</TD>
                                  <TD> ' . $row['student_number'] . '</TD>
                                  <TD> ' . $row['email'] . '</TD>
                                  <TD> ' . $row['student_class'] . '</TD>
                                  <TD> ' . $row['status'] . '</TD>
                                  <TD> ' . $row['checkindate'] . '</TD>
                                  <TD> ' . $row['timein'] . '</TD>
                                  <TD> ' . $row['timeout'] . '</TD>
                              </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log' . $student_class . '.xls');

        echo $output;
        exit();
    } else {
        header("location: laporan-kelas.php");
        exit();
    }
}
